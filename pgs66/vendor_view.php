<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/vendor.php");
	include("$currDir/vendor_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('vendor');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "vendor";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`vendor`.`VendorID`" => "VendorID",
		"`vendor`.`CompanyID`" => "CompanyID",
		"`vendor`.`CopanyName`" => "CopanyName",
		"concat('<i class=\"glyphicon glyphicon-', if(`vendor`.`fo_AVList`, 'check', 'unchecked'), '\"></i>')" => "fo_AVList",
		"`vendor`.`fo_ContactTitle`" => "fo_ContactTitle",
		"`vendor`.`fo_Address`" => "fo_Address",
		"`vendor`.`fo_City`" => "fo_City",
		"`vendor`.`fo_Region`" => "fo_Region",
		"`vendor`.`fo_PostalCode`" => "fo_PostalCode",
		"`vendor`.`fo_Country`" => "fo_Country",
		"`vendor`.`fo_Phone`" => "fo_Phone",
		"`vendor`.`fo_Fax`" => "fo_Fax",
		"`vendor`.`fo_HomePage`" => "fo_HomePage",
		"CONCAT_WS('-', LEFT(`vendor`.`ot_FileLoc`,3), MID(`vendor`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`vendor`.`ot_otherdetails`" => "ot_otherdetails",
		"`vendor`.`ot_comments`" => "ot_comments",
		"`vendor`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`vendor`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`vendor`.`ot_Ref01`" => "ot_Ref01",
		"`vendor`.`ot_Ref02`" => "ot_Ref02",
		"`vendor`.`ot_Ref03`" => "ot_Ref03",
		"`vendor`.`ot_Ref04`" => "ot_Ref04",
		"`vendor`.`ot_Ref05`" => "ot_Ref05",
		"`vendor`.`ot_Ref06`" => "ot_Ref06",
		"`vendor`.`ot_Photo01`" => "ot_Photo01",
		"`vendor`.`ot_Photo02`" => "ot_Photo02",
		"`vendor`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`vendor`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`vendor`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`vendor`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`vendor`.`ot_ap_filed`,date_format(`vendor`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`vendor`.`ot_ap_lastmodified`,date_format(`vendor`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`vendor`.`VendorID`',
		2 => 2,
		3 => 3,
		4 => '`vendor`.`fo_AVList`',
		5 => 5,
		6 => 6,
		7 => 7,
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
		23 => 23,
		24 => 24,
		25 => 25,
		26 => 26,
		27 => 27,
		28 => '`Leadership1`.`Status`',
		29 => 29,
		30 => '`Approval1`.`Status`',
		31 => 31,
		32 => '`IMSControl1`.`Status`',
		33 => 33,
		34 => '`vendor`.`ot_ap_filed`',
		35 => '`vendor`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`vendor`.`VendorID`" => "VendorID",
		"`vendor`.`CompanyID`" => "CompanyID",
		"`vendor`.`CopanyName`" => "CopanyName",
		"`vendor`.`fo_AVList`" => "fo_AVList",
		"`vendor`.`fo_ContactTitle`" => "fo_ContactTitle",
		"`vendor`.`fo_Address`" => "fo_Address",
		"`vendor`.`fo_City`" => "fo_City",
		"`vendor`.`fo_Region`" => "fo_Region",
		"`vendor`.`fo_PostalCode`" => "fo_PostalCode",
		"`vendor`.`fo_Country`" => "fo_Country",
		"`vendor`.`fo_Phone`" => "fo_Phone",
		"`vendor`.`fo_Fax`" => "fo_Fax",
		"`vendor`.`fo_HomePage`" => "fo_HomePage",
		"CONCAT_WS('-', LEFT(`vendor`.`ot_FileLoc`,3), MID(`vendor`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`vendor`.`ot_otherdetails`" => "ot_otherdetails",
		"`vendor`.`ot_comments`" => "ot_comments",
		"`vendor`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`vendor`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`vendor`.`ot_Ref01`" => "ot_Ref01",
		"`vendor`.`ot_Ref02`" => "ot_Ref02",
		"`vendor`.`ot_Ref03`" => "ot_Ref03",
		"`vendor`.`ot_Ref04`" => "ot_Ref04",
		"`vendor`.`ot_Ref05`" => "ot_Ref05",
		"`vendor`.`ot_Ref06`" => "ot_Ref06",
		"`vendor`.`ot_Photo01`" => "ot_Photo01",
		"`vendor`.`ot_Photo02`" => "ot_Photo02",
		"`vendor`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`vendor`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`vendor`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`vendor`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`vendor`.`ot_ap_filed`,date_format(`vendor`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`vendor`.`ot_ap_lastmodified`,date_format(`vendor`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`vendor`.`VendorID`" => "Vendor ID",
		"`vendor`.`CompanyID`" => "Company Record Number",
		"`vendor`.`CopanyName`" => "Company Name",
		"`vendor`.`fo_AVList`" => "AVL",
		"`vendor`.`fo_ContactTitle`" => "Contact",
		"`vendor`.`fo_Address`" => "Address",
		"`vendor`.`fo_City`" => "City",
		"`vendor`.`fo_Region`" => "Region",
		"`vendor`.`fo_PostalCode`" => "Postal Code",
		"`vendor`.`fo_Country`" => "Country",
		"`vendor`.`fo_Phone`" => "Phone",
		"`vendor`.`fo_Fax`" => "Fax",
		"`vendor`.`fo_HomePage`" => "Web Site",
		"`vendor`.`ot_FileLoc`" => "File Location & Number",
		"`vendor`.`ot_otherdetails`" => "Other details",
		"`vendor`.`ot_comments`" => "Comments",
		"`vendor`.`ot_SharedLink1`" => "Shared Link 1",
		"`vendor`.`ot_SharedLink2`" => "Shared Link 2",
		"`vendor`.`ot_Ref01`" => "Reference_1",
		"`vendor`.`ot_Ref02`" => "Reference_2",
		"`vendor`.`ot_Ref03`" => "Reference_3",
		"`vendor`.`ot_Ref04`" => "Reference_4",
		"`vendor`.`ot_Ref05`" => "Reference_5",
		"`vendor`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`vendor`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`vendor`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`vendor`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`vendor`.`ot_ap_filed`" => "Filed",
		"`vendor`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`vendor`.`VendorID`" => "VendorID",
		"`vendor`.`CompanyID`" => "CompanyID",
		"`vendor`.`CopanyName`" => "CopanyName",
		"concat('<i class=\"glyphicon glyphicon-', if(`vendor`.`fo_AVList`, 'check', 'unchecked'), '\"></i>')" => "fo_AVList",
		"`vendor`.`fo_ContactTitle`" => "fo_ContactTitle",
		"`vendor`.`fo_Address`" => "fo_Address",
		"`vendor`.`fo_City`" => "fo_City",
		"`vendor`.`fo_Region`" => "fo_Region",
		"`vendor`.`fo_PostalCode`" => "fo_PostalCode",
		"`vendor`.`fo_Country`" => "fo_Country",
		"`vendor`.`fo_Phone`" => "fo_Phone",
		"`vendor`.`fo_Fax`" => "fo_Fax",
		"`vendor`.`fo_HomePage`" => "fo_HomePage",
		"CONCAT_WS('-', LEFT(`vendor`.`ot_FileLoc`,3), MID(`vendor`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`vendor`.`ot_otherdetails`" => "ot_otherdetails",
		"`vendor`.`ot_comments`" => "ot_comments",
		"`vendor`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`vendor`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`vendor`.`ot_Ref01`" => "ot_Ref01",
		"`vendor`.`ot_Ref02`" => "ot_Ref02",
		"`vendor`.`ot_Ref03`" => "ot_Ref03",
		"`vendor`.`ot_Ref04`" => "ot_Ref04",
		"`vendor`.`ot_Ref05`" => "ot_Ref05",
		"`vendor`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`vendor`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`vendor`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`vendor`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`vendor`.`ot_ap_filed`,date_format(`vendor`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`vendor`.`ot_ap_lastmodified`,date_format(`vendor`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`vendor` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`vendor`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`vendor`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`vendor`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "vendor_view.php";
	$x->RedirectAfterInsert = "vendor_view.php";
	$x->TableTitle = "Vendor & Subcontractor Register";
	$x->TableIcon = "resources/table_icons/group.png";
	$x->PrimaryKey = "`vendor`.`VendorID`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  250, 130, 100, 150, 50, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Company Record Number", "Company Name", "AVL", "Contact", "Web Site", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('CompanyID', 'CopanyName', 'fo_AVList', 'fo_ContactTitle', 'fo_HomePage', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 13, 28, 30, 32, 34, 35);

	// template paths below are based on the app main directory
	$x->Template = 'templates/vendor_templateTV.html';
	$x->SelectedTemplate = 'templates/vendor_templateTVS.html';
	$x->TemplateDV = 'templates/vendor_templateDV.html';
	$x->TemplateDVP = 'templates/vendor_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `vendor`.`VendorID`=membership_userrecords.pkValue and membership_userrecords.tableName='vendor' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `vendor`.`VendorID`=membership_userrecords.pkValue and membership_userrecords.tableName='vendor' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`vendor`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: vendor_init
	$render=TRUE;
	if(function_exists('vendor_init')){
		$args=array();
		$render=vendor_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: vendor_header
	$headerCode='';
	if(function_exists('vendor_header')){
		$args=array();
		$headerCode=vendor_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: vendor_footer
	$footerCode='';
	if(function_exists('vendor_footer')){
		$args=array();
		$footerCode=vendor_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>