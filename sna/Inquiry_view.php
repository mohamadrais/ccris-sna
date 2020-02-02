<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Inquiry.php");
	include("$currDir/Inquiry_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Inquiry');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Inquiry";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Inquiry`.`id`" => "id",
		"`Inquiry`.`InqNumber`" => "InqNumber",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Client */" => "ClientID",
		"if(`Inquiry`.`fo_InquiryDate`,date_format(`Inquiry`.`fo_InquiryDate`,'%m/%d/%Y'),'')" => "fo_InquiryDate",
		"if(`Inquiry`.`fo_DueDate`,date_format(`Inquiry`.`fo_DueDate`,'%m/%d/%Y'),'')" => "fo_DueDate",
		"`Inquiry`.`fo_Classification`" => "fo_Classification",
		"if(`Inquiry`.`fo_DeliveryDate`,date_format(`Inquiry`.`fo_DeliveryDate`,'%m/%d/%Y'),'')" => "fo_DeliveryDate",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') /* Logistic */" => "fo_Logistic",
		"`Inquiry`.`fo_Freight`" => "fo_Freight",
		"IF(    CHAR_LENGTH(`Client1`.`fo_ContactName`), CONCAT_WS('',   `Client1`.`fo_ContactName`), '') /* Ship Name */" => "fo_ShipName",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Address`), CONCAT_WS('',   `Client1`.`fo_Address`), '') /* Ship Address */" => "fo_ShipAddress",
		"IF(    CHAR_LENGTH(`Client1`.`fo_City`), CONCAT_WS('',   `Client1`.`fo_City`), '') /* Ship City */" => "fo_ShipCity",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Region`), CONCAT_WS('',   `Client1`.`fo_Region`), '') /* Ship Region */" => "fo_ShipRegion",
		"IF(    CHAR_LENGTH(`Client1`.`fo_PostalCode`), CONCAT_WS('',   `Client1`.`fo_PostalCode`), '') /* Ship Postal Code */" => "fo_ShipPostalCode",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Country`), CONCAT_WS('',   `Client1`.`fo_Country`), '') /* Ship Country */" => "fo_ShipCountry",
		"CONCAT_WS('-', LEFT(`Inquiry`.`ot_FileLoc`,3), MID(`Inquiry`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inquiry`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inquiry`.`ot_comments`" => "ot_comments",
		"`Inquiry`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inquiry`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inquiry`.`ot_Ref01`" => "ot_Ref01",
		"`Inquiry`.`ot_Ref02`" => "ot_Ref02",
		"`Inquiry`.`ot_Ref03`" => "ot_Ref03",
		"`Inquiry`.`ot_Ref04`" => "ot_Ref04",
		"`Inquiry`.`ot_Ref05`" => "ot_Ref05",
		"`Inquiry`.`ot_Ref06`" => "ot_Ref06",
		"`Inquiry`.`ot_Photo01`" => "ot_Photo01",
		"`Inquiry`.`ot_Photo02`" => "ot_Photo02",
		"`Inquiry`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inquiry`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inquiry`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inquiry`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inquiry`.`ot_ap_filed`,date_format(`Inquiry`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inquiry`.`ot_ap_lastmodified`,date_format(`Inquiry`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Inquiry`.`id`',
		2 => 2,
		3 => 3,
		4 => '`Inquiry`.`fo_InquiryDate`',
		5 => '`Inquiry`.`fo_DueDate`',
		6 => 6,
		7 => '`Inquiry`.`fo_DeliveryDate`',
		8 => 8,
		9 => '`Inquiry`.`fo_Freight`',
		10 => '`Client1`.`fo_ContactName`',
		11 => '`Client1`.`fo_Address`',
		12 => '`Client1`.`fo_City`',
		13 => '`Client1`.`fo_Region`',
		14 => '`Client1`.`fo_PostalCode`',
		15 => '`Client1`.`fo_Country`',
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
		27 => 27,
		28 => 28,
		29 => 29,
		30 => '`Leadership1`.`Status`',
		31 => 31,
		32 => '`Approval1`.`Status`',
		33 => 33,
		34 => '`IMSControl1`.`Status`',
		35 => 35,
		36 => '`Inquiry`.`ot_ap_filed`',
		37 => '`Inquiry`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Inquiry`.`id`" => "id",
		"`Inquiry`.`InqNumber`" => "InqNumber",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Client */" => "ClientID",
		"if(`Inquiry`.`fo_InquiryDate`,date_format(`Inquiry`.`fo_InquiryDate`,'%m/%d/%Y'),'')" => "fo_InquiryDate",
		"if(`Inquiry`.`fo_DueDate`,date_format(`Inquiry`.`fo_DueDate`,'%m/%d/%Y'),'')" => "fo_DueDate",
		"`Inquiry`.`fo_Classification`" => "fo_Classification",
		"if(`Inquiry`.`fo_DeliveryDate`,date_format(`Inquiry`.`fo_DeliveryDate`,'%m/%d/%Y'),'')" => "fo_DeliveryDate",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') /* Logistic */" => "fo_Logistic",
		"`Inquiry`.`fo_Freight`" => "fo_Freight",
		"IF(    CHAR_LENGTH(`Client1`.`fo_ContactName`), CONCAT_WS('',   `Client1`.`fo_ContactName`), '') /* Ship Name */" => "fo_ShipName",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Address`), CONCAT_WS('',   `Client1`.`fo_Address`), '') /* Ship Address */" => "fo_ShipAddress",
		"IF(    CHAR_LENGTH(`Client1`.`fo_City`), CONCAT_WS('',   `Client1`.`fo_City`), '') /* Ship City */" => "fo_ShipCity",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Region`), CONCAT_WS('',   `Client1`.`fo_Region`), '') /* Ship Region */" => "fo_ShipRegion",
		"IF(    CHAR_LENGTH(`Client1`.`fo_PostalCode`), CONCAT_WS('',   `Client1`.`fo_PostalCode`), '') /* Ship Postal Code */" => "fo_ShipPostalCode",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Country`), CONCAT_WS('',   `Client1`.`fo_Country`), '') /* Ship Country */" => "fo_ShipCountry",
		"CONCAT_WS('-', LEFT(`Inquiry`.`ot_FileLoc`,3), MID(`Inquiry`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inquiry`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inquiry`.`ot_comments`" => "ot_comments",
		"`Inquiry`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inquiry`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inquiry`.`ot_Ref01`" => "ot_Ref01",
		"`Inquiry`.`ot_Ref02`" => "ot_Ref02",
		"`Inquiry`.`ot_Ref03`" => "ot_Ref03",
		"`Inquiry`.`ot_Ref04`" => "ot_Ref04",
		"`Inquiry`.`ot_Ref05`" => "ot_Ref05",
		"`Inquiry`.`ot_Ref06`" => "ot_Ref06",
		"`Inquiry`.`ot_Photo01`" => "ot_Photo01",
		"`Inquiry`.`ot_Photo02`" => "ot_Photo02",
		"`Inquiry`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inquiry`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inquiry`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inquiry`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inquiry`.`ot_ap_filed`,date_format(`Inquiry`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inquiry`.`ot_ap_lastmodified`,date_format(`Inquiry`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Inquiry`.`id`" => "ID",
		"`Inquiry`.`InqNumber`" => "Inquiry Record",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Client */" => "Client",
		"`Inquiry`.`fo_InquiryDate`" => "Inquiry Date",
		"`Inquiry`.`fo_DueDate`" => "Due Date",
		"`Inquiry`.`fo_Classification`" => "Input",
		"`Inquiry`.`fo_DeliveryDate`" => "Tentative Project Date",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') /* Logistic */" => "Logistic",
		"`Inquiry`.`fo_Freight`" => "Freight",
		"IF(    CHAR_LENGTH(`Client1`.`fo_ContactName`), CONCAT_WS('',   `Client1`.`fo_ContactName`), '') /* Ship Name */" => "Ship Name",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Address`), CONCAT_WS('',   `Client1`.`fo_Address`), '') /* Ship Address */" => "Ship Address",
		"IF(    CHAR_LENGTH(`Client1`.`fo_City`), CONCAT_WS('',   `Client1`.`fo_City`), '') /* Ship City */" => "Ship City",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Region`), CONCAT_WS('',   `Client1`.`fo_Region`), '') /* Ship Region */" => "Ship Region",
		"IF(    CHAR_LENGTH(`Client1`.`fo_PostalCode`), CONCAT_WS('',   `Client1`.`fo_PostalCode`), '') /* Ship Postal Code */" => "Ship Postal Code",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Country`), CONCAT_WS('',   `Client1`.`fo_Country`), '') /* Ship Country */" => "Ship Country",
		"`Inquiry`.`ot_FileLoc`" => "File Location & Number",
		"`Inquiry`.`ot_otherdetails`" => "Other details",
		"`Inquiry`.`ot_comments`" => "Comments",
		"`Inquiry`.`ot_SharedLink1`" => "Shared Link 1",
		"`Inquiry`.`ot_SharedLink2`" => "Shared Link 2",
		"`Inquiry`.`ot_Ref01`" => "Reference_1",
		"`Inquiry`.`ot_Ref02`" => "Reference_2",
		"`Inquiry`.`ot_Ref03`" => "Reference_3",
		"`Inquiry`.`ot_Ref04`" => "Reference_4",
		"`Inquiry`.`ot_Ref05`" => "Reference_5",
		"`Inquiry`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`Inquiry`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`Inquiry`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`Inquiry`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`Inquiry`.`ot_ap_filed`" => "Filed",
		"`Inquiry`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Inquiry`.`id`" => "id",
		"`Inquiry`.`InqNumber`" => "InqNumber",
		"IF(    CHAR_LENGTH(`Client1`.`ClientID`) || CHAR_LENGTH(`Client1`.`CompanyName`), CONCAT_WS('',   `Client1`.`ClientID`, '; ', `Client1`.`CompanyName`), '') /* Client */" => "ClientID",
		"if(`Inquiry`.`fo_InquiryDate`,date_format(`Inquiry`.`fo_InquiryDate`,'%m/%d/%Y'),'')" => "fo_InquiryDate",
		"if(`Inquiry`.`fo_DueDate`,date_format(`Inquiry`.`fo_DueDate`,'%m/%d/%Y'),'')" => "fo_DueDate",
		"`Inquiry`.`fo_Classification`" => "fo_Classification",
		"if(`Inquiry`.`fo_DeliveryDate`,date_format(`Inquiry`.`fo_DeliveryDate`,'%m/%d/%Y'),'')" => "fo_DeliveryDate",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '; ', `Logistics1`.`CompanyName`), '') /* Logistic */" => "fo_Logistic",
		"`Inquiry`.`fo_Freight`" => "fo_Freight",
		"IF(    CHAR_LENGTH(`Client1`.`fo_ContactName`), CONCAT_WS('',   `Client1`.`fo_ContactName`), '') /* Ship Name */" => "fo_ShipName",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Address`), CONCAT_WS('',   `Client1`.`fo_Address`), '') /* Ship Address */" => "fo_ShipAddress",
		"IF(    CHAR_LENGTH(`Client1`.`fo_City`), CONCAT_WS('',   `Client1`.`fo_City`), '') /* Ship City */" => "fo_ShipCity",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Region`), CONCAT_WS('',   `Client1`.`fo_Region`), '') /* Ship Region */" => "fo_ShipRegion",
		"IF(    CHAR_LENGTH(`Client1`.`fo_PostalCode`), CONCAT_WS('',   `Client1`.`fo_PostalCode`), '') /* Ship Postal Code */" => "fo_ShipPostalCode",
		"IF(    CHAR_LENGTH(`Client1`.`fo_Country`), CONCAT_WS('',   `Client1`.`fo_Country`), '') /* Ship Country */" => "fo_ShipCountry",
		"CONCAT_WS('-', LEFT(`Inquiry`.`ot_FileLoc`,3), MID(`Inquiry`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inquiry`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inquiry`.`ot_comments`" => "ot_comments",
		"`Inquiry`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inquiry`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inquiry`.`ot_Ref01`" => "ot_Ref01",
		"`Inquiry`.`ot_Ref02`" => "ot_Ref02",
		"`Inquiry`.`ot_Ref03`" => "ot_Ref03",
		"`Inquiry`.`ot_Ref04`" => "ot_Ref04",
		"`Inquiry`.`ot_Ref05`" => "ot_Ref05",
		"`Inquiry`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inquiry`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inquiry`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inquiry`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inquiry`.`ot_ap_filed`,date_format(`Inquiry`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inquiry`.`ot_ap_lastmodified`,date_format(`Inquiry`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ClientID' => 'Client', 'fo_Logistic' => 'Logistic', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`Inquiry` LEFT JOIN `Client` as Client1 ON `Client1`.`id`=`Inquiry`.`ClientID` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`Inquiry`.`fo_Logistic` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Inquiry`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Inquiry`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Inquiry`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "Inquiry_view.php";
	$x->RedirectAfterInsert = "Inquiry_view.php";
	$x->TableTitle = "Inquiry & Tender";
	$x->TableIcon = "resources/table_icons/cash_register.png";
	$x->PrimaryKey = "`Inquiry`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 200, 100, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Inquiry Record", "Client", "Inquiry Date", "Due Date", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('InqNumber', 'ClientID', 'fo_InquiryDate', 'fo_DueDate', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 30, 32, 34, 36, 37);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Inquiry_templateTV.html';
	$x->SelectedTemplate = 'templates/Inquiry_templateTVS.html';
	$x->TemplateDV = 'templates/Inquiry_templateDV.html';
	$x->TemplateDVP = 'templates/Inquiry_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Inquiry`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Inquiry' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Inquiry`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Inquiry' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Inquiry`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Inquiry_init
	$render=TRUE;
	if(function_exists('Inquiry_init')){
		$args=array();
		$render=Inquiry_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Inquiry_header
	$headerCode='';
	if(function_exists('Inquiry_header')){
		$args=array();
		$headerCode=Inquiry_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Inquiry_footer
	$footerCode='';
	if(function_exists('Inquiry_footer')){
		$args=array();
		$footerCode=Inquiry_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>