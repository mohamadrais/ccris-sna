<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/WorkEnvMonitoring.php");
	include("$currDir/WorkEnvMonitoring_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('WorkEnvMonitoring');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "WorkEnvMonitoring";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`WorkEnvMonitoring`.`id`" => "id",
		"`WorkEnvMonitoring`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`WorkEnvMonitoring`.`fo_DocItem`" => "fo_DocItem",
		"`WorkEnvMonitoring`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`WorkEnvMonitoring`.`fo_Classification`" => "fo_Classification",
		"`WorkEnvMonitoring`.`fo_Impact`" => "fo_Impact",
		"if(`WorkEnvMonitoring`.`fo_Regdate`,date_format(`WorkEnvMonitoring`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`WorkEnvMonitoring`.`ot_FileLoc`,3), MID(`WorkEnvMonitoring`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`WorkEnvMonitoring`.`ot_otherDetails`" => "ot_otherDetails",
		"`WorkEnvMonitoring`.`ot_comments`" => "ot_comments",
		"`WorkEnvMonitoring`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`WorkEnvMonitoring`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`WorkEnvMonitoring`.`ot_Ref01`" => "ot_Ref01",
		"`WorkEnvMonitoring`.`ot_Ref02`" => "ot_Ref02",
		"`WorkEnvMonitoring`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`WorkEnvMonitoring`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`WorkEnvMonitoring`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`WorkEnvMonitoring`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`WorkEnvMonitoring`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`WorkEnvMonitoring`.`fo_Regdate`',
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => '`Leadership1`.`Status`',
		18 => 18,
		19 => '`Approval1`.`Status`',
		20 => 20,
		21 => '`IMSControl1`.`Status`',
		22 => 22,
		23 => '`WorkEnvMonitoring`.`ot_ap_filed`',
		24 => '`WorkEnvMonitoring`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`WorkEnvMonitoring`.`id`" => "id",
		"`WorkEnvMonitoring`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`WorkEnvMonitoring`.`fo_DocItem`" => "fo_DocItem",
		"`WorkEnvMonitoring`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`WorkEnvMonitoring`.`fo_Classification`" => "fo_Classification",
		"`WorkEnvMonitoring`.`fo_Impact`" => "fo_Impact",
		"if(`WorkEnvMonitoring`.`fo_Regdate`,date_format(`WorkEnvMonitoring`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`WorkEnvMonitoring`.`ot_FileLoc`,3), MID(`WorkEnvMonitoring`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`WorkEnvMonitoring`.`ot_otherDetails`" => "ot_otherDetails",
		"`WorkEnvMonitoring`.`ot_comments`" => "ot_comments",
		"`WorkEnvMonitoring`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`WorkEnvMonitoring`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`WorkEnvMonitoring`.`ot_Ref01`" => "ot_Ref01",
		"`WorkEnvMonitoring`.`ot_Ref02`" => "ot_Ref02",
		"`WorkEnvMonitoring`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`WorkEnvMonitoring`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`WorkEnvMonitoring`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`WorkEnvMonitoring`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`WorkEnvMonitoring`.`id`" => "ID",
		"`WorkEnvMonitoring`.`DocconNumber`" => "Record ID",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "Work Location",
		"`WorkEnvMonitoring`.`fo_DocItem`" => "Title",
		"`WorkEnvMonitoring`.`fo_DocumentDescription`" => "Description",
		"`WorkEnvMonitoring`.`fo_Classification`" => "Classification",
		"`WorkEnvMonitoring`.`fo_Impact`" => "Direct Impact",
		"`WorkEnvMonitoring`.`fo_Regdate`" => "Register date",
		"`WorkEnvMonitoring`.`ot_FileLoc`" => "File Location & Number",
		"`WorkEnvMonitoring`.`ot_otherDetails`" => "Other details",
		"`WorkEnvMonitoring`.`ot_comments`" => "Comments",
		"`WorkEnvMonitoring`.`ot_SharedLink1`" => "Shared Link 1",
		"`WorkEnvMonitoring`.`ot_SharedLink2`" => "Shared Link 2",
		"`WorkEnvMonitoring`.`ot_Ref01`" => "Reference_1",
		"`WorkEnvMonitoring`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`WorkEnvMonitoring`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`WorkEnvMonitoring`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`WorkEnvMonitoring`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`WorkEnvMonitoring`.`ot_ap_filed`" => "Register",
		"`WorkEnvMonitoring`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`WorkEnvMonitoring`.`id`" => "id",
		"`WorkEnvMonitoring`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`WorkEnvMonitoring`.`fo_DocItem`" => "fo_DocItem",
		"`WorkEnvMonitoring`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`WorkEnvMonitoring`.`fo_Classification`" => "fo_Classification",
		"`WorkEnvMonitoring`.`fo_Impact`" => "fo_Impact",
		"if(`WorkEnvMonitoring`.`fo_Regdate`,date_format(`WorkEnvMonitoring`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`WorkEnvMonitoring`.`ot_FileLoc`,3), MID(`WorkEnvMonitoring`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`WorkEnvMonitoring`.`ot_otherDetails`" => "ot_otherDetails",
		"`WorkEnvMonitoring`.`ot_comments`" => "ot_comments",
		"`WorkEnvMonitoring`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`WorkEnvMonitoring`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`WorkEnvMonitoring`.`ot_Ref01`" => "ot_Ref01",
		"`WorkEnvMonitoring`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`WorkEnvMonitoring`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`WorkEnvMonitoring`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`WorkEnvMonitoring`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`WorkEnvMonitoring`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'BaseLocation' => 'Work Location', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`WorkEnvMonitoring` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`WorkEnvMonitoring`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`WorkEnvMonitoring`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`WorkEnvMonitoring`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`WorkEnvMonitoring`.`ot_ap_QC` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "WorkEnvMonitoring_view.php";
	$x->RedirectAfterInsert = "WorkEnvMonitoring_view.php?SelectedID=#ID#";
	$x->TableTitle = "Work Environment Monitoring and Control";
	$x->TableIcon = "resources/table_icons/brick_edit.png";
	$x->PrimaryKey = "`WorkEnvMonitoring`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 200, 120, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Work Location", "Title", "Classification", "Direct Impact", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'BaseLocation', 'fo_DocItem', 'fo_Classification', 'fo_Impact', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 17, 19, 21, 23, 24);

	// template paths below are based on the app main directory
	$x->Template = 'templates/WorkEnvMonitoring_templateTV.html';
	$x->SelectedTemplate = 'templates/WorkEnvMonitoring_templateTVS.html';
	$x->TemplateDV = 'templates/WorkEnvMonitoring_templateDV.html';
	$x->TemplateDVP = 'templates/WorkEnvMonitoring_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `WorkEnvMonitoring`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='WorkEnvMonitoring' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `WorkEnvMonitoring`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='WorkEnvMonitoring' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`WorkEnvMonitoring`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: WorkEnvMonitoring_init
	$render=TRUE;
	if(function_exists('WorkEnvMonitoring_init')){
		$args=array();
		$render=WorkEnvMonitoring_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: WorkEnvMonitoring_header
	$headerCode='';
	if(function_exists('WorkEnvMonitoring_header')){
		$args=array();
		$headerCode=WorkEnvMonitoring_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: WorkEnvMonitoring_footer
	$footerCode='';
	if(function_exists('WorkEnvMonitoring_footer')){
		$args=array();
		$footerCode=WorkEnvMonitoring_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>