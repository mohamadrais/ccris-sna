<?php

function summary_counters($contentType, $memberInfo, $tableName)
{

	$totalCount = sqlValue(get_summary_select_sql($tableName, 0));
	$totalCount = (!isset($totalCount) || empty($totalCount)) ? '0' : $totalCount;
	$totalDisplayField = sqlValue(get_summary_select_sql($tableName, 1));
	
	$reviewCount = sqlValue(get_summary_select_sql($tableName, 2));
	$reviewCount = (!isset($reviewCount) || empty($reviewCount)) ? '0' : $reviewCount;
	$reviewDisplayField = (!isset($reviewCount)) ? '' : 'Reviews Closed';
	
	$approvalCount = sqlValue(get_summary_select_sql($tableName, 3));
	$approvalCount = (!isset($approvalCount) || empty($approvalCount)) ? '0' : $approvalCount;
	$approvalDisplayField = (!isset($approvalCount)) ? '' : 'Approvals Closed';
	
	$imsControlCount = sqlValue(get_summary_select_sql($tableName, 4));
	$imsControlCount = (!isset($imsControlCount) || empty($imsControlCount)) ? '0' : $imsControlCount;
	$imsControlDisplayField = (!isset($imsControlCount)) ? '' : 'IMS Controls Closed';
	
	$customDisplayField1 = sqlValue(get_summary_select_sql($tableName, 5));
	$customDisplayValue1 = sqlValue(get_summary_select_sql($tableName, 6));
	if (get_summary_custom_display($tableName, 2) == 'float') $customDisplayValue1 = '$' . number_format($customDisplayValue1, 2);
	else if (get_summary_custom_display($tableName, 2) == 'int') $customDisplayValue1 = number_format($customDisplayValue1);
	$customDisplayValue1 = (!isset($customDisplayValue1) || empty($customDisplayValue1)) ? '0' : $customDisplayValue1;
	
	$customDisplayField2 = sqlValue(get_summary_select_sql($tableName, 7));
	$customDisplayValue2 = sqlValue(get_summary_select_sql($tableName, 8));
	if (get_summary_custom_display($tableName, 4) == 'float') $customDisplayValue2 = '$' . number_format($customDisplayValue2, 2);
	else if (get_summary_custom_display($tableName, 4) == 'int') $customDisplayValue2 = number_format($customDisplayValue2);
	$customDisplayValue2 = (!isset($customDisplayValue2) || empty($customDisplayValue2)) ? '0' : $customDisplayValue2;

	$totalCards = 1;
	$summaryContent_html=array('<div class="card">
								<div class="card-body text-center">
									<h6 class="card-title text-muted m-b-0">Total '.$totalDisplayField.'</h6>
									<!-- <p class="text-muted">$totalDisplayField</p> -->
									<h1 class="font-light d-inline">'.$totalCount.'</h1>
								</div>
							</div>');

	if (!empty($reviewDisplayField)) {
		array_push($summaryContent_html, '<div class="card">
												<div class="card-body text-center">
													<h6 class="card-title text-muted m-b-0">'.$reviewDisplayField.'</h6>
													<!-- <p class="text-muted">Overall</p> -->
													<h1 class="font-light d-inline">'.$reviewCount.'</h1>
												</div>
											</div>');
		$totalCards++;
	}
	if (!empty($approvalDisplayField)) {
		array_push($summaryContent_html, '<div class="card">
												<div class="card-body text-center">
													<h6 class="card-title text-muted m-b-0">'.$approvalDisplayField.'</h6>
													<!-- <p class="text-muted">Overall</p> -->
													<h1 class="font-light d-inline">'.$approvalCount.'</h1>
												</div>
											</div>');
		$totalCards++;
	}
	if (!empty($imsControlDisplayField)) {
		array_push($summaryContent_html, '<div class="card">
													<div class="card-body text-center">
														<h6 class="card-title text-muted m-b-0">'.$imsControlDisplayField.'</h6>
														<!-- <p class="text-muted">Overall</p> -->
														<h1 class="font-light d-inline">'.$imsControlCount.'</h1>
													</div>
												</div>');
		$totalCards++;
	}
	if (!empty($customDisplayField1)) {
		array_push($summaryContent_html, '<div class="card">
												<div class="card-body text-center">
													<h6 class="card-title text-muted m-b-0">'.$customDisplayField1.'</h6>
													<!-- <p class="text-muted"></p> -->
													<h1 class="font-light d-inline">'.$customDisplayValue1.'</h1>
												</div>
											</div>');
		$totalCards++;
	}
	if (!empty($customDisplayField2)) {
		array_push($summaryContent_html, '<div class="card">
												<div class="card-body text-center">
													<h6 class="card-title text-muted m-b-0">'.$customDisplayField2.'</h6>
													<!-- <p class="text-muted"></p> -->
													<h1 class="font-light d-inline">'.$customDisplayValue2.'</h1>
												</div>
											</div>');
		$totalCards++;
	}

	$cardsColumnLength = 12;
	switch($totalCards){
		case 1: $cardsColumnLength = 12;	break;
		case 2:	$cardsColumnLength = 6;		break;
		case 3:	$cardsColumnLength = 4;		break;
		case 4:	$cardsColumnLength = 3;		break;
		case 5:	$cardsColumnLength = 2;		break;
		case 6:	$cardsColumnLength = 2;		break;
	}

	$_summaryContent_html = '';
	for($x=0;$x<$totalCards;$x++){
		$_summaryContent_html = $_summaryContent_html.'<div class="col-lg-'.$cardsColumnLength.' col-md-4 col-sm-6 col-xs-6">'.$summaryContent_html[$x].'</div>';
	}

	$summaryTemplate = <<<HTML
	<style>
		.panel-body-description{
			margin-top: 10px;
			height: 100px;
			overflow: auto;
		}
		.panel-body .btn img{
			margin: 0 10px;
			max-height: 32px;
		}
	</style>
		<div class="summary-counter-wrapper">
			<!-- Row -->
			<div class="row justify-content-md-center">
				$_summaryContent_html
			</div>
		</div>
HTML;
	// only show summary counters except for these tables
	if (in_array($tableName, ['actcard', 'approval', 'batches', 'categories', 'eventnotification', 'imscontrol', 'imsreport', 'item', 'kpi', 'leadership', 'membership_company', 'membership_grouppermissions', 'membership_groups', 'membership_userpermissions', 'membership_userrecords', 'membership_users', 'personnalfile', 'recruitment', 'reportcomment', 'resources', 'softboardcomment', 'summary_dashboard', 'teamsoftboard', 'transactions'])){
		return '';
	}
	else
		return $summaryTemplate;
}
