<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks
	$hooks_dir = dirname(__FILE__);
	$tableName = basename(__FILE__, '.php');
	include("$hooks_dir/summary_counters.php");
		
	function WorkOrder_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function WorkOrder_header($contentType, $memberInfo, &$args){
		global $tableName;
		$header='';
		// if(function_exists('summary_counters')){
		// 	$summaryCode=summary_counters($contentType, $memberInfo, $tableName);
		// }
		switch($contentType){
			case 'tableview':
				// $header='<%%HEADER%%>'.$summaryCode;
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function WorkOrder_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function WorkOrder_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function WorkOrder_after_insert($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'insert');
		}
		// get workorder owner details
		$workOrderOwner = getMemberIDDetails($memberInfo['username']);
		$workOrderOwnerFirstName = (isset($workOrderOwner['custom1']) && !empty($workOrderOwner['custom1'])) ? explode(' ',trim($workOrderOwner['custom1']))[0] : $workOrderOwner['memberID'];

		// get form entry owner details
		$workOrderAssigneeMID = sqlValue("SELECT `memberID` from `employees` where `EmployeeID` = '" . $data["fo_EmployeeID"] . "'");
		$workOrderAssignee = getMemberIDDetails($workOrderAssigneeMID);
		$workOrderAssigneeFirstName = (isset($workOrderAssignee['custom1']) && !empty($workOrderAssignee['custom1'])) ? explode(' ',trim($workOrderAssignee['custom1']))[0] : $workOrderAssignee['memberID'];

		$newNotification = new UserNotification([]);
		$newNotification->setNotif_title('New work order');
		$newNotification->setNotif_msg($workOrderOwnerFirstName . ' has assigned ' . $data["WONumber"] . ' to you');
		$newNotification->setNotif_url('WorkOrder_view.php?SelectedID=' . $data["id"]);
		$newNotification->setNotif_time(date('Y-m-d H:i:s'));
		$newNotification->setMemberID($workOrderAssignee['memberID']);
		$newNotification->createNotification();

		return TRUE;
	}

	function WorkOrder_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function WorkOrder_after_update($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_update')){
			summary_update_after_update($tableName);
		}

		// get workorder owner details
		$workOrderOwner = getMemberIDDetails($memberInfo['username']);
		$workOrderOwnerFirstName = (isset($workOrderOwner['custom1']) && !empty($workOrderOwner['custom1'])) ? explode(' ',trim($workOrderOwner['custom1']))[0] : $workOrderOwner['memberID'];

		// get form entry owner details
		$workOrderAssigneeMID = sqlValue("SELECT `memberID` from `employees` where `EmployeeID` = '" . $data["fo_EmployeeID"] . "'");
		$workOrderAssignee = getMemberIDDetails($workOrderAssigneeMID);
		$workOrderAssigneeFirstName = (isset($workOrderAssignee['custom1']) && !empty($workOrderAssignee['custom1'])) ? explode(' ',trim($workOrderAssignee['custom1']))[0] : $workOrderAssignee['memberID'];

		$newNotification = new UserNotification([]);
		$newNotification->setNotif_title('Update on work order');
		$newNotification->setNotif_msg($workOrderOwnerFirstName . ' has updated ' . $data["WONumber"] . ' that was assigned to you');
		$newNotification->setNotif_url('WorkOrder_view.php?SelectedID=' . $data["id"]);
		$newNotification->setNotif_time(date('Y-m-d H:i:s'));
		$newNotification->setMemberID($workOrderAssignee['memberID']);
		$newNotification->createNotification();

		return TRUE;
	}

	function WorkOrder_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function WorkOrder_after_delete($selectedID, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'delete');
		}
	}

	function WorkOrder_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function WorkOrder_csv($query, $memberInfo, &$args){

		return $query;
	}
	function WorkOrder_batch_actions(&$args){

		return array();
	}
