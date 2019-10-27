<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/MWOPlanned.php");
	include("$currDir/MWOPlanned_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('MWOPlanned');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "MWOPlanned";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`MWOPlanned`.`WMOPlannedID`" => "WMOPlannedID",
		"`MWOPlanned`.`PlannedID`" => "PlannedID",
		"IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') /* MWO ID */" => "MwoID",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee Name */" => "fo_EmployeeID",
		"IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`, ' '), '') /* Position */" => "fo_Position",
		"CONCAT_WS('-', LEFT(`MWOPlanned`.`ot_FileLoc`,3), MID(`MWOPlanned`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MWOPlanned`.`ot_otherdetails`" => "ot_otherdetails",
		"`MWOPlanned`.`ot_comments`" => "ot_comments",
		"`MWOPlanned`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MWOPlanned`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MWOPlanned`.`ot_Ref01`" => "ot_Ref01",
		"`MWOPlanned`.`ot_Ref02`" => "ot_Ref02",
		"`MWOPlanned`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MWOPlanned`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MWOPlanned`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MWOPlanned`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`MWOPlanned`.`WMOPlannedID`',
		2 => '`MWOPlanned`.`PlannedID`',
		3 => '`MWO1`.`MWONumber`',
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
		14 => '`Leadership1`.`Status`',
		15 => 15,
		16 => '`Approval1`.`Status`',
		17 => 17,
		18 => '`IMSControl1`.`Status`',
		19 => 19,
		20 => '`MWOPlanned`.`ot_ap_filed`',
		21 => '`MWOPlanned`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`MWOPlanned`.`WMOPlannedID`" => "WMOPlannedID",
		"`MWOPlanned`.`PlannedID`" => "PlannedID",
		"IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') /* MWO ID */" => "MwoID",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee Name */" => "fo_EmployeeID",
		"IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`, ' '), '') /* Position */" => "fo_Position",
		"CONCAT_WS('-', LEFT(`MWOPlanned`.`ot_FileLoc`,3), MID(`MWOPlanned`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MWOPlanned`.`ot_otherdetails`" => "ot_otherdetails",
		"`MWOPlanned`.`ot_comments`" => "ot_comments",
		"`MWOPlanned`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MWOPlanned`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MWOPlanned`.`ot_Ref01`" => "ot_Ref01",
		"`MWOPlanned`.`ot_Ref02`" => "ot_Ref02",
		"`MWOPlanned`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MWOPlanned`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MWOPlanned`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MWOPlanned`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`MWOPlanned`.`WMOPlannedID`" => "ID",
		"`MWOPlanned`.`PlannedID`" => "Planned MWO Record Number",
		"IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') /* MWO ID */" => "MWO ID",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee Name */" => "Employee Name",
		"IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`, ' '), '') /* Position */" => "Position",
		"`MWOPlanned`.`ot_FileLoc`" => "File Location & Number",
		"`MWOPlanned`.`ot_otherdetails`" => "Other details",
		"`MWOPlanned`.`ot_comments`" => "Comments",
		"`MWOPlanned`.`ot_SharedLink1`" => "Shared Link 1",
		"`MWOPlanned`.`ot_SharedLink2`" => "Shared Link 2",
		"`MWOPlanned`.`ot_Ref01`" => "Reference_1",
		"`MWOPlanned`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`MWOPlanned`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`MWOPlanned`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`MWOPlanned`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`MWOPlanned`.`ot_ap_filed`" => "Register",
		"`MWOPlanned`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`MWOPlanned`.`WMOPlannedID`" => "WMOPlannedID",
		"`MWOPlanned`.`PlannedID`" => "PlannedID",
		"IF(    CHAR_LENGTH(`MWO1`.`MWONumber`), CONCAT_WS('',   `MWO1`.`MWONumber`), '') /* MWO ID */" => "MwoID",
		"IF(    CHAR_LENGTH(`employees1`.`EmpNo`) || CHAR_LENGTH(`employees1`.`Name`), CONCAT_WS('',   `employees1`.`EmpNo`, '; ', `employees1`.`Name`), '') /* Employee Name */" => "fo_EmployeeID",
		"IF(    CHAR_LENGTH(`employees1`.`fo_Position`), CONCAT_WS('',   `employees1`.`fo_Position`, ' '), '') /* Position */" => "fo_Position",
		"CONCAT_WS('-', LEFT(`MWOPlanned`.`ot_FileLoc`,3), MID(`MWOPlanned`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`MWOPlanned`.`ot_otherdetails`" => "ot_otherdetails",
		"`MWOPlanned`.`ot_comments`" => "ot_comments",
		"`MWOPlanned`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`MWOPlanned`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`MWOPlanned`.`ot_Ref01`" => "ot_Ref01",
		"`MWOPlanned`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`MWOPlanned`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`MWOPlanned`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`MWOPlanned`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`MWOPlanned`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'MwoID' => 'MWO ID', 'fo_EmployeeID' => 'Employee Name', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`MWOPlanned` LEFT JOIN `MWO` as MWO1 ON `MWO1`.`id`=`MWOPlanned`.`MwoID` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`MWOPlanned`.`fo_EmployeeID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`MWOPlanned`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`MWOPlanned`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`MWOPlanned`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "MWOPlanned_view.php";
	$x->RedirectAfterInsert = "MWOPlanned_view.php?SelectedID=#ID#";
	$x->TableTitle = "Planned Scheduled";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`MWOPlanned`.`WMOPlannedID`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 70, 120, 120, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Planned MWO Record Number", "MWO ID", "Employee Name", "Position", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('PlannedID', 'MwoID', 'fo_EmployeeID', 'fo_Position', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 14, 16, 18, 20, 21);

	// template paths below are based on the app main directory
	$x->Template = 'templates/MWOPlanned_templateTV.html';
	$x->SelectedTemplate = 'templates/MWOPlanned_templateTVS.html';
	$x->TemplateDV = 'templates/MWOPlanned_templateDV.html';
	$x->TemplateDVP = 'templates/MWOPlanned_templateDVP.html';

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
		$x->QueryWhere="where `MWOPlanned`.`WMOPlannedID`=membership_userrecords.pkValue and membership_userrecords.tableName='MWOPlanned' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `MWOPlanned`.`WMOPlannedID`=membership_userrecords.pkValue and membership_userrecords.tableName='MWOPlanned' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`MWOPlanned`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: MWOPlanned_init
	$render=TRUE;
	if(function_exists('MWOPlanned_init')){
		$args=array();
		$render=MWOPlanned_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: MWOPlanned_header
	$headerCode='';
	if(function_exists('MWOPlanned_header')){
		$args=array();
		$headerCode=MWOPlanned_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: MWOPlanned_footer
	$footerCode='';
	if(function_exists('MWOPlanned_footer')){
		$args=array();
		$footerCode=MWOPlanned_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>