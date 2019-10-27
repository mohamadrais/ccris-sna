<?php
	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	// upload paths
	$p=array(   
		'OrgContentContext' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Marketing' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Client' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Inquiry' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DesignProposal' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ContractDeployment' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'employees' => array(
			'fo_Photo' => $Translation['ImageFolder'],
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'primary key' => 'EmployeeID'
		),
		'Recruitment' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'RecruitID'
		),
		'PersonnalFile' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'PersonalFileID'
		),
		'Competency' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'CompetencyID'
		),
		'Training' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'TrainingID'
		),
		'JD_JS' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'InOutRegister' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'vendor' => array(
			'fo_HomePage' => '',
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'VendorID'
		),
		'ManagingVendor' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'VenPerformance' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Logistics' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'ShipperID'
		),
		'Inventory' => array(
			'fo_image' => $Translation['ImageFolder'],
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'CalibrationCtrl' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'WorkOrder' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWO' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWOPlanned' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'WMOPlannedID'
		),
		'MWOpreventive' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWOproactive' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWConditionBased' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWOReactive' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MWOCorrective' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'LogisticRequest' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'orders' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Quotation' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'PurchaseOrder' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DeliveryOrder' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'AccountPayables' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Item' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'ProductID'
		),
		'categories' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Picture' => $Translation['ImageFolder'],
			'primary key' => 'CategoryID'
		),
		'batches' => array(
			'fo_SharedLink1' => '',
			'fo_SharedLink2' => '',
			'fo_Ref01' => $Translation['ImageFolder'],
			'fo_Ref02' => $Translation['ImageFolder'],
			'fo_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'transactions' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'CommConsParticipate' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ToolBoxMeeting' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Bi_WeeklyMeeting' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'QuarterlyMeeting' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Campaign' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DrillNInspection' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ManagementVisit' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'EventNotification' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ActCard' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'KM' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'LegalRegister' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'RiskandOpportunity' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DocControl' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DCN' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ObsoleteRec' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'QA' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ERP' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'WorkEnvMonitoring' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ScheduleWaste' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'IncidentReporting' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MgtofChange' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'IMStrackingNmonitoring' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'IMSDataAnalysis' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Audit' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'NonConformance' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ContinualImprovement' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'StakeholderSatisfaction' => array(
			'fo_website' => '',
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MRM' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'projects' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'Id'
		),
		'WorkLocation' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'WorkPermit' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ProjectTeam' => array(
			'fo_Photo' => $Translation['ImageFolder'],
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'primary key' => 'ProjectTeamID'
		),
		'resources' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'Id'
		),
		'PROInitiation' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'PROPlanning' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'PROExecution' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'DailyProgressReport' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'MonthlyTimesheet' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Breakdown' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'Id'
		),
		'PROControlMonitoring' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'PROVariation' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'PROCompletion' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'Receivables' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'ClaimRecord' => array(
			'ot_SharedLink1' => '',
			'ot_SharedLink2' => '',
			'ot_Ref01' => $Translation['ImageFolder'],
			'ot_Ref02' => $Translation['ImageFolder'],
			'ot_Photo' => $Translation['ImageFolder'],
			'primary key' => 'id'
		),
		'TeamSoftBoard' => array(
			'image' => $Translation['ImageFolder'],
			'website' => '',
			'Ref01' => $Translation['ImageFolder'],
			'primary key' => 'Postid'
		),
		'IMSReport' => array(
			'image' => $Translation['ImageFolder'],
			'website' => '',
			'Ref01' => $Translation['ImageFolder'],
			'primary key' => 'Postid'
		)
	);

	if(!count($p)) getLink();

	// default links
	$dL=array(  
	);

	// receive user input
	$t=$_GET['t']; // table name
	$f=$_GET['f']; // field name
	$i=makeSafe($_GET['i']); // id

	// validate input
	if(!in_array($t, array_keys($p)))  getLink();
	if(!in_array($f, array_keys($p[$t])) || $f=='primary key')  getLink();
	if(!$i && !$dL[$t][$f]) getLink();

	// user has view access to the requested table?
	if(!check_record_permission($t, $_GET['i'])) getLink();

	// send default link if no id provided, e.g. new record
	if(!$i){
		$path=$p[$t][$f];
		if(preg_match('/^(http|ftp)/i', $dL[$t][$f])){ $path=''; }
		@header("Location: {$path}{$dL[$t][$f]}");
		exit;
	}

	getLink($t, $f, $p[$t]['primary key'], $i, $p[$t][$f]);

	function getLink($table='', $linkField='', $pk='', $id='', $path=''){
		if(!$id || !$table || !$linkField || !$pk){ // default link to return
			exit;
		}

		if(preg_match('/^Lookup: (.*?)::(.*?)::(.*?)$/', $path, $m)){
			$linkID=makeSafe(sqlValue("select `$linkField` from `$table` where `$pk`='$id'"));
			$link=sqlValue("select `{$m[3]}` from `{$m[1]}` where `{$m[2]}`='$linkID'");
		}else{
			$link=sqlValue("select `$linkField` from `$table` where `$pk`='$id'");
		}

		if(!$link){
			exit;
		}

		if(preg_match('/^(http|ftp)/i', $link)){    // if the link points to an external url, don't prepend path
			$path='';
		}elseif(!is_file(dirname(__FILE__)."/$path$link")){    // if the file doesn't exist in the given path, try to find it without the path
			$path='';
		}

		@header("Location: $path$link");
		exit;
	}