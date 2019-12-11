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
	if (!empty($reviewDisplayField)) $totalCards++;
	if (!empty($approvalDisplayField)) $totalCards++;
	if (!empty($imsControlDisplayField)) $totalCards++;
	if (!empty($customDisplayField1)) $totalCards++;
	if (!empty($customDisplayField2)) $totalCards++;

	$cardsColumnLength = 12;
	switch($totalCards){
		case 1: $cardsColumnLength = 12;	break;
		case 2:	$cardsColumnLength = 6;		break;
		case 3:	$cardsColumnLength = 4;		break;
		case 4:	$cardsColumnLength = 3;		break;
		case 5:	$cardsColumnLength = 2;		break;
		case 6:	$cardsColumnLength = 2;		break;
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

	<div id="page-wrapper">
		<div class="ims-infobox-wrapper">
			<div class="row ">
				<!-- total count -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$totalCount</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$totalDisplayField</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

				<!-- review count -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$reviewCount</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$reviewDisplayField</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

				<!-- approval count -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$approvalCount</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$approvalDisplayField</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

				<!-- IMS control count -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$imsControlCount</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$imsControlDisplayField</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

				<!-- Custom Field 1 -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$customDisplayValue1</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$customDisplayField1</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

				<!-- Custom Field 2 -->
				<div class="col-lg-2 col-md-6" style="margin: 10px 0;">
					<div class="panel panel-primary" >
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" ></i></span>
								</div>
								<div class="col-xs-9 text-right">
									<span class="ims-info-content">
										<div class="huge" >$customDisplayValue2</div>
									</span>
								</div>
							</div>
								<div class="panel-footer" style="background-color: #fff;">
									<span class="pull-left" style="color: black;">$customDisplayField2</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
							</div>
						</div>
						
					</div>
				</div>

			</div>
		</div>
	</div>
HTML;

	return $summaryTemplate;
}
