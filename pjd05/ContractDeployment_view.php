<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/ContractDeployment.php");
	include("$currDir/ContractDeployment_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('ContractDeployment');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "ContractDeployment";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`ContractDeployment`.`id`" => "id",
		"`ContractDeployment`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Inquiry Reference */" => "InquiryID",
		"`ContractDeployment`.`fo_Type`" => "fo_Type",
		"`ContractDeployment`.`fo_Tajuk`" => "fo_Tajuk",
		"`ContractDeployment`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`ContractDeployment`.`fo_ExeDate`,date_format(`ContractDeployment`.`fo_ExeDate`,'%m/%d/%Y'),'')" => "fo_ExeDate",
		"CONCAT_WS('-', LEFT(`ContractDeployment`.`ot_FileLoc`,3), MID(`ContractDeployment`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContractDeployment`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContractDeployment`.`ot_comments`" => "ot_comments",
		"`ContractDeployment`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContractDeployment`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContractDeployment`.`ot_Ref01`" => "ot_Ref01",
		"`ContractDeployment`.`ot_Ref02`" => "ot_Ref02",
		"`ContractDeployment`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContractDeployment`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContractDeployment`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContractDeployment`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`ContractDeployment`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`ContractDeployment`.`fo_ExeDate`',
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => '`Leadership1`.`Status`',
		17 => 17,
		18 => '`Approval1`.`Status`',
		19 => 19,
		20 => '`IMSControl1`.`Status`',
		21 => 21,
		22 => '`ContractDeployment`.`ot_ap_filed`',
		23 => '`ContractDeployment`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`ContractDeployment`.`id`" => "id",
		"`ContractDeployment`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Inquiry Reference */" => "InquiryID",
		"`ContractDeployment`.`fo_Type`" => "fo_Type",
		"`ContractDeployment`.`fo_Tajuk`" => "fo_Tajuk",
		"`ContractDeployment`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`ContractDeployment`.`fo_ExeDate`,date_format(`ContractDeployment`.`fo_ExeDate`,'%m/%d/%Y'),'')" => "fo_ExeDate",
		"CONCAT_WS('-', LEFT(`ContractDeployment`.`ot_FileLoc`,3), MID(`ContractDeployment`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContractDeployment`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContractDeployment`.`ot_comments`" => "ot_comments",
		"`ContractDeployment`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContractDeployment`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContractDeployment`.`ot_Ref01`" => "ot_Ref01",
		"`ContractDeployment`.`ot_Ref02`" => "ot_Ref02",
		"`ContractDeployment`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContractDeployment`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContractDeployment`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContractDeployment`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`ContractDeployment`.`id`" => "ID",
		"`ContractDeployment`.`DocconNumber`" => "Contract Deployment ID",
		"IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Inquiry Reference */" => "Inquiry Reference",
		"`ContractDeployment`.`fo_Type`" => "Type",
		"`ContractDeployment`.`fo_Tajuk`" => "Record Title",
		"`ContractDeployment`.`fo_DocumentDescription`" => "Document Description",
		"`ContractDeployment`.`fo_ExeDate`" => "Execution date",
		"`ContractDeployment`.`ot_FileLoc`" => "File Location & Number",
		"`ContractDeployment`.`ot_otherdetails`" => "Other details",
		"`ContractDeployment`.`ot_comments`" => "Comments",
		"`ContractDeployment`.`ot_SharedLink1`" => "Shared Link 1",
		"`ContractDeployment`.`ot_SharedLink2`" => "Shared Link 2",
		"`ContractDeployment`.`ot_Ref01`" => "Reference_1",
		"`ContractDeployment`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`ContractDeployment`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`ContractDeployment`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`ContractDeployment`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`ContractDeployment`.`ot_ap_filed`" => "Register",
		"`ContractDeployment`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`ContractDeployment`.`id`" => "id",
		"`ContractDeployment`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`Inquiry1`.`InqNumber`) || CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Inquiry1`.`InqNumber`, '; ', `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Inquiry Reference */" => "InquiryID",
		"`ContractDeployment`.`fo_Type`" => "fo_Type",
		"`ContractDeployment`.`fo_Tajuk`" => "fo_Tajuk",
		"`ContractDeployment`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`ContractDeployment`.`fo_ExeDate`,date_format(`ContractDeployment`.`fo_ExeDate`,'%m/%d/%Y'),'')" => "fo_ExeDate",
		"CONCAT_WS('-', LEFT(`ContractDeployment`.`ot_FileLoc`,3), MID(`ContractDeployment`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContractDeployment`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContractDeployment`.`ot_comments`" => "ot_comments",
		"`ContractDeployment`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContractDeployment`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContractDeployment`.`ot_Ref01`" => "ot_Ref01",
		"`ContractDeployment`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContractDeployment`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContractDeployment`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContractDeployment`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ContractDeployment`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'InquiryID' => 'Inquiry Reference', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`ContractDeployment` LEFT JOIN `Inquiry` as Inquiry1 ON `Inquiry1`.`id`=`ContractDeployment`.`InquiryID` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`Inquiry1`.`ClientID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ContractDeployment`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ContractDeployment`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ContractDeployment`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "ContractDeployment_view.php";
	$x->RedirectAfterInsert = "ContractDeployment_view.php?SelectedID=#ID#";
	$x->TableTitle = "Project & Contract Deployment";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`ContractDeployment`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 200, 120, 120, 150, 60, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Contract Deployment ID", "Inquiry Reference", "Type", "Record Title", "Execution date", "Photo", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'InquiryID', 'fo_Type', 'fo_Tajuk', 'fo_ExeDate', 'ot_Photo', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 15, 16, 18, 20, 22, 23);

	// template paths below are based on the app main directory
	$x->Template = 'templates/ContractDeployment_templateTV.html';
	$x->SelectedTemplate = 'templates/ContractDeployment_templateTVS.html';
	$x->TemplateDV = 'templates/ContractDeployment_templateDV.html';
	$x->TemplateDVP = 'templates/ContractDeployment_templateDVP.html';

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
		$x->QueryWhere="where `ContractDeployment`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ContractDeployment' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ContractDeployment`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ContractDeployment' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`ContractDeployment`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ContractDeployment_init
	$render=TRUE;
	if(function_exists('ContractDeployment_init')){
		$args=array();
		$render=ContractDeployment_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: ContractDeployment_header
	$headerCode='';
	if(function_exists('ContractDeployment_header')){
		$args=array();
		$headerCode=ContractDeployment_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: ContractDeployment_footer
	$footerCode='';
	if(function_exists('ContractDeployment_footer')){
		$args=array();
		$footerCode=ContractDeployment_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>