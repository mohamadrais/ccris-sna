<?php
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	// image paths
	$p=array(   
		'OrgContentContext' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Marketing' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Client' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Inquiry' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DesignProposal' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ContractDeployment' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'employees' => array(
			'fo_Photo' => $Translation['ImageFolder']
		),
		'Recruitment' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PersonnalFile' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Competency' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Training' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'JD_JS' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'InOutRegister' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'vendor' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ManagingVendor' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder']
		),
		'VenPerformance' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Logistics' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Inventory' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder']
		),
		'CalibrationCtrl' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'WorkOrder' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWO' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWOPlanned' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWOpreventive' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWOproactive' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWConditionBased' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWOReactive' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MWOCorrective' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'LogisticRequest' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'orders' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Quotation' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PurchaseOrder' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DeliveryOrder' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'AccountPayables' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Item' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'categories' => array(
			'ot_Picture' => $Translation['ImageFolder']
		),
		'batches' => array(
			'fo_Photo' => $Translation['ImageFolder']
		),
		'transactions' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'CommConsParticipate' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ToolBoxMeeting' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Bi_WeeklyMeeting' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'QuarterlyMeeting' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Campaign' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DrillNInspection' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ManagementVisit' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'EventNotification' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ActCard' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'KM' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'LegalRegister' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'RiskandOpportunity' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DocControl' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DCN' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ObsoleteRec' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'QA' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ERP' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'WorkEnvMonitoring' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ScheduleWaste' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'IncidentReporting' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MgtofChange' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'IMStrackingNmonitoring' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'IMSDataAnalysis' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Audit' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'NonConformance' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ContinualImprovement' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'StakeholderSatisfaction' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MRM' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'projects' => array(
			'ot_Photo' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'WorkLocation' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'WorkPermit' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ProjectTeam' => array(
			'fo_Photo' => $Translation['ImageFolder']
		),
		'resources' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROInitiation' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROPlanning' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROExecution' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'DailyProgressReport' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'MonthlyTimesheet' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Breakdown' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROControlMonitoring' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROVariation' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'PROCompletion' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'Receivables' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'ClaimRecord' => array(
			'ot_Photo' => $Translation['ImageFolder']
		),
		'TeamSoftBoard' => array(
			'image' => $Translation['ImageFolder']
		),
		'IMSReport' => array(
			'image' => $Translation['ImageFolder']
		)
	);

	if(!count($p)) exit;

	// receive user input
	$t=$_GET['t']; // table name
	$f=$_GET['f']; // field name
	$v=$_GET['v']; // thumbnail view type: 'tv' or 'dv'
	$i=$_GET['i']; // original image file name

	// validate input
	if(!in_array($t, array_keys($p)))  getImage();
	if(!in_array($f, array_keys($p[$t])))  getImage();
	if(!preg_match('/^[a-z0-9_]+\.(gif|png|jpg|jpeg|jpe)$/i', $i, $m)) getImage();
	if($v!='tv' && $v!='dv')   getImage();

	$img=$p[$t][$f].$i;
	$thumb=str_replace(".$m[1]ffffgggg", "_$v.$m[1]", $img.'ffffgggg');

	// if thumbnail exists and the user is not admin, output it without rebuilding the thumbnail
	if(getImage($thumb) && !getLoggedAdmin())  exit;

	// otherwise, try to create the thumbnail and output it
	if(!createThumbnail($img, getThumbnailSpecs($t, $f, $v)))  getImage();
	if(!getImage($thumb))  getImage();


	function getImage($img=''){
		if(!$img){ // default image to return
			$img='./photo.gif';
			$exit=TRUE;
		}
		$thumbInfo=@getimagesize($img);
		$fp=@fopen($img, 'rb');
		if($thumbInfo && $fp){
			header("Content-type: {$thumbInfo['mime']}");
			fpassthru($fp);
			if(!$exit) return TRUE; else exit;
		}

		if(!$exit) return FALSE; else exit;
	}