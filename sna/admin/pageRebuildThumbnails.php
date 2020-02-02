<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['rebuild thumbnails'];
	include("{$currDir}/incHeader.php");

	// image paths
	$p=array(   
		'OrgContentContext' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Marketing' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Client' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Inquiry' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DesignProposal' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ContractDeployment' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'employees' => array(
			'fo_Photo01' => '../images/',
			'fo_Photo02' => '../images/',
			'fo_Photo03' => '../images/'
		),
		'Recruitment' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PersonnalFile' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Competency' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Training' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'JD_JS' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'InOutRegister' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'vendor' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ManagingVendor' => array(
			'fo_image' => '../images/',
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'VenPerformance' => array(
			'fo_image' => '../images/',
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Logistics' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Inventory' => array(
			'fo_image' => '../images/',
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'CalibrationCtrl' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'WorkOrder' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWO' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWOPlanned' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWOpreventive' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWOproactive' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWConditionBased' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWOReactive' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MWOCorrective' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'LogisticRequest' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'orders' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Quotation' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PurchaseOrder' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DeliveryOrder' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'AccountPayables' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Item' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'categories' => array(
			'ot_Picture01' => '../images/',
			'ot_Picture02' => '../images/',
			'ot_Picture03' => '../images/'
		),
		'batches' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'transactions' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'CommConsParticipate' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ToolBoxMeeting' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Bi_WeeklyMeeting' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'QuarterlyMeeting' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Campaign' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DrillNInspection' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ManagementVisit' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'EventNotification' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ActCard' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'KM' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'LegalRegister' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'RiskandOpportunity' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DocControl' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DCN' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ObsoleteRec' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'QA' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ERP' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'WorkEnvMonitoring' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ScheduleWaste' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'IncidentReporting' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MgtofChange' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'IMStrackingNmonitoring' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'IMSDataAnalysis' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Audit' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'NonConformance' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ContinualImprovement' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'StakeholderSatisfaction' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MRM' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'projects' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'WorkLocation' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'WorkPermit' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ProjectTeam' => array(
			'fo_Photo01' => '../images/',
			'fo_Photo02' => '../images/',
			'fo_Photo03' => '../images/'
		),
		'resources' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROInitiation' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROPlanning' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROExecution' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'DailyProgressReport' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'MonthlyTimesheet' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Breakdown' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROControlMonitoring' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROVariation' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'PROCompletion' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'Receivables' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'ClaimRecord' => array(
			'ot_Photo01' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'TeamSoftBoard' => array(
			'image01' => '../images/',
			'image02' => '../images/',
			'image03' => '../images/'
		),
		'IMSReport' => array(
			'image' => '../images/'
		),
		'membership_company' => array(
			'fo_Logo' => '../images/',
			'fo_Banner' => '../images/',
			'fo_Photo01' => '../images/',
			'fo_Photo02' => '../images/',
			'fo_Photo03' => '../images/'
		)
	);

	if(!count($p)) exit;

	// validate input
	$t=$_GET['table'];
	if(!in_array($t, array_keys($p))){
		?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h3>
						<?php echo $Translation['rebuild thumbnails']; ?>
					</h3>
					<form method="get" action="pageRebuildThumbnails.php" target="_blank">
						<?php echo $Translation['thumbnails utility']; ?><br><br>

						<label class="control-label"><?php echo $Translation['rebuild thumbnails of table'] ; ?></label> 
						<?php echo htmlSelect('table', array_keys($p), array_keys($p), ''); ?>
						<input type="submit" value="<?php echo $Translation['rebuild'] ; ?>">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


		<?php
		include("{$currDir}/incFooter.php");
		exit;
	}

	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h3>
							<?php echo str_replace ( "<TABLENAME>" , $t , $Translation['rebuild thumbnails of table_name'] ); ?>
						</h3>
						<?php echo $Translation['do not close page message'] ; ?><br><br>
						<div style="font-weight: bold; color: red; width:700px;" id="status"><?php echo $Translation['rebuild thumbnails status'] ; ?></div>
						<br>

						<div style="text-align:left; padding: 0 5px; width:700px; height:250px;overflow:auto; border: solid 1px green;">
						<?php
							foreach($p[$t] as $f=>$path){
								$res=sql("select `$f` from `$t`", $eo);
								echo str_replace ( "<FIELD>" , $f , $Translation['building field thumbnails'] )."<br>";
								unset($tv); unset($dv);
								while($row=db_fetch_row($res)){
									if($row[0]!=''){
										$tv[]=$row[0];
										$dv[]=$row[0];
									}
								}
								for($i=0; $i<count($tv); $i++){
									if($i && !($i%4))  echo '<br style="clear: left;">';
									echo '<img src="../thumbnail.php?t='.$t.'&f='.$f.'&i='.$tv[$i].'&v=tv" align="left" style="margin: 10px 10px;"> ';
								}
								echo '<br style="clear: left;">';

								for($i=0; $i<count($dv); $i++){
									if($i && !($i%4))  echo '<br style="clear: left;">';
									echo '<img src="../thumbnail.php?t='.$t.'&f='.$f.'&i='.$tv[$i].'&v=dv" align="left" style="margin: 10px 10px;"> ';
								}
								echo "<br style='clear: left;'>{$Translation['done']}<br><br>";
							}
						?>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<script>
		window.onload = function(){
			document.getElementById('status').innerHTML = "<?php echo $Translation['finished status'] ; ?>";
			document.getElementById('status').style.color = 'green';
			document.getElementById('status').style.fontSize = '25px';
			document.getElementById('status').style.backgroundColor = '#fff4cf';
		}
	</script>

<?php
	include("{$currDir}/incFooter.php");