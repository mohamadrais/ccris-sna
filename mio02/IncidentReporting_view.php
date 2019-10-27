<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/IncidentReporting.php");
	include("$currDir/IncidentReporting_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('IncidentReporting');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "IncidentReporting";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`IncidentReporting`.`id`" => "id",
		"`IncidentReporting`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ':: ', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`IncidentReporting`.`fo_DocItem`" => "fo_DocItem",
		"`IncidentReporting`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`IncidentReporting`.`fo_Classification`" => "fo_Classification",
		"`IncidentReporting`.`fo_Impact`" => "fo_Impact",
		"if(`IncidentReporting`.`fo_regdate`,date_format(`IncidentReporting`.`fo_regdate`,'%m/%d/%Y'),'')" => "fo_regdate",
		"CONCAT_WS('-', LEFT(`IncidentReporting`.`ot_FileLoc`,3), MID(`IncidentReporting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`IncidentReporting`.`ot_otherdetails`" => "ot_otherdetails",
		"`IncidentReporting`.`ot_comments`" => "ot_comments",
		"`IncidentReporting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`IncidentReporting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`IncidentReporting`.`ot_Ref01`" => "ot_Ref01",
		"`IncidentReporting`.`ot_Ref02`" => "ot_Ref02",
		"`IncidentReporting`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`IncidentReporting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`IncidentReporting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`IncidentReporting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`IncidentReporting`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`IncidentReporting`.`fo_regdate`',
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
		23 => '`IncidentReporting`.`ot_ap_filed`',
		24 => '`IncidentReporting`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`IncidentReporting`.`id`" => "id",
		"`IncidentReporting`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ':: ', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`IncidentReporting`.`fo_DocItem`" => "fo_DocItem",
		"`IncidentReporting`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`IncidentReporting`.`fo_Classification`" => "fo_Classification",
		"`IncidentReporting`.`fo_Impact`" => "fo_Impact",
		"if(`IncidentReporting`.`fo_regdate`,date_format(`IncidentReporting`.`fo_regdate`,'%m/%d/%Y'),'')" => "fo_regdate",
		"CONCAT_WS('-', LEFT(`IncidentReporting`.`ot_FileLoc`,3), MID(`IncidentReporting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`IncidentReporting`.`ot_otherdetails`" => "ot_otherdetails",
		"`IncidentReporting`.`ot_comments`" => "ot_comments",
		"`IncidentReporting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`IncidentReporting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`IncidentReporting`.`ot_Ref01`" => "ot_Ref01",
		"`IncidentReporting`.`ot_Ref02`" => "ot_Ref02",
		"`IncidentReporting`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`IncidentReporting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`IncidentReporting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`IncidentReporting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`IncidentReporting`.`id`" => "ID",
		"`IncidentReporting`.`DocconNumber`" => "Record ID",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ':: ', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "Work Location",
		"`IncidentReporting`.`fo_DocItem`" => "Title",
		"`IncidentReporting`.`fo_DocumentDescription`" => "Description",
		"`IncidentReporting`.`fo_Classification`" => "Classification",
		"`IncidentReporting`.`fo_Impact`" => "Direct Impact",
		"`IncidentReporting`.`fo_regdate`" => "Register date",
		"`IncidentReporting`.`ot_FileLoc`" => "File Location & Number",
		"`IncidentReporting`.`ot_otherdetails`" => "Other details",
		"`IncidentReporting`.`ot_comments`" => "Comments",
		"`IncidentReporting`.`ot_SharedLink1`" => "Shared Link 1",
		"`IncidentReporting`.`ot_SharedLink2`" => "Shared Link 2",
		"`IncidentReporting`.`ot_Ref01`" => "Reference_1",
		"`IncidentReporting`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`IncidentReporting`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`IncidentReporting`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`IncidentReporting`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`IncidentReporting`.`ot_ap_filed`" => "Register",
		"`IncidentReporting`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`IncidentReporting`.`id`" => "id",
		"`IncidentReporting`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ':: ', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`IncidentReporting`.`fo_DocItem`" => "fo_DocItem",
		"`IncidentReporting`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`IncidentReporting`.`fo_Classification`" => "fo_Classification",
		"`IncidentReporting`.`fo_Impact`" => "fo_Impact",
		"if(`IncidentReporting`.`fo_regdate`,date_format(`IncidentReporting`.`fo_regdate`,'%m/%d/%Y'),'')" => "fo_regdate",
		"CONCAT_WS('-', LEFT(`IncidentReporting`.`ot_FileLoc`,3), MID(`IncidentReporting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`IncidentReporting`.`ot_otherdetails`" => "ot_otherdetails",
		"`IncidentReporting`.`ot_comments`" => "ot_comments",
		"`IncidentReporting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`IncidentReporting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`IncidentReporting`.`ot_Ref01`" => "ot_Ref01",
		"`IncidentReporting`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`IncidentReporting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`IncidentReporting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`IncidentReporting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`IncidentReporting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'BaseLocation' => 'Work Location', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`IncidentReporting` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`IncidentReporting`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`IncidentReporting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`IncidentReporting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`IncidentReporting`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "IncidentReporting_view.php";
	$x->RedirectAfterInsert = "IncidentReporting_view.php?SelectedID=#ID#";
	$x->TableTitle = "Incident & Accident Reporting";
	$x->TableIcon = "resources/table_icons/application_put.png";
	$x->PrimaryKey = "`IncidentReporting`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 200, 120, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Work Location", "Title", "Classification", "Direct Impact", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'BaseLocation', 'fo_DocItem', 'fo_Classification', 'fo_Impact', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 17, 19, 21, 23, 24);

	// template paths below are based on the app main directory
	$x->Template = 'templates/IncidentReporting_templateTV.html';
	$x->SelectedTemplate = 'templates/IncidentReporting_templateTVS.html';
	$x->TemplateDV = 'templates/IncidentReporting_templateDV.html';
	$x->TemplateDVP = 'templates/IncidentReporting_templateDVP.html';

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
		$x->QueryWhere="where `IncidentReporting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='IncidentReporting' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `IncidentReporting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='IncidentReporting' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`IncidentReporting`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: IncidentReporting_init
	$render=TRUE;
	if(function_exists('IncidentReporting_init')){
		$args=array();
		$render=IncidentReporting_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: IncidentReporting_header
	$headerCode='';
	if(function_exists('IncidentReporting_header')){
		$args=array();
		$headerCode=IncidentReporting_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: IncidentReporting_footer
	$footerCode='';
	if(function_exists('IncidentReporting_footer')){
		$args=array();
		$footerCode=IncidentReporting_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>