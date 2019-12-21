<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

    $currDir=dirname(__FILE__);
    $hooks_dir = $currDir . "/hooks";
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
    include("$currDir/lib.php");
    $x = new DataList;
    $x->TableTitle = 'Reports';
    include_once("$currDir/header.php");
    include_once("$hooks_dir/reportsCommon.php");
    include("$currDir/language.php");
    include("{$currDir}/language-admin.php");
    $memberInfo = getMemberInfo();
    global $Translation;
?>
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

    .dis{
        pointer-events:none
    }

    .hideDiv {
        display: none
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
        ?>
        <div class="col-md-12" style="width: 50px; margin-top: 100px; position: static">
            <div><a href="./reports.php"><span style="font-size: 14px; line-height: 30px; color: #777; padding: 15px; position: relative; background-color: transparent;">DASHBOARD</span></a></div>
            <div class="text-muted" ><br><br>Select Report Range:<br><br></div>
            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>
            <div class="text-muted" ><br><br>Select Individual Report:</div>
            <!-- <select name="date" class="form-control" id="date">
                <option value="">Select Date</option>
            <?php
            // foreach($result as $row){
            //     echo '<option value="'.$row["date"].'">'.$row["date"].'</option>';
            // }
            ?>
            </select> -->
        </div>
        <?php
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

										<div id="summaryfor-<?php echo $tn; ?>" class="btn-group" style="width: 100%; word-wrap: break-word;">
                                           <a style="width: 80%;text-align: left; white-space: pre-wrap; word-wrap: break-word; padding: 10px" class="btn btn-lg1 " title="<?php echo preg_replace("/&amp;(#[0-9]+|[a-z]+);/i", "&$1;", html_attr(strip_tags($tc['Description']))); ?>"><?php echo $tc['Caption']; ?></a>
                                            <a class="width: 20%; badge badge-success pull-right sidebar-badge"><?php echo $count_badge; ?></a>
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
		?><script>window.location='../index.php?signIn=1';</script><?php
	}
?>
        </ul>
    </div>
</div>
    <!-- /.sidebar-collapse -->

<div class="container-fluid">
    <div style="margin-top: 150px; margin-left:250px">
        <span id="chartLoading" style="position: relative; left: 50%"></span>
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 id="titleReport" class="text-themecolor m-b-0 m-t-0">Reports Dashboard</h3>
			</div>
        </div>
        <!-- Default Reports Dashboard Start -->
        <div id="defaultReports">
            <!-- Start Row -->
            <div class="row">
                <!-- First Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <div class="card my-3">
                        <div class="card-body" style="max-height: 140px; overflow: hidden;">
                            <h4 class="card-title m-b-0">Organization Top Members</h4>
                            <p class="text-muted"></p>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="150px">Member</th>
                                        <th>No. of Records</th>
                                    </tr>
                                </thead>
                            <?php
                                $res=sql("select lcase(memberID), count(1) from membership_userrecords group by memberID order by 2 desc limit 5", $eo);
                                while($row=db_fetch_row($res)){
                            ?>
                                <tr>
                                    <td>
                                        <span class="text-muted">
                                            <?php echo $row[0]; ?>
                                        </span> 
                                    </td>
                                    <td style="max-height: 22px; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> 
                                        <?php if ($memberInfo['admin']) { ?>
                                            <a href="admin/pageViewRecords.php?memberID=<?php echo urlencode($row[0]); ?>"><img src="admin/images/data_icon.gif" border="0" alt="<?php echo $Translation["view member records"]; ?>" title="<?php echo $Translation["view member records"]; ?>"></a>
                                        <?php } ?> 
                                        <?php echo $row[1]; ?>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Second Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <!-- Start SubRow 1 -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Work Orders</h4>
                                    <p class="text-muted">Completed / Total</p>
                                    <?php
                                        $myWOCompleted=sqlValue("SELECT count(*) FROM `WorkOrder` WHERE `fo_EmployeeID` = (select `employees`.`EmployeeID` from `employees` where `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "') and `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4");
                                        $myWOTotal=sqlValue("SELECT count(*) FROM `WorkOrder` WHERE `fo_EmployeeID` = (select `employees`.`EmployeeID` from `employees` where `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "')");
                                    ?>
                                    
                                    <div class="row">
                                        <div class="col-12"><span><h2 class="font-light d-inline"><?php echo $myWOCompleted ?> / </h2><span class="text-muted"></span> <h2 class="font-light d-inline"><?php echo $myWOTotal ?></h2><span class="text-muted"></span></span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/inquiries.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Average Work Orders</h4>
                                    <p class="text-muted">Per Month</p>
                                    <?php
                                        $myWOAvgPerMonth=sqlValue("SELECT COALESCE(AVG(a.woCount), 0) FROM (select count(`WorkOrder`.`id`) as woCount FROM `WorkOrder` WHERE `WorkOrder`.`fo_EmployeeID` = (SELECT `employees`.`EmployeeID` FROM `employees` WHERE `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "') GROUP BY DATE_FORMAT(`WorkOrder`.`ot_ap_filed`, '%m-%Y')) a");
                                    ?>
                                    <div class="row">
                                        <div class="col-12"><span><h2 class="font-light d-inline"><?php echo number_format($myWOAvgPerMonth) ?></h2><span class="text-muted"></span> <h2 class="font-light d-inline"></h2><span class="text-muted"></span></span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/invoice.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Average Work Order</h4>
                                    <p class="text-muted">Completion Time</p>
                                    <?php
                                        $myWOAvgCompTime=sqlValue("SELECT COALESCE(SEC_TO_TIME((select AVG((UNIX_TIMESTAMP(COALESCE(`ot_ap_lastmodified`, `WorkOrder`.`ot_ap_filed`)) - UNIX_TIMESTAMP(`WorkOrder`.`ot_ap_filed`))) from `WorkOrder` WHERE `WorkOrder`.`fo_EmployeeID` = (SELECT `employees`.`EmployeeID` FROM `employees` WHERE `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "') and `ot_ap_Review` = 4 and `ot_ap_Approval` = 4 and `ot_ap_QC` = 4 and COALESCE(`ot_ap_lastmodified`, `ot_ap_filed`) is not null)), '00:00:00.0000') as avg_time");
                                        $myWOAvgCompTimeArr = explode(":", $myWOAvgCompTime, 2);
                                    ?>

                                    <div class="row">
                                        <div class="col-12"><span><h2 class="font-light d-inline"><?php echo number_format($myWOAvgCompTimeArr[0]) ?></h2><span class="text-muted">h</span> <h2 class="font-light d-inline"><?php echo number_format($myWOAvgCompTimeArr[1]) ?></h2><span class="text-muted"></span>m</span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/hours.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Start SubRow 2 -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Performance</h4>
                                    <p class="text-muted">Work Order Ratings</p>
                                    <?php
                                        $myWORating=sqlValue("SELECT COALESCE(AVG(`ot_ap_QCComment`), 0) FROM `WorkOrder` WHERE `fo_EmployeeID` = (select `employees`.`EmployeeID` from `employees` where `employees`.`memberID` = '" . makeSafe($memberInfo['username']) . "') and `ot_ap_QCComment` REGEXP '^[0-9]+$' and `ot_ap_QCComment` between 0 and 10");
                                    ?>
                                    <div class="row">
                                        <div class="col-12"><span><h2 class="font-light d-inline"><?php echo round($myWORating, 1) ?> / </h2><span class="text-muted"></span> <h2 class="font-light d-inline">10</h2><span class="text-muted"></span></span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/inquiries.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Average Task Rating</h4>
                                    <p class="text-muted">This Week</p>
                                    <?php
                                        $myRecordsTables=sql("SELECT tablename, pkvalue FROM `membership_userrecords` WHERE memberID = '" . makeSafe($memberInfo['username']) . "' and (YEARWEEK(from_unixtime(`dateAdded`), 1) = YEARWEEK(CURDATE(), 1) or YEARWEEK(from_unixtime(`dateUpdated`), 1) = YEARWEEK(CURDATE(), 1))", $eo);
                                        while($row=db_fetch_row($myRecordsTables)){
                                            $pkf = getPKFieldName($row[0]);
                                            $sqlFields = get_sql_fields($row[0]);
                                            if(strpos($sqlFields, 'ot_ap_QCComment') !== false){
                                                $myTaskRatingItem=sqlValue("SELECT COALESCE(AVG(`ot_ap_QCComment`), 0) FROM $row[0] WHERE $pkf = $row[1] and `ot_ap_QCComment` REGEXP '^[0-9]+$' and `ot_ap_QCComment` between 0 and 10");
                                                $myTaskRatingWeekly[]= $myTaskRatingItem;
                                            }
                                        }
                                        $myTaskRatingWeekly = array_filter($myTaskRatingWeekly, function($x) { return $x !== ''; });
                                        if(count($myTaskRatingWeekly) > 0) {
                                            $myTaskRatingWeeklyAvg = array_sum($myTaskRatingWeekly)/count($myTaskRatingWeekly);
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-12"><span><h2 class="font-light d-inline"><?php echo round($myTaskRatingWeeklyAvg, 1) ?> / </h2><span class="text-muted"></span> <h2 class="font-light d-inline">10</h2><span class="text-muted"></span></span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/invoice.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="col-lg-4 col-md-6 pr-2">
                            <div class="card my-3">
                                <div class="card-body" style="max-height: 140px; overflow: hidden;">
                                    <h4 class="card-title m-b-0">My Average Task Rating</h4>
                                    <p class="text-muted">This Month</p>
                                    <?php
                                        $myRecordsTables=sql("SELECT tablename, pkvalue FROM `membership_userrecords` WHERE memberID = '" . makeSafe($memberInfo['username']) . "' and ((MONTH(from_unixtime(`dateAdded`)) = MONTH(CURRENT_DATE()) and YEAR(from_unixtime(`dateAdded`)) = YEAR(CURRENT_DATE())) or (MONTH(from_unixtime(`dateUpdated`)) = MONTH(CURRENT_DATE()) and YEAR(from_unixtime(`dateUpdated`)) = YEAR(CURRENT_DATE())))", $eo);
                                        while($row=db_fetch_row($myRecordsTables)){
                                            $pkf = getPKFieldName($row[0]);
                                            $sqlFields = get_sql_fields($row[0]);
                                            if(strpos($sqlFields, 'ot_ap_QCComment') !== false){
                                                $myTaskRatingItem=sqlValue("SELECT COALESCE(AVG(`ot_ap_QCComment`), 0) FROM $row[0] WHERE $pkf = $row[1] and `ot_ap_QCComment` REGEXP '^[0-9]+$' and `ot_ap_QCComment` between 0 and 10");
                                                $myTaskRatingMonthly[]= $myTaskRatingItem;
                                            }
                                        }
                                        $myTaskRatingMonthly = array_filter($myTaskRatingMonthly, function($x) { return $x !== ''; });
                                        if(count($myTaskRatingMonthly) > 0) {
                                            $sum = array_sum($myTaskRatingMonthly);
                                            $count = count($myTaskRatingMonthly);
                                            $myTaskRatingMonthlyAvg = array_sum($myTaskRatingMonthly)/count($myTaskRatingMonthly);
                                        }
                                    ?>
                                    <div class="row">
                                    <div class="col-12"><span><h2 class="font-light d-inline"><?php echo round($myTaskRatingMonthlyAvg, 1) ?> / </h2><span class="text-muted"></span> <h2 class="font-light d-inline">10</h2><span class="text-muted"></span></span></div>
                                        <img style="width: 100px; position: relative; opacity: 0.1; left: 90px; top: -65px;" src="images/dashboard-icon/hours.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>


                </div>
            </div> 
            <!-- End Row -->
            <!-- Start Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <div class="card my-3">
                        <div class="card-body" style="max-height: 140px; overflow: hidden;">
                            <h4 class="card-title m-b-0">Organization Newest Updates  <?php if ($memberInfo['admin']) { ?><a class="btn btn-default btn-sm" href="admin/pageViewRecords.php?sort=dateUpdated&sortDir=desc"><i class="glyphicon glyphicon-chevron-right"></i></a><?php } ?></h4>
                            <p class="text-muted">Recent 5</p>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="150px">Date</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                            <?php
                                $res=sql("select tableName, pkValue, dateUpdated, recID from membership_userrecords order by dateUpdated desc limit 5", $eo);
                                while($row=db_fetch_row($res)){
                            ?>
                                <tr>
                                    <td>
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> 
                                            <?php echo @date($adminConfig['PHPDateTimeFormat'], $row[2]); ?>
                                        </span> 
                                    </td>
                                    <td style="max-height: 22px; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> 
                                        <?php if ($memberInfo['admin']) { ?>
                                            <a href="admin/pageEditOwnership.php?recID=<?php echo $row[3]; ?>"><img src="admin/images/data_icon.gif" border="0" alt="<?php echo $Translation["view record details"]; ?>" title="<?php echo $Translation["view record details"]; ?>"></a>
                                        <?php } ?> 
                                        <?php echo getCSVData($row[0], $row[1]); ?>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <div class="card my-3">
                        <div class="card-body" style="max-height: 140px; overflow: hidden;">
                            <h4 class="card-title m-b-0">Organization Newest Entries  <?php if ($memberInfo['admin']) { ?><a class="btn btn-default btn-sm" href="admin/pageViewRecords.php?sort=dateAdded&sortDir=desc"><i class="glyphicon glyphicon-chevron-right"></i></a><?php } ?> </h4>
                            <p class="text-muted">Recent 5</p>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="150px">Date</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                            <?php
                                $res=sql("select tableName, pkValue, dateAdded, recID from membership_userrecords order by dateAdded desc limit 5", $eo);
                                while($row=db_fetch_row($res)){
                            ?>
                                <tr>
                                    <td>
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> 
                                            <?php echo @date($adminConfig['PHPDateTimeFormat'], $row[2]); ?>
                                        </span> 
                                    </td>
                                    <td style="max-height: 22px; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"> 
                                        <?php if ($memberInfo['admin']) { ?>
                                            <a href="admin/pageEditOwnership.php?recID=<?php echo $row[3]; ?>"><img src="admin/images/data_icon.gif" border="0" alt="<?php echo $Translation["view record details"]; ?>" title="<?php echo $Translation["view record details"]; ?>"></a>
                                        <?php } ?> 
                                        <?php echo getCSVData($row[0], $row[1]); ?>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- End Row -->
            <!-- Start Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <div class="card my-3">
                        <div class="card-body" style="max-height: 140px; overflow: hidden;">
                            <h4 class="card-title m-b-0">Top Members</h4>
                            <p class="text-muted">Records Generated</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 pr-2">
                                <div id="pieTopMembers" style="width: 100%; height: 300px; position: relative;"></div>
                            </div>
                            <div class="col-lg-6 col-md-6 pr-2">
                                <div id="barTopMembers" style="width: 100%; height: 300px; position: relative;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-lg-6 col-md-6 pr-2">
                    <div class="card my-3">
                        <div class="card-body" style="max-height: 140px; overflow: hidden;">
                            <h4 class="card-title m-b-0">Member Stats</h4>
                            <p class="text-muted">Overall</p>
                        </div>
                        <div id="columnMemberStats" style="width: 100%; height: 300px; position: relative;"></div>
                    </div>
                </div>
            </div> 
            <!-- End Row -->
        </div>
        <!-- Default Reports Dashboard End -->
        <!-- Dynamic Reports Start -->
        <div id="notify" style="margin-top: 50px; left: 50%; position: relative; color: red" class = "hideDiv"></div>
        <div id="noResult" style="margin-top: 50px; left: 50%; position: relative;" class = "hideDiv"></div>
        <div id="barChart" style="margin-top: 50px; width: 100%; height: 300px; position: relative;" class = "hideDiv"></div>
        <div id="lineChart" style="margin-top: 30px; width: 100%; height: 300px; position: relative;" class = "hideDiv"></div>
        <div id="tableChart" style="margin-top: 100px; width: 100%; height: 200px; position: relative;" class = "hideDiv"></div>
        <!-- Dynamic Reports End -->
    </div>
</div>

    





<?php
    include_once("$currDir/footer.php");
?>