<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks
	$hooks_dir = dirname(__FILE__);
	$tableName = basename(__FILE__, '.php');
	include("$hooks_dir/summary_counters.php");
		
	function Inquiry_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_header($contentType, $memberInfo, &$args){
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

	function Inquiry_footer($contentType, $memberInfo, &$args){
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

	function Inquiry_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_insert($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'insert');
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent($data["InqNumber"], $data["fo_InquiryDate"], $data["fo_DueDate"], $tableName, $data["id"], $data["ot_ap_Review"], $data["ot_ap_Approval"], $data["ot_ap_QC"], 'insert');
		}

		return TRUE;
	}

	function Inquiry_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_update($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_update')){
			summary_update_after_update($tableName);
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent($data["InqNumber"], $data["fo_InquiryDate"], $data["fo_DueDate"], $tableName, $data["id"], $data["ot_ap_Review"], $data["ot_ap_Approval"], $data["ot_ap_QC"], 'update');
		}

		return TRUE;
	}

	function Inquiry_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_delete($selectedID, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'delete');
		}
		if(function_exists('dbCalendarEvent')){
			dbCalendarEvent(null, null, null, $tableName, $selectedID, null, null, null, 'delete');
		}
	}

	function Inquiry_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function Inquiry_csv($query, $memberInfo, &$args){

		return $query;
	}
	function Inquiry_batch_actions(&$args){

		return array();
	}
