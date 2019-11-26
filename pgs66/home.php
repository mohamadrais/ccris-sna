<?php if(!isset($Translation)){ @header('Location: index.php'); exit; } ?>
<?php include_once("{$currDir}/header.php"); ?>
<?php @include("{$currDir}/hooks/links-home.php"); ?>

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



<div class="navbar-default sidebar" role="navigation">
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
			$tChkHL = array_search($tn, array('DesignProposal','ContractDeployment','Recruitment','PersonnalFile','Competency','Training','ManagingVendor','VenPerformance','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','Quotation','PurchaseOrder','DeliveryOrder','AccountPayables','ToolBoxMeeting','Bi_WeeklyMeeting','QuarterlyMeeting','Campaign','DrillNInspection','ManagementVisit','EventNotification','ActCard','DCN','ObsoleteRec','WorkPermit','DailyProgressReport','MonthlyTimesheet','Breakdown','ClaimRecord','SoftboardComment','ReportComment'));
			/* allow homepage 'add new' for current table? */
			$tChkAHAN = array_search($tn, array('OrgContentContext','Marketing','Client','Inquiry','DesignProposal','ContractDeployment','employees','Recruitment','PersonnalFile','Competency','Training','JD_JS','InOutRegister','vendor','ManagingVendor','VenPerformance','Logistics','Inventory','CalibrationCtrl','WorkOrder','MWO','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','LogisticRequest','orders','PurchaseOrder','DeliveryOrder','AccountPayables','Item','categories','batches','transactions','CommConsParticipate','KM','LegalRegister','RiskandOpportunity','DocControl','QA','ERP','WorkEnvMonitoring','ScheduleWaste','IncidentReporting','MgtofChange','IMStrackingNmonitoring','IMSDataAnalysis','Audit','NonConformance','ContinualImprovement','StakeholderSatisfaction','MRM','projects','WorkLocation','ProjectTeam','resources','PROInitiation','PROPlanning','PROExecution','DailyProgressReport','MonthlyTimesheet','Breakdown','PROControlMonitoring','PROVariation','PROCompletion','Receivables','ClaimRecord','TeamSoftBoard','IMSReport','Leadership','Approval','IMSControl'));

			/* homepageShowCount for current table? */
			$count_badge = '';
			if($tc['homepageShowCount']){
				$sql_from = get_sql_from($tn);
				$count_records = ($sql_from ? sqlValue("select count(1) from " . $sql_from) : 0);
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

	<div class="ims-infobox-wrapper">
		<div class="row ">
				<?php
					$arrTables = get_tables_info();
					if(is_array($arrTables) && count($arrTables)){
						$groups = get_table_groups();
						$multiple_groups = (count($groups) > 1 ? true : false);
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
							$tChkFF = array_search($tn, array());
							$tChkHL = array_search($tn, array('DesignProposal','ContractDeployment','Recruitment','PersonnalFile','Competency','Training','ManagingVendor','VenPerformance','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','Quotation','PurchaseOrder','DeliveryOrder','AccountPayables','ToolBoxMeeting','Bi_WeeklyMeeting','QuarterlyMeeting','Campaign','DrillNInspection','ManagementVisit','EventNotification','ActCard','DCN','ObsoleteRec','WorkPermit','DailyProgressReport','MonthlyTimesheet','Breakdown','ClaimRecord','SoftboardComment','ReportComment'));
							$tChkAHAN = array_search($tn, array('OrgContentContext','Marketing','Client','Inquiry','DesignProposal','ContractDeployment','employees','Recruitment','PersonnalFile','Competency','Training','JD_JS','InOutRegister','vendor','ManagingVendor','VenPerformance','Logistics','Inventory','CalibrationCtrl','WorkOrder','MWO','MWOPlanned','MWOpreventive','MWOproactive','MWConditionBased','MWOReactive','MWOCorrective','LogisticRequest','orders','PurchaseOrder','DeliveryOrder','AccountPayables','Item','categories','batches','transactions','CommConsParticipate','KM','LegalRegister','RiskandOpportunity','DocControl','QA','ERP','WorkEnvMonitoring','ScheduleWaste','IncidentReporting','MgtofChange','IMStrackingNmonitoring','IMSDataAnalysis','Audit','NonConformance','ContinualImprovement','StakeholderSatisfaction','MRM','projects','WorkLocation','ProjectTeam','resources','PROInitiation','PROPlanning','PROExecution','DailyProgressReport','MonthlyTimesheet','Breakdown','PROControlMonitoring','PROVariation','PROCompletion','Receivables','ClaimRecord','TeamSoftBoard','IMSReport','Leadership','Approval','IMSControl'));
							$count_badge = '';
							if($tc['homepageShowCount']){
								$sql_from = get_sql_from($tn);
								$count_records = ($sql_from ? sqlValue("select count(1) from " . $sql_from) : 0);
								$count_badge = '<span class="">' . number_format($count_records) . '</span>';
							}
							$t_perm = getTablePermissions($tn);
							$can_insert = $t_perm['insert'];
							$searchFirst = (($tChkFF !== false && $tChkFF !== null) ? '?Filter_x=1' : '');
							?>
								<?php if($tChkHL === false || $tChkHL === null){ /* if table is not set as hidden in homepage */ ?>
									<?php 
										
										if($tc['Caption'] == "Request Order" || $tc['Caption'] == "Client & Main Contractor" || $tc['Caption'] =="Organization Softboard"|| $tc['Caption'] == "IMS Complaint Report"){
											?>
												

												<div class="col-lg-3 col-md-6">
												<div class="card dashboard-stat">
													<div class="card-body">
														<!-- Row -->
														<div class="row">
															<div class="col-8" id="counter-<?php echo $tn; ?>"><span class="display-6"><?php echo $count_badge;?></span>
																<h6 class="text-muted" id="caption-<?php echo $tn; ?>"><?php echo $tc['Caption'];?></h6></div>
																<div class="ims-info-icon dashboard-visual">
																	<i class="fa fa-folder-open-o fa-5x" id="fa-<?php echo $tn; ?>"></i>
																</div>
															<div class="col-4 align-self-center text-right  p-l-0">
																<div id="sparklinedash3"></div>
																<!-- <span class="ims-info-icon"><i class="fa fa-folder-open-o fa-5x" id="fa-<?php echo $tn; ?>"></i></span> -->
															</div>
															<!-- <a href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>" id="href-<?php echo $tn; ?>" class="view-all-link">
																<div class="panel-footer" style="background-color: #fff;">
																	<span class="pull-left">View Details</span>
																	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
																	<div class="clearfix"></div>
																</div>
															</a> -->
														</div>
													</div>
												</div>
											</div>
											<?php
										}
									?>
								<?php } ?>
							<?php
							$i++;
						}
					}
				?>
		</div>
		
	</div>
	<!-- ims-infobox-wrapper -->

	<div class="row">
		<div class="col-lg-6 col-md-6 ">
			<div class="card card-chart">
				<div class="card-header">
					<h4 class="card-title"><a href="TeamSoftBoard_view.php">Organization Softboard</a></h4>
				</div>
				<div class="card-body" id="if1">
					<iframe frameborder="0" width="100%" style="position: relative;min-height: 300px;" src="TeamSoftBoard2_view.php"></iframe>
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
					<iframe frameborder="0" width="100%" style="position: relative;min-height: 300px;" src="IMSReport2_view.php"></iframe>
				</div>
				<div class="card-footer">
				</div>
			</div>
		</div>
	</div>
	
	<iframe id="AccountPayables_view" frameborder="0" style="display:none" src="AccountPayables_view.php"></iframe>
	<iframe id="ClaimRecord_view" frameborder="0" style="display:none" src="ClaimRecord_view.php"></iframe>

	

</div>
<footer class="footerd">
	Powered by Supply Network Agency PLT
</footer>
<!-- /#page-wrapper -->
<script>
	$j(function(){
		//demo.initBarChartMoris();
		
		$j('.container').removeClass('container').addClass('container-full');
		$j('.sidebar').perfectScrollbar();
		$j('#page-wrapper').perfectScrollbar();
		$j("li a:contains('Misc.')").hide();
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
