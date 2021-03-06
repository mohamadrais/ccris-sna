<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Audit.php");
	include("$currDir/Audit_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Audit');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Audit";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Audit`.`id`" => "id",
		"`Audit`.`AuditNo`" => "AuditNo",
		"`Audit`.`Rectitle`" => "Rectitle",
		"`Audit`.`fo_Desc`" => "fo_Desc",
		"`Audit`.`fo_Auditor`" => "fo_Auditor",
		"`Audit`.`fo_Classification`" => "fo_Classification",
		"if(`Audit`.`fo_Regdate`,date_format(`Audit`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditMemo`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditMemo",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditPlan`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditPlan",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditNote`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditNote",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditReport`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditReport",
		"`Audit`.`fo_NoObservation`" => "fo_NoObservation",
		"`Audit`.`fo_NoMinorNC`" => "fo_NoMinorNC",
		"`Audit`.`fo_NoMajorNC`" => "fo_NoMajorNC",
		"CONCAT_WS('-', LEFT(`Audit`.`ot_FileLoc`,3), MID(`Audit`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Audit`.`ot_otherdetails`" => "ot_otherdetails",
		"`Audit`.`ot_comments`" => "ot_comments",
		"`Audit`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Audit`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Audit`.`ot_Ref01`" => "ot_Ref01",
		"`Audit`.`ot_Ref02`" => "ot_Ref02",
		"`Audit`.`ot_Ref03`" => "ot_Ref03",
		"`Audit`.`ot_Ref04`" => "ot_Ref04",
		"`Audit`.`ot_Ref05`" => "ot_Ref05",
		"`Audit`.`ot_Ref06`" => "ot_Ref06",
		"`Audit`.`ot_Photo01`" => "ot_Photo01",
		"`Audit`.`ot_Photo02`" => "ot_Photo02",
		"`Audit`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Audit`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Audit`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Audit`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Audit`.`ot_ap_filed`,date_format(`Audit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Audit`.`ot_ap_lastmodified`,date_format(`Audit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Audit`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`Audit`.`fo_Regdate`',
		8 => '`Audit`.`fo_AuditMemo`',
		9 => '`Audit`.`fo_AuditPlan`',
		10 => '`Audit`.`fo_AuditNote`',
		11 => '`Audit`.`fo_AuditReport`',
		12 => '`Audit`.`fo_NoObservation`',
		13 => '`Audit`.`fo_NoMinorNC`',
		14 => '`Audit`.`fo_NoMajorNC`',
		15 => 15,
		16 => 16,
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => 21,
		22 => 22,
		23 => 23,
		24 => 24,
		25 => 25,
		26 => 26,
		27 => 27,
		28 => 28,
		29 => '`Leadership1`.`Status`',
		30 => 30,
		31 => '`Approval1`.`Status`',
		32 => 32,
		33 => '`IMSControl1`.`Status`',
		34 => 34,
		35 => '`Audit`.`ot_ap_filed`',
		36 => '`Audit`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Audit`.`id`" => "id",
		"`Audit`.`AuditNo`" => "AuditNo",
		"`Audit`.`Rectitle`" => "Rectitle",
		"`Audit`.`fo_Desc`" => "fo_Desc",
		"`Audit`.`fo_Auditor`" => "fo_Auditor",
		"`Audit`.`fo_Classification`" => "fo_Classification",
		"if(`Audit`.`fo_Regdate`,date_format(`Audit`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"`Audit`.`fo_AuditMemo`" => "fo_AuditMemo",
		"`Audit`.`fo_AuditPlan`" => "fo_AuditPlan",
		"`Audit`.`fo_AuditNote`" => "fo_AuditNote",
		"`Audit`.`fo_AuditReport`" => "fo_AuditReport",
		"`Audit`.`fo_NoObservation`" => "fo_NoObservation",
		"`Audit`.`fo_NoMinorNC`" => "fo_NoMinorNC",
		"`Audit`.`fo_NoMajorNC`" => "fo_NoMajorNC",
		"CONCAT_WS('-', LEFT(`Audit`.`ot_FileLoc`,3), MID(`Audit`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Audit`.`ot_otherdetails`" => "ot_otherdetails",
		"`Audit`.`ot_comments`" => "ot_comments",
		"`Audit`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Audit`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Audit`.`ot_Ref01`" => "ot_Ref01",
		"`Audit`.`ot_Ref02`" => "ot_Ref02",
		"`Audit`.`ot_Ref03`" => "ot_Ref03",
		"`Audit`.`ot_Ref04`" => "ot_Ref04",
		"`Audit`.`ot_Ref05`" => "ot_Ref05",
		"`Audit`.`ot_Ref06`" => "ot_Ref06",
		"`Audit`.`ot_Photo01`" => "ot_Photo01",
		"`Audit`.`ot_Photo02`" => "ot_Photo02",
		"`Audit`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Audit`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Audit`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Audit`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Audit`.`ot_ap_filed`,date_format(`Audit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Audit`.`ot_ap_lastmodified`,date_format(`Audit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Audit`.`id`" => "ID",
		"`Audit`.`AuditNo`" => "Record ID",
		"`Audit`.`Rectitle`" => "Title",
		"`Audit`.`fo_Desc`" => "Description",
		"`Audit`.`fo_Auditor`" => "Auditor",
		"`Audit`.`fo_Classification`" => "Audit Classification",
		"`Audit`.`fo_Regdate`" => "Register date",
		"`Audit`.`fo_AuditMemo`" => "Audit Notice Issued",
		"`Audit`.`fo_AuditPlan`" => "Audit Plan issued",
		"`Audit`.`fo_AuditNote`" => "Audit Note issued",
		"`Audit`.`fo_AuditReport`" => "Audit Report",
		"`Audit`.`fo_NoObservation`" => "Observation Number",
		"`Audit`.`fo_NoMinorNC`" => "Minor Non-Conformance Number",
		"`Audit`.`fo_NoMajorNC`" => "Major Non-Conformance Number",
		"`Audit`.`ot_FileLoc`" => "File Location & Number",
		"`Audit`.`ot_otherdetails`" => "Other details",
		"`Audit`.`ot_comments`" => "Comments",
		"`Audit`.`ot_SharedLink1`" => "Shared Link 1",
		"`Audit`.`ot_SharedLink2`" => "Shared Link 2",
		"`Audit`.`ot_Ref01`" => "Reference_1",
		"`Audit`.`ot_Ref02`" => "Reference_2",
		"`Audit`.`ot_Ref03`" => "Reference_3",
		"`Audit`.`ot_Ref04`" => "Reference_4",
		"`Audit`.`ot_Ref05`" => "Reference_5",
		"`Audit`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`Audit`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`Audit`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`Audit`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`Audit`.`ot_ap_filed`" => "Filed",
		"`Audit`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Audit`.`id`" => "id",
		"`Audit`.`AuditNo`" => "AuditNo",
		"`Audit`.`Rectitle`" => "Rectitle",
		"`Audit`.`fo_Desc`" => "fo_Desc",
		"`Audit`.`fo_Auditor`" => "fo_Auditor",
		"`Audit`.`fo_Classification`" => "fo_Classification",
		"if(`Audit`.`fo_Regdate`,date_format(`Audit`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditMemo`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditMemo",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditPlan`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditPlan",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditNote`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditNote",
		"concat('<i class=\"glyphicon glyphicon-', if(`Audit`.`fo_AuditReport`, 'check', 'unchecked'), '\"></i>')" => "fo_AuditReport",
		"`Audit`.`fo_NoObservation`" => "fo_NoObservation",
		"`Audit`.`fo_NoMinorNC`" => "fo_NoMinorNC",
		"`Audit`.`fo_NoMajorNC`" => "fo_NoMajorNC",
		"CONCAT_WS('-', LEFT(`Audit`.`ot_FileLoc`,3), MID(`Audit`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Audit`.`ot_otherdetails`" => "ot_otherdetails",
		"`Audit`.`ot_comments`" => "ot_comments",
		"`Audit`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Audit`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Audit`.`ot_Ref01`" => "ot_Ref01",
		"`Audit`.`ot_Ref02`" => "ot_Ref02",
		"`Audit`.`ot_Ref03`" => "ot_Ref03",
		"`Audit`.`ot_Ref04`" => "ot_Ref04",
		"`Audit`.`ot_Ref05`" => "ot_Ref05",
		"`Audit`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Audit`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Audit`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Audit`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Audit`.`ot_ap_filed`,date_format(`Audit`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Audit`.`ot_ap_lastmodified`,date_format(`Audit`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`Audit` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Audit`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Audit`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Audit`.`ot_ap_QC` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "Audit_view.php";
	$x->RedirectAfterInsert = "Audit_view.php?SelectedID=#ID#";
	$x->TableTitle = "Management System Audit";
	$x->TableIcon = "resources/table_icons/balance.png";
	$x->PrimaryKey = "`Audit`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 150, 70, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Title", "Auditor", "Audit Classification", "Register date", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('AuditNo', 'Rectitle', 'fo_Auditor', 'fo_Classification', 'fo_Regdate', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 5, 6, 7, 29, 31, 33, 35, 36);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Audit_templateTV.html';
	$x->SelectedTemplate = 'templates/Audit_templateTVS.html';
	$x->TemplateDV = 'templates/Audit_templateDV.html';
	$x->TemplateDVP = 'templates/Audit_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Audit`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Audit' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Audit`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Audit' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Audit`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Audit_init
	$render=TRUE;
	if(function_exists('Audit_init')){
		$args=array();
		$render=Audit_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Audit_header
	$headerCode='';
	if(function_exists('Audit_header')){
		$args=array();
		$headerCode=Audit_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Audit_footer
	$footerCode='';
	if(function_exists('Audit_footer')){
		$args=array();
		$footerCode=Audit_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>