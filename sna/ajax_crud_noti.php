<?php
	/**
	 * Retrieve list of latest notification for the user 
	 * @param d department / table group name (0:"All departments", 1:"PROJECT", 2:"CLIENT", 3:"ADMIN", 4:"RESOURCES", 5:"ASSET", 6:"QHSE", 7:"STATUS", 8:"Misc.")
	 * @returns json result: { "result": "output" } or { "result": "error" }
	 */
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	$memberInfo = getMemberInfo();
	$memberID = $memberInfo["username"];
	$output = array();
	define('results_per_page', 10);
	
	/* maintenance mode */
	handle_maintenance();

	/* return json */
	header('Content-type: application/json');

	$error_return = '{ "result": "error" }';
	$ok_return = '{ "result": "ok" }';
	
	/* capture inputs */
	$operation = new Request('o');
	$notifId = new Request('nId');
	$notiLimitStart = new Request('nls');
	$notiLimit = new Request('nl');
	$p = new Request('p');

	/* prevent conventional error output via a shutdown handler */
	function cancel_all_buffers(){
		while(ob_get_level()) ob_end_clean();
		echo $GLOBALS['result'];
	}
	$GLOBALS['result'] = $error_return; // error message to return if any error occurs
	ob_start();
	register_shutdown_function('cancel_all_buffers');



	if($operation->sql == 'select'){
		$notiSql = "SELECT `id`, `notif_title`, `notif_msg`, `notif_url`, `notif_time`, `read_flag` FROM `notif` WHERE `active_flag` = 'Y' AND `memberID` = '" . $memberID . "' ORDER BY `read_flag`, `notif_time` DESC LIMIT " . $notiLimitStart->sql . ", " . $notiLimit->sql;
		$notiResult = sql($notiSql, $eo);
		if($notiResult->num_rows > 0){
			while($row=db_fetch_row($notiResult)){
				$output[] = array(
					'id'  		=> $row[0],
					'notif_title'  => $row[1],
					'notif_msg'  => $row[2],
					'notif_url'  => $row[3],
					'notif_time'  => $row[4],
					'read_flag'  => $row[5]
				);
			}
		}
		$GLOBALS['result'] = json_encode($output);
	}
	else if($operation->sql == 'toggle_r'){
		$currReadFlag = sqlValue("SELECT `read_flag` from `notif` where `id` = " . $notifId->sql);
		$readFlagReturned = ($currReadFlag == 'N') ? 'Y' : 'N';
		sql("UPDATE `notif` SET `read_flag` = '" . $readFlagReturned . "' WHERE `id` = " . $notifId->sql, $eo);
		$GLOBALS['result'] = json_encode($readFlagReturned);
	}
	else if($operation->sql == 'mark_d'){
		sql("UPDATE `notif` SET `active_flag` = 'N' WHERE `id` = " . $notifId->sql, $eo);
		$GLOBALS['result'] = $ok_return;
	}
	else if($operation->sql == 'selectAll'){
		
		// check requested page number
		$page = 1; // default is page 1
		if(isset($p->sql)) $page = intval($p->sql);
		if($page < 1) $page = 1;
		
		// offset formula
		$skip = results_per_page * ($page - 1);
		
		/* finally, apply this in the query */
		$query = "SELECT `id`, `notif_title`, `notif_msg`, `notif_url`, `notif_time`, `read_flag` FROM `notif` WHERE `active_flag` = 'Y' AND `memberID` = '" . $memberID . "' ORDER BY `notif_time` DESC LIMIT " . $skip . ", " . results_per_page;
		$notiResult = sql($query, $eo);
		if($notiResult->num_rows > 0){
			while($row=db_fetch_row($notiResult)){
				$output[] = array(
					'id'  		=> $row[0],
					'notif_title'  => $row[1],
					'notif_msg'  => $row[2],
					'notif_url'  => $row[3],
					'notif_time'  => $row[4],
					'read_flag'  => $row[5]
				);
			}
		}
		$GLOBALS['result'] = json_encode($output);

	}

	
