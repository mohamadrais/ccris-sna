<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/NonConformance.php");
	include("$currDir/NonConformance_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('NonConformance');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "NonConformance";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`NonConformance`.`id`" => "id",
		"`NonConformance`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "worklocID",
		"`NonConformance`.`fo_DocItem`" => "fo_DocItem",
		"`NonConformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`NonConformance`.`fo_Classification`" => "fo_Classification",
		"`NonConformance`.`fo_Impact`" => "fo_Impact",
		"if(`NonConformance`.`fo_Regdate`,date_format(`NonConformance`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"concat('<img src=\"', if(`NonConformance`.`fo_ClosedIssue`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "fo_ClosedIssue",
		"CONCAT_WS('-', LEFT(`NonConformance`.`ot_FileLoc`,3), MID(`NonConformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`NonConformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`NonConformance`.`ot_comments`" => "ot_comments",
		"`NonConformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`NonConformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`NonConformance`.`ot_Ref01`" => "ot_Ref01",
		"`NonConformance`.`ot_Ref02`" => "ot_Ref02",
		"`NonConformance`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`NonConformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`NonConformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`NonConformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`NonConformance`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`NonConformance`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`NonConformance`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`NonConformance`.`fo_Regdate`',
		9 => '`NonConformance`.`fo_ClosedIssue`',
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => 17,
		18 => '`Leadership1`.`Status`',
		19 => 19,
		20 => '`Approval1`.`Status`',
		21 => 21,
		22 => '`IMSControl1`.`Status`',
		23 => 23,
		24 => '`NonConformance`.`ot_ap_filed`',
		25 => '`NonConformance`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`NonConformance`.`id`" => "id",
		"`NonConformance`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "worklocID",
		"`NonConformance`.`fo_DocItem`" => "fo_DocItem",
		"`NonConformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`NonConformance`.`fo_Classification`" => "fo_Classification",
		"`NonConformance`.`fo_Impact`" => "fo_Impact",
		"if(`NonConformance`.`fo_Regdate`,date_format(`NonConformance`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"`NonConformance`.`fo_ClosedIssue`" => "fo_ClosedIssue",
		"CONCAT_WS('-', LEFT(`NonConformance`.`ot_FileLoc`,3), MID(`NonConformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`NonConformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`NonConformance`.`ot_comments`" => "ot_comments",
		"`NonConformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`NonConformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`NonConformance`.`ot_Ref01`" => "ot_Ref01",
		"`NonConformance`.`ot_Ref02`" => "ot_Ref02",
		"`NonConformance`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`NonConformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`NonConformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`NonConformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`NonConformance`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`NonConformance`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`NonConformance`.`id`" => "ID",
		"`NonConformance`.`DocconNumber`" => "Record ID",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "Work Location",
		"`NonConformance`.`fo_DocItem`" => "Title",
		"`NonConformance`.`fo_DocumentDescription`" => "Description",
		"`NonConformance`.`fo_Classification`" => "Classification",
		"`NonConformance`.`fo_Impact`" => "Direct Impact",
		"`NonConformance`.`fo_Regdate`" => "Register date",
		"`NonConformance`.`fo_ClosedIssue`" => "Issue Closed",
		"`NonConformance`.`ot_FileLoc`" => "File Location & Number",
		"`NonConformance`.`ot_otherdetails`" => "Other details",
		"`NonConformance`.`ot_comments`" => "Comments",
		"`NonConformance`.`ot_SharedLink1`" => "Shared Link 1",
		"`NonConformance`.`ot_SharedLink2`" => "Shared Link 2",
		"`NonConformance`.`ot_Ref01`" => "Reference_1",
		"`NonConformance`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`NonConformance`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`NonConformance`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`NonConformance`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`NonConformance`.`ot_ap_filed`" => "Register",
		"`NonConformance`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`NonConformance`.`id`" => "id",
		"`NonConformance`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "worklocID",
		"`NonConformance`.`fo_DocItem`" => "fo_DocItem",
		"`NonConformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`NonConformance`.`fo_Classification`" => "fo_Classification",
		"`NonConformance`.`fo_Impact`" => "fo_Impact",
		"if(`NonConformance`.`fo_Regdate`,date_format(`NonConformance`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"concat('<img src=\"', if(`NonConformance`.`fo_ClosedIssue`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />')" => "fo_ClosedIssue",
		"CONCAT_WS('-', LEFT(`NonConformance`.`ot_FileLoc`,3), MID(`NonConformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`NonConformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`NonConformance`.`ot_comments`" => "ot_comments",
		"`NonConformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`NonConformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`NonConformance`.`ot_Ref01`" => "ot_Ref01",
		"`NonConformance`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`NonConformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`NonConformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`NonConformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`NonConformance`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`NonConformance`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'worklocID' => 'Work Location', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`NonConformance` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`NonConformance`.`worklocID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`NonConformance`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`NonConformance`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`NonConformance`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "NonConformance_view.php";
	$x->RedirectAfterInsert = "NonConformance_view.php?SelectedID=#ID#";
	$x->TableTitle = "IMS Non Conformance";
	$x->TableIcon = "resources/table_icons/cog_delete.png";
	$x->PrimaryKey = "`NonConformance`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 120, 120, 70, 150, 100, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Work Location", "Title", "Classification", "Direct Impact", "Issue Closed", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'worklocID', 'fo_DocItem', 'fo_Classification', 'fo_Impact', 'fo_ClosedIssue', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 9, 18, 20, 22, 24, 25);

	// template paths below are based on the app main directory
	$x->Template = 'templates/NonConformance_templateTV.html';
	$x->SelectedTemplate = 'templates/NonConformance_templateTVS.html';
	$x->TemplateDV = 'templates/NonConformance_templateDV.html';
	$x->TemplateDVP = 'templates/NonConformance_templateDVP.html';

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
		$x->QueryWhere="where `NonConformance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='NonConformance' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `NonConformance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='NonConformance' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`NonConformance`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: NonConformance_init
	$render=TRUE;
	if(function_exists('NonConformance_init')){
		$args=array();
		$render=NonConformance_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: NonConformance_header
	$headerCode='';
	if(function_exists('NonConformance_header')){
		$args=array();
		$headerCode=NonConformance_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: NonConformance_footer
	$footerCode='';
	if(function_exists('NonConformance_footer')){
		$args=array();
		$footerCode=NonConformance_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>