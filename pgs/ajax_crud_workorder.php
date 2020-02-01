<?php
	/**
	 * Checks if the value of a specific unique field already exists 
	 * @param t table name
	 * @param id the value of the PK of the record if it already exists
	 * @returns json result: { "result": "ok" } or { "result": "error" }
	 */
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	$memberInfo = getMemberInfo();
	$currUserFirstName = (isset($memberInfo['custom'][0]) && !empty($memberInfo['custom'][0])) ? explode(' ',trim($memberInfo['custom'][0]))[0] : $memberInfo['username'];

	/* maintenance mode */
	handle_maintenance();

	/* return json */
	header('Content-type: application/json');

	$error_return = '{ "result": "error" }';
	$ok_return = '{ "result": "ok" }';
	
	/* capture inputs */
	$table = new Request('t');
	$operation = new Request('o');
	$selectedID = new Request('si');
	$workOrderID = new Request('w');
	$workOrderNumber = sqlValue("SELECT `WONumber` from `WorkOrder` where `id` = '" . makeSafe($workOrderID->sql) . "'");
	$sameRecord = new Request('same');
	/* prevent conventional error output via a shutdown handler */
	function cancel_all_buffers(){
		while(ob_get_level()) ob_end_clean();
		echo $GLOBALS['result'];
	}
	$GLOBALS['result'] = $error_return; // error message to return if any error occurs
	ob_start();
	register_shutdown_function('cancel_all_buffers');

	/* user has access to table? */
	$table_perms = getTablePermissions($table->raw);
	if(!$table_perms[0]) exit();


	if($operation->sql == 'select'){
		$select_workorders=sql("SELECT `id`, `WONumber`, case when (select count(*) from `work_order_map` where `tableName` = '" . $table->sql . "' and `pkValue` = '" . $selectedID->sql . "' and `WorkOrder`.`id` = `work_order_map`.`WOid`) > 0 then 'yes' else 'no' end as \"selected\" FROM `WorkOrder` WHERE `fo_EmployeeID` = (select `employees`.`EmployeeID` from `employees` where `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "')", $eo);
		if (isset($select_workorders) && $select_workorders->num_rows > 0) {
			while($row=db_fetch_row($select_workorders)){ 
				$workOrderList[] = array(
					'id'  		=> $row[0],
					'WONumber'  => $row[1],
					'selected'  => $row[2]
				);
			}
		}
		$GLOBALS['result'] = json_encode($workOrderList);
	}
	else if ($operation->sql == 'addupdate'){
		// get workorder owner details
		$workOrderOwner = getRecordOwnerDetails('WorkOrder', $workOrderID->sql);
		$workOrderOwnerFirstName = (isset($workOrderOwner['custom1']) && !empty($workOrderOwner['custom1'])) ? explode(' ',trim($workOrderOwner['custom1']))[0] : $workOrderOwner['memberID'];

		// get form entry owner details
		$formEntryOwner = getRecordOwnerDetails($table->sql, $selectedID->sql);
		$formEntryOwnerFirstName = (isset($formEntryOwner['custom1']) && !empty($formEntryOwner['custom1'])) ? explode(' ',trim($formEntryOwner['custom1']))[0] : $formEntryOwner['memberID'];

		// check if it is the same work order that already existed
		// if not the same work order
		if ($sameRecord->raw == 'no'){
			// check if another work order exists for the same table and pkValue in work order map table
			$checkExists = sqlValue("SELECT count(*) from `work_order_map` where `tableName` = '" . $table->sql . "' and `pkValue` = '" . $selectedID->sql . "'");
			
			if (isset($checkExists)){
				// proceed to add if no records found
				if (intval($checkExists) == 0){
					$sqlInsert = "INSERT INTO `work_order_map` ( `WOid`, `WONumber`, `tableName`, `pkValue`, `memberID`, `ot_ap_filed` ) VALUES ( " . $workOrderID->sql . ", '" .  $workOrderNumber . "', '" . $table->sql . "', '" . $selectedID->sql . "', '" . makeSafe($memberInfo['username']) . "', CURRENT_TIMESTAMP)";
					sql($sqlInsert, $eo);
				}
				// proceed to update if a record exists
				else if (intval($checkExists) > 0){
					$uniqueId = sqlValue("SELECT `id` from `work_order_map` where `tableName` = '" . $table->sql . "' and `pkValue` = '" . $selectedID->sql . "' limit 1");
					$sqlUpdate = "UPDATE `work_order_map` SET `WOid` = " . $workOrderID->sql . ", `WONumber` = '" . $workOrderNumber . "', `tableName` = '" . $table->sql . "', `pkValue` = '" . $selectedID->sql . "', `ot_ap_lastmodified` = CURRENT_TIMESTAMP WHERE `id` = " .  $uniqueId;
					sql($sqlUpdate, $eo);
				}
			}
		}
		// proceed to update if it is the same work order
		else {
			$uniqueId = sqlValue("SELECT `id` from `work_order_map` where `WOid` = " . $workOrderID->sql . " and `tableName` = '" . $table->sql . "' and `pkValue` = '" . $selectedID->sql . "' limit 1");
			$sqlUpdate = "UPDATE `work_order_map` SET `WOid` = " . $workOrderID->sql . ", `WONumber` = '" . $workOrderNumber . "', `tableName` = '" . $table->sql . "', `pkValue` = '" . $selectedID->sql . "', `ot_ap_lastmodified` = CURRENT_TIMESTAMP WHERE `id` = " .  $uniqueId;
			sql($sqlUpdate, $eo);
		}
		// send app notification to workorder assigner
		$newNotification = new UserNotification([]);
		$newNotification->setNotif_title('Update on work order');
		$newNotification->setNotif_msg($formEntryOwnerFirstName . ' has requested you to review ' . $workOrderNumber);
		$newNotification->setNotif_url('WorkOrder_view.php?SelectedID=' . $workOrderID->sql);
		$newNotification->setNotif_time(date('Y-m-d H:i:s'));
		$newNotification->setMemberID($workOrderOwner['memberID']);
		$newNotification->createNotification();

		// send email notification to workorder assigner
		$emailTo = $workOrderOwner['email'];
		$emailName = $workOrderOwnerFirstName;
		$emailWorkOrderUrl = application_url("WorkOrder_view.php") . "?SelectedID={$workOrderID->sql}";
		if(isEmail($emailTo)){
			sendmail(array(
				'to' => $emailTo,
				'name' => $emailName,
				'subject' => $newNotification->getNotif_title(),
				'message' => $newNotification->getNotif_msg() . ".\n\n". "To view it, please go to:\n".	$emailWorkOrderUrl
			));
		}

		$GLOBALS['result'] = $ok_return;
	}
	else if($operation->sql == 'getrelated'){
		$related_sql = "SELECT `id`, `tableName`, `pkValue` FROM `work_order_map` WHERE `WOid` = " . $workOrderID->sql;
		$select_related=sql($related_sql, $eo);
		if (isset($select_related) && $select_related->num_rows > 0) {
			while($row=db_fetch_row($select_related)){ 
				$display = get_summary_custom_display($row[1], 0);

				$relatedRecordsList[] = array(
					'id'  		=> $row[0],
					'tableName'	=> $row[1],
					'pkValue'  	=> $row[2],
					'display'	=> $display
				);
			}
		}
		$GLOBALS['result'] = json_encode($relatedRecordsList);
	}
	
