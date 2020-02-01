<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks
		
	function kpi_init(&$options, $memberInfo, &$args){
		$options->ColWidth   = array(  180, 180, 180, 180, 180);
		$options->ColCaption = array("Section", "Minimum Records Required", "Task Completion Duration", "Percentage of KPI achieved per annum", "Last modified");
		$options->ColFieldName = array('fo_Section_Caption', 'fo_MinRecordRequired', 'fo_TaskCompDuration', 'fo_PercentageAchieved', 'ot_ap_lastmodified');
		$options->ColNumber  = array(4, 5, 6, 7, 8);
	
		// template paths below are based on the app main directory
		$options->Template = 'hooks/kpi_templateTV.html';
		$options->SelectedTemplate = 'hooks/kpi_templateTVS.html';
		$options->RecordsPerPage = 83;
		return TRUE;
	}

	function kpi_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
			case 'tableview':
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

	function kpi_footer($contentType, $memberInfo, &$args){
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

	function kpi_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function kpi_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	function kpi_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function kpi_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function kpi_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function kpi_after_delete($selectedID, $memberInfo, &$args){

	}

	function kpi_dv($selectedID, $memberInfo, &$html, &$args){
		if ($selectedID){	// if viewing an existing record then...
			$id=makeSafe($selectedID);
			
			// calculate kpi percentage
			$percent = sqlValue("SELECT CONCAT (COALESCE(ROUND((count(`membership_userrecords`.`recID`)/`fo_minRecordRequired`)*100, 2), 0.00), '%') as 'percentage' from `kpi` inner join `membership_userrecords` on `membership_userrecords`.`tableName` = `kpi`.`fo_Section_Name` where `kpi`.`id` = '$id' and (YEAR(from_unixtime(`membership_userrecords`.`dateAdded`)) = YEAR(CURRENT_DATE()))");
			
			if (isset($percent)) {
				$from_percent ='id="fo_PercentageAchieved"></div>';
				$to_percent ='id="fo_PercentageAchieved">'. $percent . '</div>';				
				$html = str_replace($from_percent, $to_percent, $html);
			}
		}
		else {	// otherwise, if viewing a "new" empty record do this
			$from_percent ='id="fo_PercentageAchieved"></div>';
			$to_percent ='id="fo_PercentageAchieved">This field will be automatically calculated after KPI metric is udpated.</div>';
			$html = str_replace($from_percent, $to_percent, $html);
		}
	}

	function kpi_csv($query, $memberInfo, &$args){
		$query = "SELECT `id`, `fo_Section_Name`, `fo_Section_Caption`, `fo_MinRecordRequired`, `fo_TaskCompDuration`, (SELECT CONCAT (COALESCE(ROUND((count(mu.`recID`)/k.`fo_minRecordRequired`)*100, 2), 0.00), '%') from `kpi` k inner join `membership_userrecords` mu on mu.`tableName` = k.`fo_Section_Name` where k.`id` = `kpi`.`id` and (YEAR(from_unixtime(mu.`dateAdded`)) = YEAR(CURRENT_DATE()))) as `fo_PercentageAchieved`, `ot_ap_lastmodified` from `kpi`";
		return $query;
	}
	function kpi_batch_actions(&$args){

		return array();
	}
