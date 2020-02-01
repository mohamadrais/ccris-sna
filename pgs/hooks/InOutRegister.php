<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks
	$hooks_dir = dirname(__FILE__);
	$tableName = basename(__FILE__, '.php');
	include("$hooks_dir/summary_counters.php");
		
	function InOutRegister_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function InOutRegister_header($contentType, $memberInfo, &$args){
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

	function InOutRegister_footer($contentType, $memberInfo, &$args){
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

	function InOutRegister_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function InOutRegister_after_insert($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'insert');
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent($data["DocItem"], $data["fo_Delivdate"], null, $tableName, $data["id"], $data["ot_ap_Review"], $data["ot_ap_Approval"], $data["ot_ap_QC"], 'insert');
		}

		return TRUE;
	}

	function InOutRegister_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function InOutRegister_after_update($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_update')){
			summary_update_after_update($tableName);
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent($data["DocItem"], $data["fo_Delivdate"], null, $tableName, $data["id"], $data["ot_ap_Review"], $data["ot_ap_Approval"], $data["ot_ap_QC"], 'update');
		}

		return TRUE;
	}

	function InOutRegister_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function InOutRegister_after_delete($selectedID, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'delete');
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent(null, null, null, $tableName, $selectedID, null, null, null, 'delete');
		}
	}

	function InOutRegister_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function InOutRegister_csv($query, $memberInfo, &$args){

		return $query;
	}
	function InOutRegister_batch_actions(&$args){

		return array();
	}
