<?php if(!isset($Translation)){ @header('Location: index.php'); exit; } ?>
<?php include_once("{$currDir}/header.php"); ?>
<?php @include("{$currDir}/hooks/links-home.php"); ?>
<?php $memberInfo = getMemberInfo(); ?>

<?php
	/*
		Classes of first and other blocks
		---------------------------------
		For possible classes, refer to the Bootstrap grid columns, panels and buttons documentation:
			Grid columns: http://getbootstrap.com/css/#grid
			Panels: http://getbootstrap.com/components/#panels
			Buttons: http://getbootstrap.com/css/#buttons
	*/
	$block_classes = array(
		'first' => array(
			'grid_column' => 'col-lg-12',
			'panel' => 'panel-warning',
			'link' => 'btn-warning'
		),
		'other' => array(
			'grid_column' => 'col-lg-12',
			'panel' => 'panel-info',
			'link' => 'btn-info'
		)
	);
?>

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



<div class="navbar-default sidebar" role="navigation" style="display: none">
    <div class="sidebar-nav navbar-collapse1" id="dash-sidebar-nav" > 
        <ul class="nav" id="side-menu">
<?php
	/* accessible tables */
	$arrTables = get_tables_info();
	if(is_array($arrTables) && count($arrTables)){
		/* how many table groups do we have? */
		$groups = get_table_groups();
		$multiple_groups = (count($groups) > 1 ? true : false);

		/* construct $tg: table list grouped by table group */
		$tg = array();
		if(count($groups)){
			foreach($groups as $grp => $tables){
				foreach($tables as $tn){
					$tg[$tn] = $grp;
				}
			}
		}

		$i = 0; $current_group = '';
		foreach($tg as $tn => $tgroup){
			$tc = $arrTables[$tn];
			/* is the current table filter-first? */
			$tChkFF = array_search($tn, array());
			/* hide current table in homepage? */
			$tChkHL = array_search($tn, array(''));
			/* allow homepage 'add new' for current table? */
			$tChkAHAN = array_search($tn, array('OrgContentContext','Marketing','Client','Inquiry','DesignProposal','ContractDeployment','employees','Recruitment','PersonnalFile','Competency','Training','JD_JS','InOutRegister','vendor','ManagingVendor','VenPerformance','Logistics','Inventory','CalibrationCtrl','WorkOrder','MWO','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','LogisticRequest','orders','Quotation','PurchaseOrder','DeliveryOrder','AccountPayables','Item','categories','batches','transactions','CommConsParticipate','ToolBoxMeeting','Bi_WeeklyMeeting','QuarterlyMeeting','Campaign','DrillNInspection','ManagementVisit','EventNotification','ActCard','KM','LegalRegister','RiskandOpportunity','DocControl','DCN','ObsoleteRec','QA','ERP','WorkEnvMonitoring','ScheduleWaste','IncidentReporting','MgtofChange','IMStrackingNmonitoring','IMSDataAnalysis','Audit','NonConformance','ContinualImprovement','StakeholderSatisfaction','MRM','WorkLocation','WorkPermit','ProjectTeam','resources','projects','PROInitiation','PROPlanning','PROExecution','DailyProgressReport','MonthlyTimesheet','Breakdown','PROControlMonitoring','PROVariation','PROCompletion','Receivables','ClaimRecord','TeamSoftBoard','SoftboardComment','IMSReport','ReportComment','Leadership','Approval','IMSControl','membership_company','kpi','summary_dashboard'));

			/* homepageShowCount for current table? */
			$count_badge = '';
			if($tc['homepageShowCount']){
				// $sql_from = get_sql_from($tn);
				$count_records = ($tn ? sqlValue(get_summary_select_sql($tn, 0)) : 0);
				$count_badge = '<span class="hspacer-lg text-bold pull-right" style="font-weight: normal;font-size: 12px;">' . number_format($count_records) . '</span>';
			}

			$t_perm = getTablePermissions($tn);
			$can_insert = $t_perm['insert'];

			$searchFirst = (($tChkFF !== false && $tChkFF !== null) ? '?Filter_x=1' : '');
			?>
				<?php if(!$i && !$multiple_groups){ /* no grouping, begin row */ ?>

					<div class="row table_links">
				<?php } ?>
				<?php if($multiple_groups && $current_group != $tgroup){ /* grouping, begin group & row */ ?>
					<?php if($current_group != ''){ /* not first group, so we should first end previous group */ ?>

							</div><!-- /.table_links -->
							<div class="row custom_links">
								<?php
									/* custom home links for current group, as defined in "hooks/links-home.php" */
									echo get_home_links($homeLinks, $block_classes['other'], $current_group);
								?>
							</div>
						</div><!-- /.collapse -->
					<?php } ?>
					<?php $current_group = $tgroup; ?>
                    <li class="submenu">
						<a data-toggle="collapse" href="#group-<?php echo md5($tgroup); ?>" style="height: 50px;font-size: 14px;line-height: 30px;" > <i id="<?php echo  $tn; ?>-mainIco" class="fa fa-briefcase" aria-hidden="true" style="margin-right: 10px;"></i> <?php echo $tgroup; ?> <span class="pull-right"><b class="caret"></b></span></a>
					</li>
                    <div class="collapse" id="group-<?php echo md5($tgroup); ?>">
						<div class="row table_links">
				<?php } ?>

					<?php if($tChkHL === false || $tChkHL === null){ /* if table is not set as hidden in homepage */ ?>
						<div id="<?php echo $tn; ?>-tile" class="listChild <?php echo (!$i ? $block_classes['first']['grid_column'] : $block_classes['other']['grid_column']); ?>">
							<div class="panel1 <?php /*echo (!$i ? $block_classes['first']['panel'] : $block_classes['other']['panel']); */?>" style="padding: 2px 6px;">
								<li class="submenu">
									<?php if($can_insert && $tChkAHAN !== false && $tChkAHAN !== null){ ?>

										<div class="btn-group" style="width: 100%;">
										   <a style="width: 85%;text-align: left; white-space: pre-wrap;" class="btn btn-lg1 <?php /*echo (!$i ? $block_classes['first']['link'] : $block_classes['other']['link']); */?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($tc['Description']))); ?>" href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>"><?php /*echo ($tc['tableIcon'] ? '<img src="' . $tc['tableIcon'] . '">' : '');*/?><?php echo $tc['Caption']; ?><?php /*echo $count_badge; */?>
										   <!-- <a id="<?php /*echo $tn; */?>_add_new" style="width: 15%;" class="btn btn-add-new btn-xs btn-info<?php /*echo (!$i ? $block_classes['first']['link'] : $block_classes['other']['link']); */?>" title="<?php /* echo html_attr($Translation['Add New']); */?>" href="<?php /* echo $tn; */?>_view.php?addNew_x=1"><i class="glyphicon glyphicon-plus"></i></a> -->
                                           <a class="badge badge-success pull-right sidebar-badge" href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>"><?php echo $count_badge; ?></a>
										   </a>
										</div>
									<?php }else{ ?>

										<a class="btn btn-block btn-lg  <?php echo (!$i ? $block_classes['first']['link'] : $block_classes['other']['link']); ?>" title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($tc['Description']))); ?>" href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>"><?php /*echo ($tc['tableIcon'] ? '<img src="' . $tc['tableIcon'] . '">' : '');*/?><strong class="table-caption"><?php echo $tc['Caption']; ?></strong><?php echo $count_badge; ?></a>
									<?php } ?>

									<!-- <div class="panel-body-description"><?php /*echo $tc['Description']; */?></div> -->
								</li>
							</div>
						</div>
					<?php } ?>
				<?php if($i == (count($arrTables) - 1) && !$multiple_groups){ /* no grouping, end row */ ?>

					</div> <!-- /.table_links -->

					<div class="row custom_links" id="custom_links">
						<?php
							/* custom home links, as defined in "hooks/links-home.php" */
							echo get_home_links($homeLinks, $block_classes['other'], '*');
						?>
					</div>

				<?php } ?>
				<?php if($i == (count($arrTables) - 1) && $multiple_groups){ /* grouping, end last group & row */ ?>

							</div> <!-- /.table_links -->
							<div class="row custom_links" id="custom_links">
								<?php
									/* custom home links for last table group, as defined in "hooks/links-home.php" */
									echo get_home_links($homeLinks, $block_classes['other'], $tgroup);

									/* custom home links having no table groups, as defined in "hooks/links-home.php" */
									echo get_home_links($homeLinks, $block_classes['other']);
								?>
							</div>
						</div><!-- /.collapse -->
				<?php } ?>
			<?php
			$i++;
		}
	}else{
		?><script>window.location='index.php?signIn=1';</script><?php
	}
?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<div id="page-wrapper" class="page-wrapper">

	<!-- <div class="row"><div id="upPageHeader" class="panel-header panel-header-sm"></div></div> -->
    <!-- <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header" style="color: #777;">DASHBOARD</h3>
        </div>
	</div> -->

	<!-- <div class="row ">
		<div class="col-lg-12 col-md-6 ">
			<div class="card card-chart" style="padding: 15px 15px 0;border: 0;margin: 10px 0;">
				<div class="card-header">
				<h4 class="card-title">Performance</h4>
				</div>
				<div class="card-body">
				<div id="morris-bar-chart"></div>
				</div>
			</div>
		</div>
	</div> -->

	<!-- <div class="ims-infobox-wrapper">
		<div class="row ">
				<?php
					// $arrTables = get_tables_info();
					// if(is_array($arrTables) && count($arrTables)){
					// 	$groups = get_table_groups();
					// 	$multiple_groups = (count($groups) > 1 ? true : false);
					// 	$tg = array();
					// 	if(count($groups)){
					// 		foreach($groups as $grp => $tables){
					// 			foreach($tables as $tn){
					// 				$tg[$tn] = $grp;
					// 			}
					// 		}
					// 	}
					// 	$i = 0; $current_group = '';
					// 	foreach($tg as $tn => $tgroup){
					// 		$tc = $arrTables[$tn];
					// 		$tChkFF = array_search($tn, array());
					// 		$tChkHL = array_search($tn, array(''));
					// 		$tChkAHAN = array_search($tn, array('OrgContentContext','Marketing','Client','Inquiry','DesignProposal','ContractDeployment','employees','Recruitment','PersonnalFile','Competency','Training','JD_JS','InOutRegister','vendor','ManagingVendor','VenPerformance','Logistics','Inventory','CalibrationCtrl','WorkOrder','MWO','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','LogisticRequest','orders','Quotation','PurchaseOrder','DeliveryOrder','AccountPayables','Item','categories','batches','transactions','CommConsParticipate','ToolBoxMeeting','Bi_WeeklyMeeting','QuarterlyMeeting','Campaign','DrillNInspection','ManagementVisit','EventNotification','ActCard','KM','LegalRegister','RiskandOpportunity','DocControl','DCN','ObsoleteRec','QA','ERP','WorkEnvMonitoring','ScheduleWaste','IncidentReporting','MgtofChange','IMStrackingNmonitoring','IMSDataAnalysis','Audit','NonConformance','ContinualImprovement','StakeholderSatisfaction','MRM','WorkLocation','WorkPermit','ProjectTeam','resources','projects','PROInitiation','PROPlanning','PROExecution','DailyProgressReport','MonthlyTimesheet','Breakdown','PROControlMonitoring','PROVariation','PROCompletion','Receivables','ClaimRecord','TeamSoftBoard','SoftboardComment','IMSReport','ReportComment','Leadership','Approval','IMSControl','membership_company','kpi','summary_dashboard'));
					// 		$count_badge = '';
					// 		if($tc['homepageShowCount']){
								// $sql_from = get_sql_from($tn);
							// 	$count_records = ($tn ? sqlValue(get_summary_select_sql($tn, 0)) : 0);
							// 	$count_badge = '<span class="">' . number_format($count_records) . '</span>';
							// }
							// $t_perm = getTablePermissions($tn);
							// $can_insert = $t_perm['insert'];
							// $searchFirst = (($tChkFF !== false && $tChkFF !== null) ? '?Filter_x=1' : '');
							?>
								<?php // if($tChkHL === false || $tChkHL === null){ /* if table is not set as hidden in homepage */ ?>
									<?php 
										
										// if($tc['Caption'] == "Request Order" || $tc['Caption'] == "Client & Main Contractor" || $tc['Caption'] =="Organization Softboard"|| $tc['Caption'] == "IMS Complaint Report"){
											?>
												

												<div class="col-lg-3 col-md-6">
												<div class="card dashboard-stat">
													<div class="card-body">
														<div class="row">
															<div class="col-8" id="counter-<?php echo $tn; ?>"><span class="display-6"><?php echo $count_badge;?></span>
																<h6 class="text-muted" id="caption-<?php echo $tn; ?>"><?php echo $tc['Caption'];?></h6></div>
																<div class="ims-info-icon dashboard-visual">
																	<i class="fa fa-folder-open-o fa-5x" id="fa-<?php echo $tn; ?>"></i>
																</div>
															<div class="col-4 align-self-center text-right  p-l-0">
																<div id="sparklinedash3"></div>
																<span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" id="fa-<?php echo $tn; ?>"></i></span>
															</div>
															<a href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>" id="href-<?php echo $tn; ?>" class="view-all-link">
																<div class="panel-footer" style="background-color: #fff;">
																	<span class="pull-left">View Details</span>
																	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																	<div class="clearfix"></div>
																</div>
															</a>
														</div>
													</div>
												</div>
											</div>
											<?php
										// }
									?>
								<?php // } ?>
							<?php
					// 		$i++;
					// 	}
					// }
				?>
		</div>
		
	</div> -->
	<!-- ims-infobox-wrapper -->

	<!-- <div class="row">
		<div class="col-lg-6 col-md-6 ">
			<div class="card card-chart">
				<div class="card-header">
					<h4 class="card-title"><a href="TeamSoftBoard_view.php">Organization Softboard</a></h4>
				</div>
				<div class="card-body" id="if1">
					<iframe frameborder="0" width="100%" style="position: relative;min-height: 300px;" src="TeamSoftBoard_view.php"></iframe>
				</div>
				<div class="card-footer">
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 ">
			<div class="card card-chart">
				<div class="card-header" > 
					<h4 class="card-title"><a href="IMSReport_view.php">Complaint Report</a></h4>
				</div>
				<div class="card-body" id="if2">
					<iframe frameborder="0" width="100%" style="position: relative;min-height: 300px;" src="IMSReport_view.php"></iframe>
				</div>
				<div class="card-footer">
				</div>
			</div>
		</div>
	</div>
	
	<iframe id="AccountPayables_view" frameborder="0" style="display:none" src="AccountPayables_view.php"></iframe>
	<iframe id="ClaimRecord_view" frameborder="0" style="display:none" src="ClaimRecord_view.php"></iframe> -->

	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- <div class="row page-titles">
			<div class="col-md-12 align-self-center">
				<h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div> -->
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
			<!-- Column -->
			<div class="col-lg-2 col-md-6 pr-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Average Hours</h4>
						<!-- <h4 class="card-title m-b-0">My Work Days</h4> -->
						<p class="text-muted">Weekly Task Completion</p>
						<div class="row">
							<?php
								$myHoursWeek = sqlValue("SELECT COALESCE(SEC_TO_TIME(AVG(`dateUpdated` - `dateAdded`)), '00:00:00.0000') as my_hours_week from `membership_userrecords` WHERE `memberID` = '" . makeSafe($memberInfo['username']) . "' and (YEARWEEK(from_unixtime(`dateAdded`), 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(from_unixtime(`dateUpdated`), 1) = YEARWEEK(CURDATE(), 1))");
								$myHoursWeekArr = explode(":", $myHoursWeek, 2);
								// $myHoursWeek = sqlValue("SELECT COALESCE(SUM(`dateUpdated` - `dateAdded`) / 24 / 8, 0) as my_hours_week from `membership_userrecords` WHERE `memberID` = '" . makeSafe($memberInfo['username']) . "' and (YEARWEEK(from_unixtime(`dateAdded`), 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(from_unixtime(`dateUpdated`), 1) = YEARWEEK(CURDATE(), 1))");
								// if(isset($myHoursWeek) && $myHoursWeek != 0){
								// 	$myHoursWeekArr = secondsToTime(intval($myHoursWeek));
								// 	$myHoursWeekArr = explode(" ", $myHoursWeekArr, 4);
								// }
								// else {
								// 	$myHoursWeekArr = [0, 0, 0, 0];
								// }
							?>
							<div class="col-12"><span><h2 class="font-light d-inline"><?php echo number_format($myHoursWeekArr[0]) ?></h2><span class="text-muted"> h</span> <h2 class="font-light d-inline"><?php echo number_format($myHoursWeekArr[1]) ?></h2><span class="text-muted"> m</span></span></div>
							<!-- <div class="col-12"><span><h2 class="font-light d-inline"><?php echo number_format($myHoursWeekArr[0]) ?></h2><span class="text-muted"> days</span> <h2 class="font-light d-inline"><?php echo number_format($myHoursWeekArr[2]) ?></h2><span class="text-muted"> h</span></span></div> -->
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/hours.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-2 col-md-6 px-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Project Claimed</h4>
						<p class="text-muted">Lump Sum Amount</p>
						<div class="row">
							<?php
								$claimTotal=sqlValue("SELECT COALESCE(sum(fo_UnitPrice), 0.00) FROM `ClaimRecord`");
								$claimTotalFormatted = '';
								$claimTotalSymbol = '';
								if($claimTotal > 1000) {
									$claimTotalFormatted = thousandsCurrencyFormat($claimTotal);
									$claimTotalSymbol = substr($claimTotalFormatted, -1);
								}
							?>
							<div class="col-12"><span><span class="text-muted">RM </span> <h2 class="font-light d-inline"><?php if ($claimTotalFormatted != '') echo substr($claimTotalFormatted, 0, -1); else echo round($claimTotal, 2); ?></h2><span class="text-muted"> <?php echo $claimTotalSymbol ?></span></span></div>
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/claim.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-2 col-md-6 px-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Inquiries</h4>
						<p class="text-muted">This Month</p>
						<div class="row">
							<?php
								$inquiryThisMonth=sqlValue("SELECT count(1) FROM `Inquiry` WHERE (MONTH(`fo_InquiryDate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_InquiryDate`) = YEAR(CURRENT_DATE()))");
							?>
							<div class="col-12"><span><h2 class="font-light d-inline"><?php echo number_format($inquiryThisMonth) ?></h2><span class="text-muted"> quotes</span></span></div>
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/inquiries.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-2 col-md-6 px-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Invoices</h4>
						<p class="text-muted">Outstanding</p>
						<div class="row">
							<?php
								$receivableTotalInitial=sqlValue("SELECT COALESCE(sum(`fo_UnitPrice`), 0.00) FROM `Receivables`");
								$receivableTotal = ($claimTotal - $receivableTotalInitial);
								$receivableTotalFormatted = '';
								$receivableTotalSymbol = '';
								if($receivableTotal > 1000) {
									$receivableTotalFormatted = thousandsCurrencyFormat($receivableTotal);
									$receivableTotalSymbol = substr($receivableTotalFormatted, -1);
								}
							?>
							<div class="col-12"><span><span class="text-muted">RM </span> <h2 class="font-light d-inline"><?php if ($receivableTotalFormatted != '') echo substr($receivableTotalFormatted, 0, -1); else echo round($receivableTotal, 2); ?></h2><span class="text-muted"> <?php echo $receivableTotalSymbol ?></span></span></div>
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/invoice.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-2 col-md-6 px-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Revenue</h4>
						<p class="text-muted">This Month</p>
						<div class="row">
							<?php
								$receivableThisMonth=sqlValue("SELECT COALESCE(sum(`fo_UnitPrice`), 0.00) FROM `Receivables` WHERE (MONTH(`fo_Registerdate`) = MONTH(CURRENT_DATE()) and YEAR(`fo_Registerdate`) = YEAR(CURRENT_DATE()))");
								$receivableThisMonthFormatted = '';
								$receivableThisMonthSymbol = '';
								if($receivableThisMonth > 1000) {
									$receivableThisMonthFormatted = thousandsCurrencyFormat($receivableThisMonth);
									$receivableThisMonthSymbol = substr($receivableThisMonthFormatted, -1);
								}
							?>
							<div class="col-12"><span><span class="text-muted">RM </span> <h2 class="font-light d-inline"><?php if ($receivableThisMonthFormatted != '') echo substr($receivableThisMonthFormatted, 0, -1); else echo round($receivableThisMonth, 2); ?></h2><span class="text-muted"> <?php echo $receivableThisMonthSymbol ?></span></span></div>
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/revenue.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-2 col-md-6 pl-2">
				<div class="card my-3">
					<div class="card-body" style="max-height: 140px; overflow: hidden;">
						<h4 class="card-title m-b-0">Payable</h4>
						<p class="text-muted">This Month</p>
						<div class="row">
							<?php
								$payableThisMonth=sqlValue("SELECT coalesce(sum(`fo_UnitPrice`), 0.00) from `AccountPayables` where MONTH(`ot_ap_filed`) = MONTH(CURRENT_DATE()) and YEAR(`ot_ap_filed`) = YEAR(CURRENT_DATE())");
								$payableThisMonthFormatted = '';
								$payableThisMonthSymbol = '';
								if($payableThisMonth > 1000) {
									$payableThisMonthFormatted = thousandsCurrencyFormat($payableThisMonth);
									$payableThisMonthSymbol = substr($payableThisMonthFormatted, -1);
								}
							?>
							<div class="col-12"><span><span class="text-muted">RM</span> <h2 class="font-light d-inline"><?php if ($payableThisMonthFormatted != '') echo substr($payableThisMonthFormatted, 0, -1); else echo round($payableThisMonth, 2); ?></h2><span class="text-muted"> <?php echo $payableThisMonthSymbol ?></span></span></div>
							<img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/payable.svg">
						</div>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
		<!-- Row -->
		<!-- Row -->
		<div class="row">
			<!-- Column -->
			<div class="col-lg-4 pr-2">
				<div class="card my-3">
					<div class="card-body">
					<a href="calendar.php"><h4 class="card-title">Calender - Weekly</h4></a>
						<!-- ============================================================== -->
						<!-- To do list widgets -->
						<!-- ============================================================== -->
						<div class="to-do-widget m-t-20" style="height: 358px;overflow: scroll;">
							<!-- /.modal -->
							<ul class="list-task todo-list list-group m-b-0">
								<?php
									$activeEvents = sql("SELECT `id`, `title`, `start`, `end`, `tableName`, `pkValue`, `ot_ap_Approval`  from `events` where ((YEARWEEK(`start`, 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(coalesce(`end`, `start`), 1) = YEARWEEK(CURDATE(), 1))) and `ot_ap_Approval` <> 4 order by `end` desc", $eo);
									if (isset($activeEvents) && $activeEvents->num_rows > 0) {
										while($row=db_fetch_row($activeEvents)){ 
											$currentStatus = ''; $currentStartDate = ''; $currentEndDate = '';
											switch ($row[6]){
												case '1':
													$currentStatus = "<span class='label label-light-danger pull-right'>Open</span> ";
													break;
												case '2':
													$currentStatus = "<span class='label label-light-info pull-right'>Ongoing</span> ";
													break;
												case '3':
													$currentStatus = "<span class='label label-light-warning pull-right'>Pending</span> ";
													break;
											}
											(parseMySQLDate(substr($row[2],0,10), false) == substr($row[2],0,10)) ? $currentStartDate = date("d M, Y", strtotime(substr($row[2],0,10))) : '' ;
											((isset($row[3]) && !empty($row[3])) && parseMySQLDate(substr($row[3],0,10), false) == substr($row[3],0,10)) ? $currentEndDate   = date("d M, Y", strtotime(substr($row[3],0,10))) : '' ;
								?>
								<li class="list-group-item">
									<h5><a href='<?php echo $row[4]?>_view.php?SelectedID=<?php echo $row[5]?>'><?php echo $row[1] ?><?php echo $currentStatus ?></a></h5>
									<div class="item-date"><?php echo $currentStartDate ?><?php if ($currentEndDate != '') { echo ' - '. $currentEndDate;  } ?></div>
								</li>
								<?php
											
										}
									}
									else {
								?>
								<li class="list-group-item">
									<h5>No active events this week</h5>
									<div class="item-date"></div>
								</li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 px-2">
				<div class="card my-3">
					<div class="card-body">
						<h4 class="card-title">Active Tasks
							<?php if(in_array($memberInfo['groupID'], [2] )) { ?>
							<span class="hspacer-lg fa-pull-right" title="Create new job ticket">
							<a href="WorkOrder_view.php?addNew_x=1">
									<i class="fa fa-plus"></i>
							</a>
							</span>
							<?php } ?>
						</h4>
						
						<!-- ============================================================== -->
						<!-- To do list widgets -->
						<!-- ============================================================== -->
						<div class="message-box" style="height: 358px;overflow: scroll;">
							<!-- /.modal -->
							<ul class="list-task todo-list list-group m-b-0">
								<?php
									$activeTasks = sql("SELECT `id`, `WONumber`, `ot_ap_Approval`, `fo_DueDate` FROM `WorkOrder` WHERE `fo_EmployeeID` = (select `employees`.`EmployeeID` from `employees` where `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "') and `ot_ap_Approval` <> 4 order by `fo_DueDate`", $eo);
									if (isset($activeTasks) && $activeTasks->num_rows > 0) {
										while($row=db_fetch_row($activeTasks)){ 
											$currentStatus = ''; $currentDate = '';
											switch ($row[2]){
												case '1':
													$currentStatus = "<span class='label label-light-danger pull-right'>Open</span> ";
													break;
												case '2':
													$currentStatus = "<span class='label label-light-info pull-right'>Ongoing</span> ";
													break;
												case '3':
													$currentStatus = "<span class='label label-light-warning pull-right'>Pending</span> ";
													break;
											}
											(parseMySQLDate($row[3], false) == $row[3]) ? $currentDate = date("d M, Y", strtotime($row[3])) : '' ;
								?>
								<li class="list-group-item">
									<h5><a href='WorkOrder_view.php?SelectedID=<?php echo $row[0]?>'><?php echo $row[1] ?><?php echo $currentStatus ?></a></h5>
									<div class="item-date"><?php echo $currentDate ?></div>
								</li>
								<?php
											
										}
									}
									else {
								?>
								<li class="list-group-item">
									<h5>No active tasks currently</h5>
									<div class="item-date"></div>
								</li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 pl-2">
				<div class="card my-3">
					<div class="card-body">
						<h4 class="card-title">This Week's Leaderboard</h4>
						<div class="message-box" style="height: 358px;overflow: scroll;">
							<div class="message-widget">
							<?php
								// get top 5 avg task completion time for any form entrys created or modified in current week
								$leaderBoard = sql("SELECT COALESCE(SEC_TO_TIME(AVG(mu.`dateUpdated` - mu.`dateAdded`)), '00:00:00.0000') 'total_hours_this_week', mu.`memberID`, e.`Name` as 'name', SUM(mu.`dateUpdated` - mu.`dateAdded`) as 'total_seconds' from `membership_userrecords` as mu left join `employees` as e on e.`memberID` = mu.`memberID` WHERE (YEARWEEK(from_unixtime(`dateAdded`), 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(from_unixtime(`dateUpdated`), 1) = YEARWEEK(CURDATE(), 1)) group by 2, 3 order by 4 asc limit 5", $eo);
								if (isset($leaderBoard) && $leaderBoard->num_rows > 0) {
									$progressPercentages = []; $leaderBoardStored = [];
									while($row=db_fetch_row($leaderBoard)){ 
										$currSecondsArr[] = $row[3];		// total_seconds for (modified - created)
										$currSecondsArrTotal += $row[3];	// cumulative total_seconds for (modified - created)
										$leaderBoardStored[] = $row;		// current record
									}
									// calculate progress percentages
									for ($i=0; $i< $leaderBoard->num_rows; $i++){
										// make sure division by 0 is avoided
										if($currSecondsArrTotal != 0){
											$progressPercentages[] = round(($currSecondsArr[$i] / $currSecondsArrTotal) * 100, 0);
										}
										else{
											$progressPercentages[] = 0;
										}
									}
									// display avg in hh:mm format
									for ($j=0; $j< count($leaderBoardStored); $j++){
										$currHoursWeekArr = explode(":", $leaderBoardStored[$j][0], 2);
							?>
								<!-- Message -->
								<!-- @TODO: Select one's own records (cannot visit admin/ pages) -->
								<!-- <a <?php if ($memberInfo['admin'] || $memberInfo['username'] == $leaderBoardStored[$j][1]) { ?>href="admin/pageViewRecords.php?memberID=<?php echo $leaderBoardStored[$j][1] ?>" <?php } ?>> -->
								<a <?php if ($memberInfo['admin']) { ?>href="admin/pageViewRecords.php?memberID=<?php echo $leaderBoardStored[$j][1] ?>" <?php } ?>>
									<div class="mail-contnet"><h5><?php echo $leaderBoardStored[$j][2] ?></h5> <span class="time"><?php echo number_format($currHoursWeekArr[0]) ?>h <?php echo number_format($currHoursWeekArr[1]) ?>m</span> </div>
									<div class="progress">
										<div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $progressPercentages[$j]?>%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</a>
							<?php	
									}
								}
								else {
							?>
							<a>
								<div class="mail-contnet"><h5>No active users yet</h5><span class="time">0h 0m</span></div>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" style="width: 0%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</a>
							<?php
								}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row -->
		<!-- Row -->
		<div class="row">
			<div class="col-lg-8 col-md-12 pr-2">
				<div class="card my-3">
					<div class="card-body">
						<h4 class="card-title">Bulletin</h4>
						<?php
							$teamSoftBoardStored = [];
							$teamSoftBoard = sql("SELECT `Postid`, `Title`, `image01`, `TextPost`, `filed`  FROM `TeamSoftBoard` order by 5 desc limit 5", $eo);
							if (isset($teamSoftBoard) && $teamSoftBoard->num_rows > 0) {
								
								while($row=db_fetch_row($teamSoftBoard)){ 
									$teamSoftBoardStored[] = $row;
								}
									
						?>
						<div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel" style="height: 535px;overflow: hidden;">
							<ol class="carousel-indicators">
							<?php
								for ($i=0; $i< count($teamSoftBoardStored); $i++){
							?>
								<li data-target="#carouselExampleIndicators3" data-slide-to="<?php echo $i?>" class="<?php if ($i == 0){ ?>active<?php } ?>"></li>
							<?php
								}
							?>
							</ol>
							<div class="carousel-inner" role="listbox">
								<?php
									$teamSoftBoard = sql("SELECT `Postid`, `Title`, `image01`, `TextPost`, `filed`  FROM `TeamSoftBoard` order by 5 desc limit 5", $eo);
									for ($i=0; $i< count($teamSoftBoardStored); $i++){
										$currentBulletinDate = '';
										(parseMySQLDate(substr($teamSoftBoardStored[$i][4], 0, 10), false) == substr($teamSoftBoardStored[$i][4], 0, 10)) ? $currentBulletinDate = date("d M, Y", strtotime(substr($teamSoftBoardStored[$i][4], 0, 10))) : '' ;
											
								?>
								<div class="carousel-item <?php if ($i == 0){ ?>active" style="max-height: 553px;<?php } ?>">
									<a href="TeamSoftBoard_view.php?SelectedID=<?php echo $teamSoftBoardStored[$i][0] ?>"><img class="img-responsive" src="images/<?php echo $teamSoftBoardStored[$i][2]?>" alt="<?php echo $teamSoftBoardStored[$i][1]?>" style="height: 535px;width:auto;">
									<div class="carousel-caption d-none d-md-block" style="background: #333; padding: 20px; opacity: 0.7;">
										<h3 class="text-white"><?php echo $teamSoftBoardStored[$i][1]?></h3>
										<p style="max-height: 50px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $teamSoftBoardStored[$i][3] ?> <?php if ($currentBulletinDate != '') { echo ' - '. $currentBulletinDate;  } ?></p>
									</div></a>
								</div>
						<?php
									}
							}
							else {
								$teamSoftBoardStored = ['0', 'No team softboard posts yet', 'teamSoftBoardDefault.jpg', '<a href="TeamSoftBoard_view.php" class="text-white">You can be the first to create one!</a>', 'null'];
						?>
								<div class="carousel-item active" style="max-height: 553px;">
									<img class="img-responsive" src="images/<?php echo $teamSoftBoardStored[2]?>" alt="<?php echo $teamSoftBoardStored[2]?>" style="height: 535px;width:auto;">
									<div class="carousel-caption d-none d-md-block" style="background: #333; padding: 20px; opacity: 0.7;">
										<h3 class="text-white"><?php echo $teamSoftBoardStored[1]?></h3>
										<p style="max-height: 50px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $teamSoftBoardStored[3] ?></p>
									</div>
								</div>
						<?php
							}
						?>
							</div>
							<a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
								<i class="fa fa-angle-left" aria-hidden="true" style="font-size: 4rem; color: #333;"></i>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
								<i class="fa fa-angle-right" aria-hidden="true" style="font-size: 4rem; color: #333;"></i>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 pl-2">
				<div class="card my-3">
					<div class="card-body">
						<h4 class="card-title">Complaints</h4>
					</div>
					<!-- ============================================================== -->
					<!-- Comment widgets -->
					<!-- ============================================================== -->
					<div class="comment-widgets">
						<!-- Comment Row -->
						<?php
							$reportComments = sql("SELECT `Postid`, `Title`, `TextPost`, COALESCE(`last_modified`,`filed`), COALESCE(`ClosedIssue`,0)  FROM `IMSReport`  order by 4 desc limit 5", $eo);
							if (isset($reportComments) && $reportComments->num_rows > 0) {
								while($row=db_fetch_row($reportComments)){ 
									$currentStatus = '';
										switch ($row[4]){
											case '0':
												$currentStatus = "<span class='label label-light-danger pull-right'>Open</span> ";
												break;
											case '1':
												$currentStatus = "<span class='label label-light-success pull-right'>Closed</span> ";
												break;
										}
									$currentDate = '';
									(parseMySQLDate(substr($row[3], 0, 10), false) == substr($row[3], 0, 10)) ? $currentDate = date("d M, Y", strtotime(substr($row[3], 0, 10))) : '' ;
						?>
						<div class="d-flex flex-row comment-row">
							<div class="w-100">
								<h5><a href='IMSReport_view.php?SelectedID=<?php echo $row[0]?>'><?php echo $row[1]?><?php echo $currentStatus ?></a></h5>
								<p class="m-b-5" style="max-height: 22px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $row[2]?></p>
								<div class="comment-footer">
									<span class="text-muted pull-right"><?php echo $currentDate?></span>
								</div>
							</div>
						</div>
						<?php		
								}
							}
							else {
						?>
						<div class="d-flex flex-row comment-row">
							<div class="w-100">
								<h5>No complaints so far</h5>
								<p class="m-b-5" style="max-height: 22px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Keep up the good work!</p>
								<div class="comment-footer">
									<span class="text-muted pull-right"></span>
								</div>
							</div>
						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End PAge Content -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Container fluid  -->
	<!-- ============================================================== -->

</div>
<!-- /#page-wrapper -->
<script>
	$j(function(){
		//demo.initBarChartMoris();
		// $('.dropdown-menu').on('click', function (e) {
		// 	e.stopPropagation();
		// });
		// $('.dropdown-toggle').on('click', function (e) {
		// 	e.stopPropagation();
		// });
		$j('.container').removeClass('container').addClass('container-full');
		$j('.sidebar').perfectScrollbar();
		$j('#page-wrapper').perfectScrollbar();
		// $j("li a:contains('Misc.')").hide();
		var table_descriptions_exist = false;
		$j('div[id$="-tile"] .panel-body-description').each(function(){
			if($j.trim($j(this).html()).length) table_descriptions_exist = true;
		});
		//$j('.navbar-default.sidebar').css("background","#f96332")
		$j('#fa-WorkLocation').removeClass().addClass('fa fa-map-marker fa-5x');
		$j('#fa-Client').removeClass().addClass('fa fa-users fa-5x');
		$j('#fa-Inquiry').removeClass().addClass('fa fa-paperclip fa-5x');
		// $j('#WorkLocation-cd').css("margin" ,"55px 0px");

		$j('#panel-orders').removeClass().addClass('panel panel-green');
		$j('#panel-TeamSoftBoard').removeClass().addClass('panel panel-yellow');
		$j('#panel-IMSReport').removeClass().addClass('panel panel-red');

		$j('#counter-TeamSoftBoard').find('span').text(0)
		$j('#counter-IMSReport').find('span').text(0)

		$j('#caption-TeamSoftBoard').text('Account Payables')
		$j('#caption-IMSReport').text('Claim Submission')
		
        // icon
        $j('#fa-orders').removeClass().addClass('fa fa-file-o fa-5x');
        $j('#fa-TeamSoftBoard').removeClass().addClass('fa fa-briefcase fa-5x');
        $j('#fa-IMSReport').removeClass().addClass('fa fa-check-square-o fa-5x');

		//link
		$j('#href-TeamSoftBoard').attr('href','AccountPayables_view.php')
		$j('#href-IMSReport').attr('href','ClaimRecord_view.php')

		setTimeout(function(){ 
			var getValAccountPayables_view = $j('#AccountPayables_view').contents().find('table tbody').find('tr').length - 1
			if (getValAccountPayables_view > 0){
				$j('#counter-TeamSoftBoard').find('span').text(getValAccountPayables_view)
			}
			var getValueClaimRecord_view = $j('#ClaimRecord_view').contents().find('table tbody').find('tr').length - 1
			if(getValueClaimRecord_view >  0){
				$j('#counter-IMSReport').find('span').text(getValueClaimRecord_view)
			}

		}, 4000);

		
		$j(window).resize(function() {
			if($j(window).width() <= 750){
				$j('.hidden-print').eq(1).css('display','none');
				$j('.hidden-print').eq(2).css('display','none');
				$j('#dash-sidebar-nav').css('margin-top',50);
				$j('.ps__scrollbar-x').css('display','none');
				$j('#side-menu').css('display','none');
				$j('#upperNav').css('display','inline-block');
				$j('#if1').css({"overflow":"scroll","-webkit-overflow-scrolling":"touch"})
				$j('#if2').css({"overflow":"scroll","-webkit-overflow-scrolling":"touch"})
				//style="overflow: scroll; -webkit-overflow-scrolling: touch;"
			}else{
				$j('.hidden-print').eq(1).css('display','block');
				$j('.hidden-print').eq(2).css('display','none');
				$j('#dash-sidebar-nav').css('margin-top',0)
				$j('#side-menu').css('display','block');
				$j('#upperNav').css('display','none');
				$j('#if1').css({"overflow":"unset","-webkit-overflow-scrolling":"touch"})
				$j('#if2').css({"overflow":"unset","-webkit-overflow-scrolling":"touch"})
			}

		});

		if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)){
			$j('iframe').css({'width': '1px','min-width': '100%','*width': '100%'})
		}else{
			//console.log('not match')
		}

		// Morris.Bar({
        // element: 'morris-bar-chart',
        // data: [{
        //     y: 'Jan',
        //     a: 100,
		// 	b: 90,
		// 	c: 90,
		// 	d: 80
		// 	}, {
		// 		y: 'Feb',
		// 		a: 75,
		// 		b: 65,
		// 		c: 55,
		// 		d: 80
		// 	}, {
		// 		y: 'Mar',
		// 		a: 50,
		// 		b: 40,
		// 		c: 50,
		// 		d: 40
		// 	}, {
		// 		y: 'Apr',
		// 		a: 75,
		// 		b: 65,
		// 		c: 60,
		// 		d: 65
		// 	}, {
		// 		y: 'May',
		// 		a: 50,
		// 		b: 40,
		// 		c: 50,
		// 		d: 45
		// 	}, {
		// 		y: 'Jun',
		// 		a: 75,
		// 		b: 65,
		// 		c: 50,
		// 		d: 40
		// 	}, {
		// 		y: 'Jul',
		// 		a: 80,
		// 		b: 90,
		// 		c: 80,
		// 		d: 85
		// 	}, {
		// 		y: 'Aug',
		// 		a: 80,
		// 		b: 90,
		// 		c: 80,
		// 		d: 70
		// 	}, {
		// 		y: 'Sep',
		// 		a: 55,
		// 		b: 75,
		// 		c: 80,
		// 		d: 85
		// 	}, {
		// 		y: 'Oct',
		// 		a: 60,
		// 		b: 70,
		// 		c: 70,
		// 		d: 70
		// 	}, {
		// 		y: 'Nov',
		// 		a: 85,
		// 		b: 90,
		// 		c: 80,
		// 		d: 70
		// 	}, {
		// 		y: 'Dec',
		// 		a: 60,
		// 		b: 75,
		// 		c: 80,
		// 		d: 70
		// 	}
		// ],
		// 	xkey: 'y',
		// 	ykeys: ['a', 'b' , 'c', 'd'],
		// 	labels: ['Marketing', 'Project', 'Leadership', 'Non Conformance'],
		// 	hideHover: 'auto',
		// 	resize: true
		// });
		
		
		$j('#projects-cd').css("margin" ,"15px 0px");
		$j('#OrgContentContext-mainIco').removeClass().addClass('fa fa-users');
		$j('#employees-mainIco').removeClass().addClass('fa fa-user-secret');
		$j('#orders-mainIco').removeClass().addClass('fa fa-database');
		$j('#vendor-mainIco').removeClass().addClass('fa fa-building');
		$j('#CommConsParticipate-mainIco').removeClass().addClass('fa fa-medkit');
		$j('#TeamSoftBoard-mainIco').removeClass().addClass('fa fa-pie-chart');
		

		if(!table_descriptions_exist){
			$j('div[id$="-tile"] .panel-body-description').css({height: 'auto'});
		}

		$j('.panel-body .btn').height(32);

		$j('.btn-add-new').click(function(){
			var tn = $j(this).attr('id').replace(/_add_new$/, '');
			modal_window({
				url: tn + '_view.php?addNew_x=1&Embedded=1',
				size: 'full',
				title: $j(this).prev().children('.table-caption').text() + ": <?php echo html_attr($Translation['Add New']); ?>" 
			});
			return false;
		});

		/* adjust arrow directions on opening/closing groups, and initially open first group */
		$j('.collapser').click(function(){
			$j(this).children('.glyphicon').toggleClass('glyphicon-chevron-right glyphicon-chevron-down');
		});

		/* hide empty table groups */
		$j('.collapser').each(function(){
			var target = $j(this).attr('href');
			if(!$j(target + " .row div").length) $j(this).hide();
		});
		/*$j('.collapser:visible').eq(0).click();*/
	});
</script>

<?php include_once("$currDir/footer.php"); ?>
