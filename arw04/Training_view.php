<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Training.php");
	include("$currDir/Training_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Training');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Training";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Training`.`TrainingID`" => "TrainingID",
		"`Training`.`TraningNo`" => "TraningNo",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee */" => "EmployeeID",
		"IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') /* Project Team ID */" => "ProjectTeamID",
		"`Training`.`fo_TrainingSession`" => "fo_TrainingSession",
		"`Training`.`fo_Classification`" => "fo_Classification",
		"`Training`.`fo_Description`" => "fo_Description",
		"if(`Training`.`fo_Date`,date_format(`Training`.`fo_Date`,'%m/%d/%Y'),'')" => "fo_Date",
		"CONCAT_WS('-', LEFT(`Training`.`ot_FileLoc`,3), MID(`Training`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Training`.`ot_otherdetails`" => "ot_otherdetails",
		"`Training`.`ot_comments`" => "ot_comments",
		"`Training`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Training`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Training`.`ot_Ref01`" => "ot_Ref01",
		"`Training`.`ot_Ref02`" => "ot_Ref02",
		"`Training`.`ot_Photo`" => "ot_Photo",
		"DATE_FORMAT(`Training`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Training`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Training`.`TrainingID`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`Training`.`fo_Date`',
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => '`Training`.`ot_ap_filed`',
		18 => '`Training`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Training`.`TrainingID`" => "TrainingID",
		"`Training`.`TraningNo`" => "TraningNo",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee */" => "EmployeeID",
		"IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') /* Project Team ID */" => "ProjectTeamID",
		"`Training`.`fo_TrainingSession`" => "fo_TrainingSession",
		"`Training`.`fo_Classification`" => "fo_Classification",
		"`Training`.`fo_Description`" => "fo_Description",
		"if(`Training`.`fo_Date`,date_format(`Training`.`fo_Date`,'%m/%d/%Y'),'')" => "fo_Date",
		"CONCAT_WS('-', LEFT(`Training`.`ot_FileLoc`,3), MID(`Training`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Training`.`ot_otherdetails`" => "ot_otherdetails",
		"`Training`.`ot_comments`" => "ot_comments",
		"`Training`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Training`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Training`.`ot_Ref01`" => "ot_Ref01",
		"`Training`.`ot_Ref02`" => "ot_Ref02",
		"`Training`.`ot_Photo`" => "ot_Photo",
		"DATE_FORMAT(`Training`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Training`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Training`.`TrainingID`" => "TrainingID",
		"`Training`.`TraningNo`" => "Training Record Number",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee */" => "Employee",
		"IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') /* Project Team ID */" => "Project Team ID",
		"`Training`.`fo_TrainingSession`" => "Training Session",
		"`Training`.`fo_Classification`" => "Training Related Record",
		"`Training`.`fo_Description`" => "Training Description",
		"`Training`.`fo_Date`" => "Training Date",
		"`Training`.`ot_FileLoc`" => "File Location & Number",
		"`Training`.`ot_otherdetails`" => "Other details",
		"`Training`.`ot_comments`" => "Comments",
		"`Training`.`ot_SharedLink1`" => "Shared Link 1",
		"`Training`.`ot_SharedLink2`" => "Shared Link 2",
		"`Training`.`ot_Ref01`" => "Reference_1",
		"`Training`.`ot_Ref02`" => "Reference_2",
		"`Training`.`ot_ap_filed`" => "Register",
		"`Training`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Training`.`TrainingID`" => "TrainingID",
		"`Training`.`TraningNo`" => "TraningNo",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee */" => "EmployeeID",
		"IF(    CHAR_LENGTH(`ProjectTeam1`.`EmpNo`) || CHAR_LENGTH(`ProjectTeam1`.`Name`), CONCAT_WS('',   `ProjectTeam1`.`EmpNo`, '; ', `ProjectTeam1`.`Name`), '') /* Project Team ID */" => "ProjectTeamID",
		"`Training`.`fo_TrainingSession`" => "fo_TrainingSession",
		"`Training`.`fo_Classification`" => "fo_Classification",
		"`Training`.`fo_Description`" => "fo_Description",
		"if(`Training`.`fo_Date`,date_format(`Training`.`fo_Date`,'%m/%d/%Y'),'')" => "fo_Date",
		"CONCAT_WS('-', LEFT(`Training`.`ot_FileLoc`,3), MID(`Training`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Training`.`ot_otherdetails`" => "ot_otherdetails",
		"`Training`.`ot_comments`" => "ot_comments",
		"`Training`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Training`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Training`.`ot_Ref01`" => "ot_Ref01",
		"`Training`.`ot_Ref02`" => "ot_Ref02",
		"DATE_FORMAT(`Training`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Training`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'EmployeeID' => 'Employee', 'ProjectTeamID' => 'Project Team ID');

	$x->QueryFrom = "`Training` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`Training`.`EmployeeID` LEFT JOIN `ProjectTeam` as ProjectTeam1 ON `ProjectTeam1`.`ProjectTeamID`=`Training`.`ProjectTeamID` ";
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
	$x->ScriptFileName = "Training_view.php";
	$x->RedirectAfterInsert = "Training_view.php?SelectedID=#ID#";
	$x->TableTitle = "Training";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`Training`.`TrainingID`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Training Record Number", "Employee", "Project Team ID", "Training Session", "Training Related Record", "Training Date", "Register", "Last modified");
	$x->ColFieldName = array('TraningNo', 'EmployeeID', 'ProjectTeamID', 'fo_TrainingSession', 'fo_Classification', 'fo_Date', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 8, 17, 18);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Training_templateTV.html';
	$x->SelectedTemplate = 'templates/Training_templateTVS.html';
	$x->TemplateDV = 'templates/Training_templateDV.html';
	$x->TemplateDVP = 'templates/Training_templateDVP.html';

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
		$x->QueryWhere="where `Training`.`TrainingID`=membership_userrecords.pkValue and membership_userrecords.tableName='Training' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Training`.`TrainingID`=membership_userrecords.pkValue and membership_userrecords.tableName='Training' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Training`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Training_init
	$render=TRUE;
	if(function_exists('Training_init')){
		$args=array();
		$render=Training_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Training_header
	$headerCode='';
	if(function_exists('Training_header')){
		$args=array();
		$headerCode=Training_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Training_footer
	$footerCode='';
	if(function_exists('Training_footer')){
		$args=array();
		$footerCode=Training_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>