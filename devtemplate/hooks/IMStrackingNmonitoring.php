<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks
	$hooks_dir = dirname(__FILE__);
	$tableName = basename(__FILE__, '.php');
	include("$hooks_dir/summary_counters.php");
		
	function IMStrackingNmonitoring_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function IMStrackingNmonitoring_header($contentType, $memberInfo, &$args){
		global $tableName;
		$header='';
		if(function_exists('summary_counters')){
			$summaryCode=summary_counters($contentType, $memberInfo, $tableName);
		}
		switch($contentType){
			case 'tableview':
				$header='<%%HEADER%%>'.$summaryCode;
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

	function IMStrackingNmonitoring_footer($contentType, $memberInfo, &$args){
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

	function IMStrackingNmonitoring_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function IMStrackingNmonitoring_after_insert($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'insert');
		}

		return TRUE;
	}

	function IMStrackingNmonitoring_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function IMStrackingNmonitoring_after_update($data, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_update')){
			summary_update_after_update($tableName);
		}

		return TRUE;
	}

	function IMStrackingNmonitoring_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function IMStrackingNmonitoring_after_delete($selectedID, $memberInfo, &$args){
		global $tableName;
		if(function_exists('summary_update_after_insert_delete')){
			summary_update_after_insert_delete($tableName, 'delete');
		}
	}

	function IMStrackingNmonitoring_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function IMStrackingNmonitoring_csv($query, $memberInfo, &$args){

		return $query;
	}
	function IMStrackingNmonitoring_batch_actions(&$args){

		return array();
	}
