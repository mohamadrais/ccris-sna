<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/StakeholderSatisfaction.php");
	include("$currDir/StakeholderSatisfaction_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('StakeholderSatisfaction');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "StakeholderSatisfaction";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`StakeholderSatisfaction`.`id`" => "id",
		"`StakeholderSatisfaction`.`RecordID`" => "RecordID",
		"`StakeholderSatisfaction`.`RecTitle`" => "RecTitle",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectId",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "fo_Recources",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '::', `Client1`.`CompanyName`), '') /* Client ID */" => "fo_ClientID",
		"`StakeholderSatisfaction`.`fo_gender`" => "fo_gender",
		"`StakeholderSatisfaction`.`fo_SurveyType`" => "fo_SurveyType",
		"`StakeholderSatisfaction`.`fo_Stakeholder`" => "fo_Stakeholder",
		"`StakeholderSatisfaction`.`fo_Description`" => "fo_Description",
		"if(`StakeholderSatisfaction`.`fo_Regdate`,date_format(`StakeholderSatisfaction`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"`StakeholderSatisfaction`.`fo_website`" => "fo_website",
		"CONCAT_WS('-', LEFT(`StakeholderSatisfaction`.`ot_FileLoc`,3), MID(`StakeholderSatisfaction`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`StakeholderSatisfaction`.`ot_otherdetails`" => "ot_otherdetails",
		"`StakeholderSatisfaction`.`ot_comments`" => "ot_comments",
		"`StakeholderSatisfaction`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`StakeholderSatisfaction`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`StakeholderSatisfaction`.`ot_Ref01`" => "ot_Ref01",
		"`StakeholderSatisfaction`.`ot_Ref02`" => "ot_Ref02",
		"`StakeholderSatisfaction`.`ot_Ref03`" => "ot_Ref03",
		"`StakeholderSatisfaction`.`ot_Ref04`" => "ot_Ref04",
		"`StakeholderSatisfaction`.`ot_Ref05`" => "ot_Ref05",
		"`StakeholderSatisfaction`.`ot_Ref06`" => "ot_Ref06",
		"`StakeholderSatisfaction`.`ot_Photo01`" => "ot_Photo01",
		"`StakeholderSatisfaction`.`ot_Photo02`" => "ot_Photo02",
		"`StakeholderSatisfaction`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`StakeholderSatisfaction`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`StakeholderSatisfaction`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`StakeholderSatisfaction`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`StakeholderSatisfaction`.`ot_ap_filed`,date_format(`StakeholderSatisfaction`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`StakeholderSatisfaction`.`ot_ap_lastmodified`,date_format(`StakeholderSatisfaction`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`StakeholderSatisfaction`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => '`StakeholderSatisfaction`.`fo_Regdate`',
		12 => 12,
		13 => 13,
		14 => 14,
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
		27 => '`Leadership1`.`Status`',
		28 => 28,
		29 => '`Approval1`.`Status`',
		30 => 30,
		31 => '`IMSControl1`.`Status`',
		32 => 32,
		33 => '`StakeholderSatisfaction`.`ot_ap_filed`',
		34 => '`StakeholderSatisfaction`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`StakeholderSatisfaction`.`id`" => "id",
		"`StakeholderSatisfaction`.`RecordID`" => "RecordID",
		"`StakeholderSatisfaction`.`RecTitle`" => "RecTitle",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectId",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "fo_Recources",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '::', `Client1`.`CompanyName`), '') /* Client ID */" => "fo_ClientID",
		"`StakeholderSatisfaction`.`fo_gender`" => "fo_gender",
		"`StakeholderSatisfaction`.`fo_SurveyType`" => "fo_SurveyType",
		"`StakeholderSatisfaction`.`fo_Stakeholder`" => "fo_Stakeholder",
		"`StakeholderSatisfaction`.`fo_Description`" => "fo_Description",
		"if(`StakeholderSatisfaction`.`fo_Regdate`,date_format(`StakeholderSatisfaction`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"`StakeholderSatisfaction`.`fo_website`" => "fo_website",
		"CONCAT_WS('-', LEFT(`StakeholderSatisfaction`.`ot_FileLoc`,3), MID(`StakeholderSatisfaction`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`StakeholderSatisfaction`.`ot_otherdetails`" => "ot_otherdetails",
		"`StakeholderSatisfaction`.`ot_comments`" => "ot_comments",
		"`StakeholderSatisfaction`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`StakeholderSatisfaction`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`StakeholderSatisfaction`.`ot_Ref01`" => "ot_Ref01",
		"`StakeholderSatisfaction`.`ot_Ref02`" => "ot_Ref02",
		"`StakeholderSatisfaction`.`ot_Ref03`" => "ot_Ref03",
		"`StakeholderSatisfaction`.`ot_Ref04`" => "ot_Ref04",
		"`StakeholderSatisfaction`.`ot_Ref05`" => "ot_Ref05",
		"`StakeholderSatisfaction`.`ot_Ref06`" => "ot_Ref06",
		"`StakeholderSatisfaction`.`ot_Photo01`" => "ot_Photo01",
		"`StakeholderSatisfaction`.`ot_Photo02`" => "ot_Photo02",
		"`StakeholderSatisfaction`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`StakeholderSatisfaction`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`StakeholderSatisfaction`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`StakeholderSatisfaction`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`StakeholderSatisfaction`.`ot_ap_filed`,date_format(`StakeholderSatisfaction`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`StakeholderSatisfaction`.`ot_ap_lastmodified`,date_format(`StakeholderSatisfaction`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`StakeholderSatisfaction`.`id`" => "ID",
		"`StakeholderSatisfaction`.`RecordID`" => "Record ID",
		"`StakeholderSatisfaction`.`RecTitle`" => "Title",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "Project ID",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "Resources ID",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '::', `Client1`.`CompanyName`), '') /* Client ID */" => "Client ID",
		"`StakeholderSatisfaction`.`fo_gender`" => "Gender",
		"`StakeholderSatisfaction`.`fo_SurveyType`" => "Type Of Survey",
		"`StakeholderSatisfaction`.`fo_Stakeholder`" => "Fo Stakeholder",
		"`StakeholderSatisfaction`.`fo_Description`" => "Description",
		"`StakeholderSatisfaction`.`fo_Regdate`" => "Register date",
		"`StakeholderSatisfaction`.`fo_website`" => "Website",
		"`StakeholderSatisfaction`.`ot_FileLoc`" => "File Location & Number",
		"`StakeholderSatisfaction`.`ot_otherdetails`" => "Other details",
		"`StakeholderSatisfaction`.`ot_comments`" => "Comments",
		"`StakeholderSatisfaction`.`ot_SharedLink1`" => "Shared Link 1",
		"`StakeholderSatisfaction`.`ot_SharedLink2`" => "Shared Link 2",
		"`StakeholderSatisfaction`.`ot_Ref01`" => "Reference_1",
		"`StakeholderSatisfaction`.`ot_Ref02`" => "Reference_2",
		"`StakeholderSatisfaction`.`ot_Ref03`" => "Reference_3",
		"`StakeholderSatisfaction`.`ot_Ref04`" => "Reference_4",
		"`StakeholderSatisfaction`.`ot_Ref05`" => "Reference_5",
		"`StakeholderSatisfaction`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`StakeholderSatisfaction`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`StakeholderSatisfaction`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`StakeholderSatisfaction`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`StakeholderSatisfaction`.`ot_ap_filed`" => "Filed",
		"`StakeholderSatisfaction`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`StakeholderSatisfaction`.`id`" => "id",
		"`StakeholderSatisfaction`.`RecordID`" => "RecordID",
		"`StakeholderSatisfaction`.`RecTitle`" => "RecTitle",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectId",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "fo_Recources",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '::', `Client1`.`CompanyName`), '') /* Client ID */" => "fo_ClientID",
		"`StakeholderSatisfaction`.`fo_gender`" => "fo_gender",
		"`StakeholderSatisfaction`.`fo_SurveyType`" => "fo_SurveyType",
		"`StakeholderSatisfaction`.`fo_Stakeholder`" => "fo_Stakeholder",
		"`StakeholderSatisfaction`.`fo_Description`" => "fo_Description",
		"if(`StakeholderSatisfaction`.`fo_Regdate`,date_format(`StakeholderSatisfaction`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"`StakeholderSatisfaction`.`fo_website`" => "fo_website",
		"CONCAT_WS('-', LEFT(`StakeholderSatisfaction`.`ot_FileLoc`,3), MID(`StakeholderSatisfaction`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`StakeholderSatisfaction`.`ot_otherdetails`" => "ot_otherdetails",
		"`StakeholderSatisfaction`.`ot_comments`" => "ot_comments",
		"`StakeholderSatisfaction`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`StakeholderSatisfaction`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`StakeholderSatisfaction`.`ot_Ref01`" => "ot_Ref01",
		"`StakeholderSatisfaction`.`ot_Ref02`" => "ot_Ref02",
		"`StakeholderSatisfaction`.`ot_Ref03`" => "ot_Ref03",
		"`StakeholderSatisfaction`.`ot_Ref04`" => "ot_Ref04",
		"`StakeholderSatisfaction`.`ot_Ref05`" => "ot_Ref05",
		"`StakeholderSatisfaction`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`StakeholderSatisfaction`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`StakeholderSatisfaction`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`StakeholderSatisfaction`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`StakeholderSatisfaction`.`ot_ap_filed`,date_format(`StakeholderSatisfaction`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`StakeholderSatisfaction`.`ot_ap_lastmodified`,date_format(`StakeholderSatisfaction`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'fo_ProjectId' => 'Project ID', 'fo_Recources' => 'Resources ID', 'fo_ClientID' => 'Client ID', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`StakeholderSatisfaction` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`StakeholderSatisfaction`.`fo_ProjectId` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`StakeholderSatisfaction`.`fo_Recources` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`StakeholderSatisfaction`.`fo_ClientID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`StakeholderSatisfaction`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`StakeholderSatisfaction`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`StakeholderSatisfaction`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "StakeholderSatisfaction_view.php";
	$x->RedirectAfterInsert = "StakeholderSatisfaction_view.php";
	$x->TableTitle = "Stakeholder Satisfaction Survey";
	$x->TableIcon = "resources/table_icons/document_signature.png";
	$x->PrimaryKey = "`StakeholderSatisfaction`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 150, 150, 200, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Project ID", "Resources ID", "Client ID", "Type Of Survey", "Fo Stakeholder", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('RecordID', 'fo_ProjectId', 'fo_Recources', 'fo_ClientID', 'fo_SurveyType', 'fo_Stakeholder', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 4, 5, 6, 8, 9, 27, 29, 31, 33, 34);

	// template paths below are based on the app main directory
	$x->Template = 'templates/StakeholderSatisfaction_templateTV.html';
	$x->SelectedTemplate = 'templates/StakeholderSatisfaction_templateTVS.html';
	$x->TemplateDV = 'templates/StakeholderSatisfaction_templateDV.html';
	$x->TemplateDVP = 'templates/StakeholderSatisfaction_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `StakeholderSatisfaction`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='StakeholderSatisfaction' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `StakeholderSatisfaction`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='StakeholderSatisfaction' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`StakeholderSatisfaction`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: StakeholderSatisfaction_init
	$render=TRUE;
	if(function_exists('StakeholderSatisfaction_init')){
		$args=array();
		$render=StakeholderSatisfaction_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: StakeholderSatisfaction_header
	$headerCode='';
	if(function_exists('StakeholderSatisfaction_header')){
		$args=array();
		$headerCode=StakeholderSatisfaction_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: StakeholderSatisfaction_footer
	$footerCode='';
	if(function_exists('StakeholderSatisfaction_footer')){
		$args=array();
		$footerCode=StakeholderSatisfaction_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>