<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/MonthlyTimesheet.php");
	include("$currDir/MonthlyTimesheet_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('MonthlyTimesheet');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "MonthlyTimesheet";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`MonthlyTimesheet`.`id`" => "id",
		"`MonthlyTimesheet`.`TimesheetID`" => "TimesheetID",
		"IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') /* Project Execution */" => "MTSID",
		"`MonthlyTimesheet`.`fo_Class`" => "fo_Class",
		"`MonthlyTimesheet`.`fo_DocItem`" => "fo_DocItem",
		"`MonthlyTimesheet`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"CONCAT_WS('-', LEFT(`MonthlyTimesheet`.`ot_FileLoc`,3), MID(`MonthlyTimesheet`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MonthlyTimesheet`.`ot_otherdetails`" => "ot_otherdetails",
		"`MonthlyTimesheet`.`ot_comments`" => "ot_comments",
		"`MonthlyTimesheet`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MonthlyTimesheet`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MonthlyTimesheet`.`ot_Ref01`" => "ot_Ref01",
		"`MonthlyTimesheet`.`ot_Ref02`" => "ot_Ref02",
		"`MonthlyTimesheet`.`ot_Ref03`" => "ot_Ref03",
		"`MonthlyTimesheet`.`ot_Ref04`" => "ot_Ref04",
		"`MonthlyTimesheet`.`ot_Ref05`" => "ot_Ref05",
		"`MonthlyTimesheet`.`ot_Ref06`" => "ot_Ref06",
		"`MonthlyTimesheet`.`ot_Photo01`" => "ot_Photo01",
		"`MonthlyTimesheet`.`ot_Photo02`" => "ot_Photo02",
		"`MonthlyTimesheet`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MonthlyTimesheet`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MonthlyTimesheet`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MonthlyTimesheet`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`MonthlyTimesheet`.`ot_ap_filed`,date_format(`MonthlyTimesheet`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`MonthlyTimesheet`.`ot_ap_lastmodified`,date_format(`MonthlyTimesheet`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`MonthlyTimesheet`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => 17,
		18 => 18,
		19 => 19,
		20 => 20,
		21 => '`Leadership1`.`Status`',
		22 => 22,
		23 => '`Approval1`.`Status`',
		24 => 24,
		25 => '`IMSControl1`.`Status`',
		26 => 26,
		27 => '`MonthlyTimesheet`.`ot_ap_filed`',
		28 => '`MonthlyTimesheet`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`MonthlyTimesheet`.`id`" => "id",
		"`MonthlyTimesheet`.`TimesheetID`" => "TimesheetID",
		"IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') /* Project Execution */" => "MTSID",
		"`MonthlyTimesheet`.`fo_Class`" => "fo_Class",
		"`MonthlyTimesheet`.`fo_DocItem`" => "fo_DocItem",
		"`MonthlyTimesheet`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"CONCAT_WS('-', LEFT(`MonthlyTimesheet`.`ot_FileLoc`,3), MID(`MonthlyTimesheet`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MonthlyTimesheet`.`ot_otherdetails`" => "ot_otherdetails",
		"`MonthlyTimesheet`.`ot_comments`" => "ot_comments",
		"`MonthlyTimesheet`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MonthlyTimesheet`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MonthlyTimesheet`.`ot_Ref01`" => "ot_Ref01",
		"`MonthlyTimesheet`.`ot_Ref02`" => "ot_Ref02",
		"`MonthlyTimesheet`.`ot_Ref03`" => "ot_Ref03",
		"`MonthlyTimesheet`.`ot_Ref04`" => "ot_Ref04",
		"`MonthlyTimesheet`.`ot_Ref05`" => "ot_Ref05",
		"`MonthlyTimesheet`.`ot_Ref06`" => "ot_Ref06",
		"`MonthlyTimesheet`.`ot_Photo01`" => "ot_Photo01",
		"`MonthlyTimesheet`.`ot_Photo02`" => "ot_Photo02",
		"`MonthlyTimesheet`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MonthlyTimesheet`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MonthlyTimesheet`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MonthlyTimesheet`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`MonthlyTimesheet`.`ot_ap_filed`,date_format(`MonthlyTimesheet`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`MonthlyTimesheet`.`ot_ap_lastmodified`,date_format(`MonthlyTimesheet`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`MonthlyTimesheet`.`id`" => "ID",
		"`MonthlyTimesheet`.`TimesheetID`" => "Record ID",
		"IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') /* Project Execution */" => "Project Execution",
		"`MonthlyTimesheet`.`fo_Class`" => "Classification",
		"`MonthlyTimesheet`.`fo_DocItem`" => "Title",
		"`MonthlyTimesheet`.`fo_DocumentDescription`" => "Description",
		"`MonthlyTimesheet`.`ot_FileLoc`" => "File Location & Number",
		"`MonthlyTimesheet`.`ot_otherdetails`" => "Other details",
		"`MonthlyTimesheet`.`ot_comments`" => "Comments",
		"`MonthlyTimesheet`.`ot_SharedLink1`" => "Shared Link 1",
		"`MonthlyTimesheet`.`ot_SharedLink2`" => "Shared Link 2",
		"`MonthlyTimesheet`.`ot_Ref01`" => "Reference_1",
		"`MonthlyTimesheet`.`ot_Ref02`" => "Reference_2",
		"`MonthlyTimesheet`.`ot_Ref03`" => "Reference_3",
		"`MonthlyTimesheet`.`ot_Ref04`" => "Reference_4",
		"`MonthlyTimesheet`.`ot_Ref05`" => "Reference_5",
		"`MonthlyTimesheet`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`MonthlyTimesheet`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`MonthlyTimesheet`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`MonthlyTimesheet`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`MonthlyTimesheet`.`ot_ap_filed`" => "Register",
		"`MonthlyTimesheet`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`MonthlyTimesheet`.`id`" => "id",
		"`MonthlyTimesheet`.`TimesheetID`" => "TimesheetID",
		"IF(    CHAR_LENGTH(`PROExecution1`.`ExecutionNo`) || CHAR_LENGTH(`PROExecution1`.`fo_DocItem`), CONCAT_WS('',   `PROExecution1`.`ExecutionNo`, '::', `PROExecution1`.`fo_DocItem`), '') /* Project Execution */" => "MTSID",
		"`MonthlyTimesheet`.`fo_Class`" => "fo_Class",
		"`MonthlyTimesheet`.`fo_DocItem`" => "fo_DocItem",
		"`MonthlyTimesheet`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"CONCAT_WS('-', LEFT(`MonthlyTimesheet`.`ot_FileLoc`,3), MID(`MonthlyTimesheet`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MonthlyTimesheet`.`ot_otherdetails`" => "ot_otherdetails",
		"`MonthlyTimesheet`.`ot_comments`" => "ot_comments",
		"`MonthlyTimesheet`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MonthlyTimesheet`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MonthlyTimesheet`.`ot_Ref01`" => "ot_Ref01",
		"`MonthlyTimesheet`.`ot_Ref02`" => "ot_Ref02",
		"`MonthlyTimesheet`.`ot_Ref03`" => "ot_Ref03",
		"`MonthlyTimesheet`.`ot_Ref04`" => "ot_Ref04",
		"`MonthlyTimesheet`.`ot_Ref05`" => "ot_Ref05",
		"`MonthlyTimesheet`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MonthlyTimesheet`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MonthlyTimesheet`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MonthlyTimesheet`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`MonthlyTimesheet`.`ot_ap_filed`,date_format(`MonthlyTimesheet`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`MonthlyTimesheet`.`ot_ap_lastmodified`,date_format(`MonthlyTimesheet`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'MTSID' => 'Project Execution', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`MonthlyTimesheet` LEFT JOIN `PROExecution` as PROExecution1 ON `PROExecution1`.`id`=`MonthlyTimesheet`.`MTSID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MonthlyTimesheet`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MonthlyTimesheet`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MonthlyTimesheet`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "MonthlyTimesheet_view.php";
	$x->RedirectAfterInsert = "MonthlyTimesheet_view.php?SelectedID=#ID#";
	$x->TableTitle = "Monthly Timesheet";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`MonthlyTimesheet`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 70, 120, 120, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Project Execution", "Classification", "Title", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('TimesheetID', 'MTSID', 'fo_Class', 'fo_DocItem', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 21, 23, 25, 27, 28);

	// template paths below are based on the app main directory
	$x->Template = 'templates/MonthlyTimesheet_templateTV.html';
	$x->SelectedTemplate = 'templates/MonthlyTimesheet_templateTVS.html';
	$x->TemplateDV = 'templates/MonthlyTimesheet_templateDV.html';
	$x->TemplateDVP = 'templates/MonthlyTimesheet_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `MonthlyTimesheet`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='MonthlyTimesheet' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `MonthlyTimesheet`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='MonthlyTimesheet' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`MonthlyTimesheet`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: MonthlyTimesheet_init
	$render=TRUE;
	if(function_exists('MonthlyTimesheet_init')){
		$args=array();
		$render=MonthlyTimesheet_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: MonthlyTimesheet_header
	$headerCode='';
	if(function_exists('MonthlyTimesheet_header')){
		$args=array();
		$headerCode=MonthlyTimesheet_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: MonthlyTimesheet_footer
	$footerCode='';
	if(function_exists('MonthlyTimesheet_footer')){
		$args=array();
		$footerCode=MonthlyTimesheet_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>