<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/QuarterlyMeeting.php");
	include("$currDir/QuarterlyMeeting_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('QuarterlyMeeting');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "QuarterlyMeeting";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`QuarterlyMeeting`.`id`" => "id",
		"`QuarterlyMeeting`.`QmID`" => "QmID",
		"IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') /* Event reference ID */" => "ccpID",
		"`QuarterlyMeeting`.`fo_Desc`" => "fo_Desc",
		"if(`QuarterlyMeeting`.`fo_RequiredDate`,date_format(`QuarterlyMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'')" => "fo_RequiredDate",
		"CONCAT_WS('-', LEFT(`QuarterlyMeeting`.`ot_FileLoc`,3), MID(`QuarterlyMeeting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QuarterlyMeeting`.`ot_otherdetails`" => "ot_otherdetails",
		"`QuarterlyMeeting`.`ot_comments`" => "ot_comments",
		"`QuarterlyMeeting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QuarterlyMeeting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QuarterlyMeeting`.`ot_Ref01`" => "ot_Ref01",
		"`QuarterlyMeeting`.`ot_Ref02`" => "ot_Ref02",
		"`QuarterlyMeeting`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QuarterlyMeeting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QuarterlyMeeting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QuarterlyMeeting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`QuarterlyMeeting`.`id`',
		2 => 2,
		3 => '`CommConsParticipate1`.`ccpID`',
		4 => 4,
		5 => '`QuarterlyMeeting`.`fo_RequiredDate`',
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
		20 => '`QuarterlyMeeting`.`ot_ap_filed`',
		21 => '`QuarterlyMeeting`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`QuarterlyMeeting`.`id`" => "id",
		"`QuarterlyMeeting`.`QmID`" => "QmID",
		"IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') /* Event reference ID */" => "ccpID",
		"`QuarterlyMeeting`.`fo_Desc`" => "fo_Desc",
		"if(`QuarterlyMeeting`.`fo_RequiredDate`,date_format(`QuarterlyMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'')" => "fo_RequiredDate",
		"CONCAT_WS('-', LEFT(`QuarterlyMeeting`.`ot_FileLoc`,3), MID(`QuarterlyMeeting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QuarterlyMeeting`.`ot_otherdetails`" => "ot_otherdetails",
		"`QuarterlyMeeting`.`ot_comments`" => "ot_comments",
		"`QuarterlyMeeting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QuarterlyMeeting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QuarterlyMeeting`.`ot_Ref01`" => "ot_Ref01",
		"`QuarterlyMeeting`.`ot_Ref02`" => "ot_Ref02",
		"`QuarterlyMeeting`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QuarterlyMeeting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QuarterlyMeeting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QuarterlyMeeting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`QuarterlyMeeting`.`id`" => "ID",
		"`QuarterlyMeeting`.`QmID`" => "Record Number",
		"IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') /* Event reference ID */" => "Event reference ID",
		"`QuarterlyMeeting`.`fo_Desc`" => "Description",
		"`QuarterlyMeeting`.`fo_RequiredDate`" => "Date",
		"`QuarterlyMeeting`.`ot_FileLoc`" => "File Location & Number",
		"`QuarterlyMeeting`.`ot_otherdetails`" => "Other details",
		"`QuarterlyMeeting`.`ot_comments`" => "Comments",
		"`QuarterlyMeeting`.`ot_SharedLink1`" => "Shared Link 1",
		"`QuarterlyMeeting`.`ot_SharedLink2`" => "Shared Link 2",
		"`QuarterlyMeeting`.`ot_Ref01`" => "Reference_1",
		"`QuarterlyMeeting`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`QuarterlyMeeting`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`QuarterlyMeeting`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`QuarterlyMeeting`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`QuarterlyMeeting`.`ot_ap_filed`" => "Register",
		"`QuarterlyMeeting`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`QuarterlyMeeting`.`id`" => "id",
		"`QuarterlyMeeting`.`QmID`" => "QmID",
		"IF(    CHAR_LENGTH(`CommConsParticipate1`.`ccpID`), CONCAT_WS('',   `CommConsParticipate1`.`ccpID`), '') /* Event reference ID */" => "ccpID",
		"`QuarterlyMeeting`.`fo_Desc`" => "fo_Desc",
		"if(`QuarterlyMeeting`.`fo_RequiredDate`,date_format(`QuarterlyMeeting`.`fo_RequiredDate`,'%m/%d/%Y'),'')" => "fo_RequiredDate",
		"CONCAT_WS('-', LEFT(`QuarterlyMeeting`.`ot_FileLoc`,3), MID(`QuarterlyMeeting`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`QuarterlyMeeting`.`ot_otherdetails`" => "ot_otherdetails",
		"`QuarterlyMeeting`.`ot_comments`" => "ot_comments",
		"`QuarterlyMeeting`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`QuarterlyMeeting`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`QuarterlyMeeting`.`ot_Ref01`" => "ot_Ref01",
		"`QuarterlyMeeting`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`QuarterlyMeeting`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`QuarterlyMeeting`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`QuarterlyMeeting`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`QuarterlyMeeting`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ccpID' => 'Event reference ID', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`QuarterlyMeeting` LEFT JOIN `CommConsParticipate` as CommConsParticipate1 ON `CommConsParticipate1`.`id`=`QuarterlyMeeting`.`ccpID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`QuarterlyMeeting`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`QuarterlyMeeting`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`QuarterlyMeeting`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "QuarterlyMeeting_view.php";
	$x->RedirectAfterInsert = "QuarterlyMeeting_view.php?SelectedID=#ID#";
	$x->TableTitle = "Quarterly Meeting";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`QuarterlyMeeting`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record Number", "Event reference ID", "Date", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('QmID', 'ccpID', 'fo_RequiredDate', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 5, 14, 16, 18, 20, 21);

	// template paths below are based on the app main directory
	$x->Template = 'templates/QuarterlyMeeting_templateTV.html';
	$x->SelectedTemplate = 'templates/QuarterlyMeeting_templateTVS.html';
	$x->TemplateDV = 'templates/QuarterlyMeeting_templateDV.html';
	$x->TemplateDVP = 'templates/QuarterlyMeeting_templateDVP.html';

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
		$x->QueryWhere="where `QuarterlyMeeting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='QuarterlyMeeting' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `QuarterlyMeeting`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='QuarterlyMeeting' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`QuarterlyMeeting`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: QuarterlyMeeting_init
	$render=TRUE;
	if(function_exists('QuarterlyMeeting_init')){
		$args=array();
		$render=QuarterlyMeeting_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: QuarterlyMeeting_header
	$headerCode='';
	if(function_exists('QuarterlyMeeting_header')){
		$args=array();
		$headerCode=QuarterlyMeeting_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: QuarterlyMeeting_footer
	$footerCode='';
	if(function_exists('QuarterlyMeeting_footer')){
		$args=array();
		$footerCode=QuarterlyMeeting_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>