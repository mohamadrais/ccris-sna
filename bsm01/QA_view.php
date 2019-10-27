<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/QA.php");
	include("$currDir/QA_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('QA');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "QA";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`QA`.`id`" => "id",
		"`QA`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`QA`.`fo_DocItem`" => "fo_DocItem",
		"`QA`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`QA`.`fo_Class`" => "fo_Class",
		"`QA`.`fo_Classification`" => "fo_Classification",
		"if(`QA`.`fo_Regdate`,date_format(`QA`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`QA`.`ot_FileLoc`,3), MID(`QA`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QA`.`ot_otherdetails`" => "ot_otherdetails",
		"`QA`.`ot_comments`" => "ot_comments",
		"`QA`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QA`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QA`.`ot_Ref01`" => "ot_Ref01",
		"`QA`.`ot_Ref02`" => "ot_Ref02",
		"`QA`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QA`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QA`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QA`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QA`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QA`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`QA`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`QA`.`fo_Regdate`',
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
		23 => '`QA`.`ot_ap_filed`',
		24 => '`QA`.`ot_ap_last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`QA`.`id`" => "id",
		"`QA`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`QA`.`fo_DocItem`" => "fo_DocItem",
		"`QA`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`QA`.`fo_Class`" => "fo_Class",
		"`QA`.`fo_Classification`" => "fo_Classification",
		"if(`QA`.`fo_Regdate`,date_format(`QA`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`QA`.`ot_FileLoc`,3), MID(`QA`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QA`.`ot_otherdetails`" => "ot_otherdetails",
		"`QA`.`ot_comments`" => "ot_comments",
		"`QA`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QA`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QA`.`ot_Ref01`" => "ot_Ref01",
		"`QA`.`ot_Ref02`" => "ot_Ref02",
		"`QA`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QA`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QA`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QA`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QA`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QA`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`QA`.`id`" => "ID",
		"`QA`.`DocconNumber`" => "Planning ID",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "Work Location",
		"`QA`.`fo_DocItem`" => "Title",
		"`QA`.`fo_DocumentDescription`" => "Description",
		"`QA`.`fo_Class`" => "For Use",
		"`QA`.`fo_Classification`" => "Classification",
		"`QA`.`fo_Regdate`" => "Register date",
		"`QA`.`ot_FileLoc`" => "File Location & Number",
		"`QA`.`ot_otherdetails`" => "Other details",
		"`QA`.`ot_comments`" => "Comments",
		"`QA`.`ot_SharedLink1`" => "Shared Link 1",
		"`QA`.`ot_SharedLink2`" => "Shared Link 2",
		"`QA`.`ot_Ref01`" => "Reference_1",
		"`QA`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`QA`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`QA`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`QA`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`QA`.`ot_ap_filed`" => "Register",
		"`QA`.`ot_ap_last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`QA`.`id`" => "id",
		"`QA`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`QA`.`fo_DocItem`" => "fo_DocItem",
		"`QA`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`QA`.`fo_Class`" => "fo_Class",
		"`QA`.`fo_Classification`" => "fo_Classification",
		"if(`QA`.`fo_Regdate`,date_format(`QA`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`QA`.`ot_FileLoc`,3), MID(`QA`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QA`.`ot_otherdetails`" => "ot_otherdetails",
		"`QA`.`ot_comments`" => "ot_comments",
		"`QA`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QA`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QA`.`ot_Ref01`" => "ot_Ref01",
		"`QA`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QA`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QA`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QA`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QA`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QA`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'BaseLocation' => 'Work Location', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`QA` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`QA`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`QA`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`QA`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`QA`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "QA_view.php";
	$x->RedirectAfterInsert = "QA_view.php?SelectedID=#ID#";
	$x->TableTitle = "IMS Planning & Assurance";
	$x->TableIcon = "resources/table_icons/administrator.png";
	$x->PrimaryKey = "`QA`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 200, 120, 150, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Planning ID", "Work Location", "Title", "For Use", "Classification", "Register date", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'BaseLocation', 'fo_DocItem', 'fo_Class', 'fo_Classification', 'fo_Regdate', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_last_modified');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 8, 17, 19, 21, 23, 24);

	// template paths below are based on the app main directory
	$x->Template = 'templates/QA_templateTV.html';
	$x->SelectedTemplate = 'templates/QA_templateTVS.html';
	$x->TemplateDV = 'templates/QA_templateDV.html';
	$x->TemplateDVP = 'templates/QA_templateDVP.html';

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
		$x->QueryWhere="where `QA`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='QA' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `QA`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='QA' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`QA`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: QA_init
	$render=TRUE;
	if(function_exists('QA_init')){
		$args=array();
		$render=QA_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: QA_header
	$headerCode='';
	if(function_exists('QA_header')){
		$args=array();
		$headerCode=QA_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: QA_footer
	$footerCode='';
	if(function_exists('QA_footer')){
		$args=array();
		$footerCode=QA_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>