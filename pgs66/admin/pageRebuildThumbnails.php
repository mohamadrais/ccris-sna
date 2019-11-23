<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	$GLOBALS['page_title'] = $Translation['rebuild thumbnails'];
	include("{$currDir}/incHeader.php");

	// image paths
	$p=array(   
		'OrgContentContext' => array(
			'ot_Photo' => '../images/'
		),
		'Marketing' => array(
			'ot_Photo' => '../images/'
		),
		'Client' => array(
			'ot_Photo' => '../images/'
		),
		'Inquiry' => array(
			'ot_Photo' => '../images/'
		),
		'DesignProposal' => array(
			'ot_Photo' => '../images/'
		),
		'ContractDeployment' => array(
			'ot_Photo' => '../images/'
		),
		'employees' => array(
			'fo_Photo' => '../images/'
		),
		'Recruitment' => array(
			'ot_Photo' => '../images/'
		),
		'PersonnalFile' => array(
			'ot_Photo' => '../images/'
		),
		'Competency' => array(
			'ot_Photo' => '../images/'
		),
		'Training' => array(
			'ot_Photo' => '../images/'
		),
		'JD_JS' => array(
			'ot_Photo' => '../images/'
		),
		'InOutRegister' => array(
			'ot_Photo' => '../images/'
		),
		'vendor' => array(
			'ot_Photo' => '../images/'
		),
		'ManagingVendor' => array(
			'fo_image' => '../images/',
			'ot_Photo' => '../images/'
		),
		'VenPerformance' => array(
			'fo_image' => '../images/',
			'ot_Photo' => '../images/'
		),
		'Logistics' => array(
			'ot_Photo' => '../images/'
		),
		'Inventory' => array(
			'fo_image' => '../images/',
			'ot_Photo' => '../images/'
		),
		'CalibrationCtrl' => array(
			'ot_Photo' => '../images/'
		),
		'WorkOrder' => array(
			'ot_Photo' => '../images/'
		),
		'MWO' => array(
			'ot_Photo' => '../images/'
		),
		'MWOPlanned' => array(
			'ot_Photo' => '../images/'
		),
		'MWOpreventive' => array(
			'ot_Photo' => '../images/'
		),
		'MWOproactive' => array(
			'ot_Photo' => '../images/'
		),
		'MWConditionBased' => array(
			'ot_Photo' => '../images/'
		),
		'MWOReactive' => array(
			'ot_Photo' => '../images/'
		),
		'MWOCorrective' => array(
			'ot_Photo' => '../images/'
		),
		'LogisticRequest' => array(
			'ot_Photo' => '../images/'
		),
		'orders' => array(
			'ot_Photo' => '../images/'
		),
		'Quotation' => array(
			'ot_Photo' => '../images/'
		),
		'PurchaseOrder' => array(
			'ot_Photo' => '../images/'
		),
		'DeliveryOrder' => array(
			'ot_Photo' => '../images/'
		),
		'AccountPayables' => array(
			'ot_Photo' => '../images/'
		),
		'Item' => array(
			'ot_Photo' => '../images/'
		),
		'categories' => array(
			'ot_Picture' => '../images/'
		),
		'batches' => array(
			'fo_Photo' => '../images/'
		),
		'transactions' => array(
			'ot_Photo' => '../images/'
		),
		'CommConsParticipate' => array(
			'ot_Photo' => '../images/'
		),
		'ToolBoxMeeting' => array(
			'ot_Photo' => '../images/'
		),
		'Bi_WeeklyMeeting' => array(
			'ot_Photo' => '../images/'
		),
		'QuarterlyMeeting' => array(
			'ot_Photo' => '../images/'
		),
		'Campaign' => array(
			'ot_Photo' => '../images/'
		),
		'DrillNInspection' => array(
			'ot_Photo' => '../images/'
		),
		'ManagementVisit' => array(
			'ot_Photo' => '../images/'
		),
		'EventNotification' => array(
			'ot_Photo' => '../images/'
		),
		'ActCard' => array(
			'ot_Photo' => '../images/'
		),
		'KM' => array(
			'ot_Photo' => '../images/'
		),
		'LegalRegister' => array(
			'ot_Photo' => '../images/'
		),
		'RiskandOpportunity' => array(
			'ot_Photo' => '../images/'
		),
		'DocControl' => array(
			'ot_Photo' => '../images/'
		),
		'DCN' => array(
			'ot_Photo' => '../images/'
		),
		'ObsoleteRec' => array(
			'ot_Photo' => '../images/'
		),
		'QA' => array(
			'ot_Photo' => '../images/'
		),
		'ERP' => array(
			'ot_Photo' => '../images/'
		),
		'WorkEnvMonitoring' => array(
			'ot_Photo' => '../images/'
		),
		'ScheduleWaste' => array(
			'ot_Photo' => '../images/'
		),
		'IncidentReporting' => array(
			'ot_Photo' => '../images/'
		),
		'MgtofChange' => array(
			'ot_Photo' => '../images/'
		),
		'IMStrackingNmonitoring' => array(
			'ot_Photo' => '../images/'
		),
		'IMSDataAnalysis' => array(
			'ot_Photo' => '../images/'
		),
		'Audit' => array(
			'ot_Photo' => '../images/'
		),
		'NonConformance' => array(
			'ot_Photo' => '../images/'
		),
		'ContinualImprovement' => array(
			'ot_Photo' => '../images/'
		),
		'StakeholderSatisfaction' => array(
			'ot_Photo' => '../images/'
		),
		'MRM' => array(
			'ot_Photo' => '../images/'
		),
		'projects' => array(
			'ot_Photo' => '../images/',
			'ot_Photo02' => '../images/',
			'ot_Photo03' => '../images/'
		),
		'WorkLocation' => array(
			'ot_Photo' => '../images/'
		),
		'WorkPermit' => array(
			'ot_Photo' => '../images/'
		),
		'ProjectTeam' => array(
			'fo_Photo' => '../images/'
		),
		'resources' => array(
			'ot_Photo' => '../images/'
		),
		'PROInitiation' => array(
			'ot_Photo' => '../images/'
		),
		'PROPlanning' => array(
			'ot_Photo' => '../images/'
		),
		'PROExecution' => array(
			'ot_Photo' => '../images/'
		),
		'DailyProgressReport' => array(
			'ot_Photo' => '../images/'
		),
		'MonthlyTimesheet' => array(
			'ot_Photo' => '../images/'
		),
		'Breakdown' => array(
			'ot_Photo' => '../images/'
		),
		'PROControlMonitoring' => array(
			'ot_Photo' => '../images/'
		),
		'PROVariation' => array(
			'ot_Photo' => '../images/'
		),
		'PROCompletion' => array(
			'ot_Photo' => '../images/'
		),
		'Receivables' => array(
			'ot_Photo' => '../images/'
		),
		'ClaimRecord' => array(
			'ot_Photo' => '../images/'
		),
		'TeamSoftBoard' => array(
			'image' => '../images/'
		),
		'IMSReport' => array(
			'image' => '../images/'
		)
	);

	if(!count($p)) exit;

	// validate input
	$t=$_GET['table'];
	if(!in_array($t, array_keys($p))){
		?>
		<div class="page-header"><h1><?php echo $Translation['rebuild thumbnails']; ?></h1></div>
		<form method="get" action="pageRebuildThumbnails.php" target="_blank">
			<?php echo $Translation['thumbnails utility']; ?><br><br>

			<b><?php echo $Translation['rebuild thumbnails of table'] ; ?></b> 
			<?php echo htmlSelect('table', array_keys($p), array_keys($p), ''); ?>
			<input type="submit" value="<?php echo $Translation['rebuild'] ; ?>">
		</form>


		<?php
		include("{$currDir}/incFooter.php");
		exit;
	}

	?>
	<div class="page-header"><h1><?php echo str_replace ( "<TABLENAME>" , $t , $Translation['rebuild thumbnails of table_name'] ); ?></h1></div>
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