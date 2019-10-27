<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/LogisticRequest.php");
	include("$currDir/LogisticRequest_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('LogisticRequest');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "LogisticRequest";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`LogisticRequest`.`id`" => "id",
		"`LogisticRequest`.`LogisticNumber`" => "LogisticNumber",
		"`LogisticRequest`.`Market_Survey`" => "Market_Survey",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '; ', `resources1`.`Name`), '') /* Operation resources ID */" => "fo_ResourcesID",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '; ', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectID",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"if(`LogisticRequest`.`fo_Deliverydate`,date_format(`LogisticRequest`.`fo_Deliverydate`,'%m/%d/%Y'),'')" => "fo_Deliverydate",
		"`LogisticRequest`.`fo_address`" => "fo_address",
		"`LogisticRequest`.`fo_city`" => "fo_city",
		"`LogisticRequest`.`fo_zip`" => "fo_zip",
		"`LogisticRequest`.`fo_Countrys`" => "fo_Countrys",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_homephone`,3), MID(`LogisticRequest`.`fo_homephone`,4,3), RIGHT(`LogisticRequest`.`fo_homephone`,4))" => "fo_homephone",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_workphone`,3), MID(`LogisticRequest`.`fo_workphone`,4,3), RIGHT(`LogisticRequest`.`fo_workphone`,4))" => "fo_workphone",
		"`LogisticRequest`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`ot_FileLoc`,3), MID(`LogisticRequest`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`LogisticRequest`.`ot_otherdetails`" => "ot_otherdetails",
		"`LogisticRequest`.`ot_comments`" => "ot_comments",
		"`LogisticRequest`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`LogisticRequest`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`LogisticRequest`.`ot_Ref01`" => "ot_Ref01",
		"`LogisticRequest`.`ot_Ref02`" => "ot_Ref02",
		"`LogisticRequest`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`LogisticRequest`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`LogisticRequest`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`LogisticRequest`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`LogisticRequest`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`LogisticRequest`.`fo_Deliverydate`',
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
		21 => 21,
		22 => 22,
		23 => '`Leadership1`.`Status`',
		24 => 24,
		25 => '`Approval1`.`Status`',
		26 => 26,
		27 => '`IMSControl1`.`Status`',
		28 => 28,
		29 => '`LogisticRequest`.`ot_ap_filed`',
		30 => '`LogisticRequest`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`LogisticRequest`.`id`" => "id",
		"`LogisticRequest`.`LogisticNumber`" => "LogisticNumber",
		"`LogisticRequest`.`Market_Survey`" => "Market_Survey",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '; ', `resources1`.`Name`), '') /* Operation resources ID */" => "fo_ResourcesID",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '; ', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectID",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"if(`LogisticRequest`.`fo_Deliverydate`,date_format(`LogisticRequest`.`fo_Deliverydate`,'%m/%d/%Y'),'')" => "fo_Deliverydate",
		"`LogisticRequest`.`fo_address`" => "fo_address",
		"`LogisticRequest`.`fo_city`" => "fo_city",
		"`LogisticRequest`.`fo_zip`" => "fo_zip",
		"`LogisticRequest`.`fo_Countrys`" => "fo_Countrys",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_homephone`,3), MID(`LogisticRequest`.`fo_homephone`,4,3), RIGHT(`LogisticRequest`.`fo_homephone`,4))" => "fo_homephone",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_workphone`,3), MID(`LogisticRequest`.`fo_workphone`,4,3), RIGHT(`LogisticRequest`.`fo_workphone`,4))" => "fo_workphone",
		"`LogisticRequest`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`ot_FileLoc`,3), MID(`LogisticRequest`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`LogisticRequest`.`ot_otherdetails`" => "ot_otherdetails",
		"`LogisticRequest`.`ot_comments`" => "ot_comments",
		"`LogisticRequest`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`LogisticRequest`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`LogisticRequest`.`ot_Ref01`" => "ot_Ref01",
		"`LogisticRequest`.`ot_Ref02`" => "ot_Ref02",
		"`LogisticRequest`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`LogisticRequest`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`LogisticRequest`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`LogisticRequest`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`LogisticRequest`.`id`" => "ID",
		"`LogisticRequest`.`LogisticNumber`" => "Request Number",
		"`LogisticRequest`.`Market_Survey`" => "Request",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '; ', `resources1`.`Name`), '') /* Operation resources ID */" => "Operation resources ID",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '; ', `projects1`.`Name`), '') /* Project ID */" => "Project ID",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "Ship Via",
		"`LogisticRequest`.`fo_Deliverydate`" => "Delivery date",
		"`LogisticRequest`.`fo_address`" => "Address",
		"`LogisticRequest`.`fo_city`" => "City",
		"`LogisticRequest`.`fo_zip`" => "Zip",
		"`LogisticRequest`.`fo_Countrys`" => "Country",
		"`LogisticRequest`.`fo_homephone`" => "Home phone",
		"`LogisticRequest`.`fo_workphone`" => "Work phone",
		"`LogisticRequest`.`fo_contactperson`" => "Contact person in case of Emergency",
		"`LogisticRequest`.`ot_FileLoc`" => "File Location & Number",
		"`LogisticRequest`.`ot_otherdetails`" => "Other details",
		"`LogisticRequest`.`ot_comments`" => "Comments",
		"`LogisticRequest`.`ot_SharedLink1`" => "Shared Link 1",
		"`LogisticRequest`.`ot_SharedLink2`" => "Shared Link 2",
		"`LogisticRequest`.`ot_Ref01`" => "Reference_1",
		"`LogisticRequest`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`LogisticRequest`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`LogisticRequest`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`LogisticRequest`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`LogisticRequest`.`ot_ap_filed`" => "Filed",
		"`LogisticRequest`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`LogisticRequest`.`id`" => "id",
		"`LogisticRequest`.`LogisticNumber`" => "LogisticNumber",
		"`LogisticRequest`.`Market_Survey`" => "Market_Survey",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '; ', `resources1`.`Name`), '') /* Operation resources ID */" => "fo_ResourcesID",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '; ', `projects1`.`Name`), '') /* Project ID */" => "fo_ProjectID",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"if(`LogisticRequest`.`fo_Deliverydate`,date_format(`LogisticRequest`.`fo_Deliverydate`,'%m/%d/%Y'),'')" => "fo_Deliverydate",
		"`LogisticRequest`.`fo_address`" => "fo_address",
		"`LogisticRequest`.`fo_city`" => "fo_city",
		"`LogisticRequest`.`fo_zip`" => "fo_zip",
		"`LogisticRequest`.`fo_Countrys`" => "fo_Countrys",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_homephone`,3), MID(`LogisticRequest`.`fo_homephone`,4,3), RIGHT(`LogisticRequest`.`fo_homephone`,4))" => "fo_homephone",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`fo_workphone`,3), MID(`LogisticRequest`.`fo_workphone`,4,3), RIGHT(`LogisticRequest`.`fo_workphone`,4))" => "fo_workphone",
		"`LogisticRequest`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`LogisticRequest`.`ot_FileLoc`,3), MID(`LogisticRequest`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`LogisticRequest`.`ot_otherdetails`" => "ot_otherdetails",
		"`LogisticRequest`.`ot_comments`" => "ot_comments",
		"`LogisticRequest`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`LogisticRequest`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`LogisticRequest`.`ot_Ref01`" => "ot_Ref01",
		"`LogisticRequest`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`LogisticRequest`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`LogisticRequest`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`LogisticRequest`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`LogisticRequest`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'fo_ResourcesID' => 'Operation resources ID', 'fo_ProjectID' => 'Project ID', 'fo_ShipVia' => 'Ship Via', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`LogisticRequest` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`LogisticRequest`.`fo_ResourcesID` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`LogisticRequest`.`fo_ProjectID` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`LogisticRequest`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`LogisticRequest`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`LogisticRequest`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`LogisticRequest`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "LogisticRequest_view.php";
	$x->RedirectAfterInsert = "LogisticRequest_view.php?SelectedID=#ID#";
	$x->TableTitle = "Logistic Request Order";
	$x->TableIcon = "resources/table_icons/aol_mail.png";
	$x->PrimaryKey = "`LogisticRequest`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  100, 70, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Request Number", "Operation resources ID", "Project ID", "Ship Via", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('LogisticNumber', 'fo_ResourcesID', 'fo_ProjectID', 'fo_ShipVia', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 4, 5, 6, 23, 25, 27, 29, 30);

	// template paths below are based on the app main directory
	$x->Template = 'templates/LogisticRequest_templateTV.html';
	$x->SelectedTemplate = 'templates/LogisticRequest_templateTVS.html';
	$x->TemplateDV = 'templates/LogisticRequest_templateDV.html';
	$x->TemplateDVP = 'templates/LogisticRequest_templateDVP.html';

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
		$x->QueryWhere="where `LogisticRequest`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='LogisticRequest' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `LogisticRequest`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='LogisticRequest' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`LogisticRequest`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: LogisticRequest_init
	$render=TRUE;
	if(function_exists('LogisticRequest_init')){
		$args=array();
		$render=LogisticRequest_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: LogisticRequest_header
	$headerCode='';
	if(function_exists('LogisticRequest_header')){
		$args=array();
		$headerCode=LogisticRequest_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: LogisticRequest_footer
	$footerCode='';
	if(function_exists('LogisticRequest_footer')){
		$args=array();
		$footerCode=LogisticRequest_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>