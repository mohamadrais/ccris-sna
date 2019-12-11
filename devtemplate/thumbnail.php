<?php
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	// image paths
	$p=array(   
		'OrgContentContext' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Marketing' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Client' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Inquiry' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DesignProposal' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ContractDeployment' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'employees' => array(
			'fo_Photo01' => $Translation['ImageFolder'],
			'fo_Photo02' => $Translation['ImageFolder'],
			'fo_Photo03' => $Translation['ImageFolder']
		),
		'Recruitment' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PersonnalFile' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Competency' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Training' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'JD_JS' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'InOutRegister' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'vendor' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ManagingVendor' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'VenPerformance' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Logistics' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Inventory' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'CalibrationCtrl' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'WorkOrder' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWO' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWOPlanned' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWOpreventive' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWOproactive' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWConditionBased' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWOReactive' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MWOCorrective' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'LogisticRequest' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'orders' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Quotation' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PurchaseOrder' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DeliveryOrder' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'AccountPayables' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Item' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'categories' => array(
			'ot_Picture01' => $Translation['ImageFolder'],
			'ot_Picture02' => $Translation['ImageFolder'],
			'ot_Picture03' => $Translation['ImageFolder']
		),
		'batches' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'transactions' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'CommConsParticipate' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ToolBoxMeeting' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Bi_WeeklyMeeting' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'QuarterlyMeeting' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Campaign' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DrillNInspection' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ManagementVisit' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'EventNotification' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ActCard' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'KM' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'LegalRegister' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'RiskandOpportunity' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DocControl' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DCN' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ObsoleteRec' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'QA' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ERP' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'WorkEnvMonitoring' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ScheduleWaste' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'IncidentReporting' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MgtofChange' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'IMStrackingNmonitoring' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'IMSDataAnalysis' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Audit' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'NonConformance' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ContinualImprovement' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'StakeholderSatisfaction' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MRM' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'projects' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'WorkLocation' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'WorkPermit' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ProjectTeam' => array(
			'fo_Photo01' => $Translation['ImageFolder'],
			'fo_Photo02' => $Translation['ImageFolder'],
			'fo_Photo03' => $Translation['ImageFolder']
		),
		'resources' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROInitiation' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROPlanning' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROExecution' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'DailyProgressReport' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'MonthlyTimesheet' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Breakdown' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROControlMonitoring' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROVariation' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'PROCompletion' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'Receivables' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'ClaimRecord' => array(
			'ot_Photo01' => $Translation['ImageFolder'],
			'ot_Photo02' => $Translation['ImageFolder'],
			'ot_Photo03' => $Translation['ImageFolder']
		),
		'TeamSoftBoard' => array(
			'image01' => $Translation['ImageFolder'],
			'image02' => $Translation['ImageFolder'],
			'image03' => $Translation['ImageFolder']
		),
		'IMSReport' => array(
			'image' => $Translation['ImageFolder']
		),
		'membership_company' => array(
			'fo_Logo' => $Translation['ImageFolder'],
			'fo_Banner' => $Translation['ImageFolder'],
			'fo_Photo01' => $Translation['ImageFolder'],
			'fo_Photo02' => $Translation['ImageFolder'],
			'fo_Photo03' => $Translation['ImageFolder']
		)
	);

	if(!count($p)) exit;

	// receive user input
	$t = $_GET['t']; // table name
	$f = $_GET['f']; // field name
	$v = $_GET['v']; // thumbnail view type: 'tv' or 'dv'
	$i = $_GET['i']; // original image file name

	// validate input
	if(!in_array($t, array_keys($p)))  getImage();
	if(!in_array($f, array_keys($p[$t])))  getImage();
	if(!preg_match('/^[a-z0-9_-]+\.(gif|png|jpg|jpeg|jpe)$/i', $i, $m)) getImage();
	if($v != 'tv' && $v != 'dv')   getImage();
	if($i == 'blank.gif') getImage();

	$img=$p[$t][$f].$i;
	$thumb=str_replace(".$m[1]ffffgggg", "_$v.$m[1]", $img.'ffffgggg');

	// if thumbnail exists and the user is not admin, output it without rebuilding the thumbnail
	if(getImage($thumb) && !getLoggedAdmin())  exit;

	// otherwise, try to create the thumbnail and output it
	if(!createThumbnail($img, getThumbnailSpecs($t, $f, $v)))  getImage();
	if(!getImage($thumb))  getImage();

	function getImage($img = ''){
		if(!$img){ // default image to return
			$img = './photo.gif';
			$exit = true;
		}

		/* force caching */
		$last_modified = filemtime($img);
		$last_modified_gmt = gmdate('D, d M Y H:i:s', $last_modified) . ' GMT';
		$expires_gmt = gmdate('D, d M Y H:i:s', $last_modified + 864000) . ' GMT';
		$headers = (function_exists('getallheaders') ? getallheaders() : $_SERVER);
		if(isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == $last_modified)){
			@header("Last-Modified: {$last_modified_gmt}", true, 304);
			@header("Cache-Control: private, max-age=864000", true);
			@header("Expires: {$expires_gmt}");
			exit;
		}

		$thumbInfo = @getimagesize($img);
		$fp = @fopen($img, 'rb');
		if($thumbInfo && $fp){
			$file_size = filesize($img);
			@header("Last-Modified: {$last_modified_gmt}", true, 200);
			@header("Pragma:");
			@header("Cache-Control: private, max-age=864000", true);
			@header("Content-type: {$thumbInfo['mime']}");
			@header("Content-Length: {$file_size}");
			@header("Expires: {$expires_gmt}");
			ob_end_clean();
			@fpassthru($fp);
			if(!$exit) return true; else exit;
		}

		if(!$exit) return false; else exit;
	}
