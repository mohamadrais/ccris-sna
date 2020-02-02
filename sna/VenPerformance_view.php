<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/VenPerformance.php");
	include("$currDir/VenPerformance_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('VenPerformance');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "VenPerformance";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`VenPerformance`.`id`" => "id",
		"`VenPerformance`.`VendPerfNumber`" => "VendPerfNumber",
		"`VenPerformance`.`DocItem`" => "DocItem",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"concat('<i class=\"glyphicon glyphicon-', if(`VenPerformance`.`fo_NewList`, 'check', 'unchecked'), '\"></i>')" => "fo_NewList",
		"`VenPerformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`VenPerformance`.`fo_Classification`" => "fo_Classification",
		"if(`VenPerformance`.`fo_Perfdate`,date_format(`VenPerformance`.`fo_Perfdate`,'%m/%d/%Y'),'')" => "fo_Perfdate",
		"`VenPerformance`.`fo_image`" => "fo_image",
		"`VenPerformance`.`fo_address`" => "fo_address",
		"`VenPerformance`.`fo_city`" => "fo_city",
		"`VenPerformance`.`fo_state`" => "fo_state",
		"`VenPerformance`.`fo_zip`" => "fo_zip",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_workphone`,3), MID(`VenPerformance`.`fo_workphone`,4,3), RIGHT(`VenPerformance`.`fo_workphone`,4))" => "fo_workphone",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_mobile`,3), MID(`VenPerformance`.`fo_mobile`,4,3))" => "fo_mobile",
		"`VenPerformance`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`ot_FileLoc`,3), MID(`VenPerformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`VenPerformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`VenPerformance`.`ot_comments`" => "ot_comments",
		"`VenPerformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`VenPerformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`VenPerformance`.`ot_Ref01`" => "ot_Ref01",
		"`VenPerformance`.`ot_Ref02`" => "ot_Ref02",
		"`VenPerformance`.`ot_Ref03`" => "ot_Ref03",
		"`VenPerformance`.`ot_Ref04`" => "ot_Ref04",
		"`VenPerformance`.`ot_Ref05`" => "ot_Ref05",
		"`VenPerformance`.`ot_Ref06`" => "ot_Ref06",
		"`VenPerformance`.`ot_Photo01`" => "ot_Photo01",
		"`VenPerformance`.`ot_Photo02`" => "ot_Photo02",
		"`VenPerformance`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`VenPerformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`VenPerformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`VenPerformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`VenPerformance`.`ot_ap_filed`,date_format(`VenPerformance`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`VenPerformance`.`ot_ap_lastmodified`,date_format(`VenPerformance`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`VenPerformance`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => '`VenPerformance`.`fo_NewList`',
		6 => 6,
		7 => 7,
		8 => '`VenPerformance`.`fo_Perfdate`',
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
		28 => 28,
		29 => 29,
		30 => 30,
		31 => '`Leadership1`.`Status`',
		32 => 32,
		33 => '`Approval1`.`Status`',
		34 => 34,
		35 => '`IMSControl1`.`Status`',
		36 => 36,
		37 => '`VenPerformance`.`ot_ap_filed`',
		38 => '`VenPerformance`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`VenPerformance`.`id`" => "id",
		"`VenPerformance`.`VendPerfNumber`" => "VendPerfNumber",
		"`VenPerformance`.`DocItem`" => "DocItem",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"`VenPerformance`.`fo_NewList`" => "fo_NewList",
		"`VenPerformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`VenPerformance`.`fo_Classification`" => "fo_Classification",
		"if(`VenPerformance`.`fo_Perfdate`,date_format(`VenPerformance`.`fo_Perfdate`,'%m/%d/%Y'),'')" => "fo_Perfdate",
		"`VenPerformance`.`fo_image`" => "fo_image",
		"`VenPerformance`.`fo_address`" => "fo_address",
		"`VenPerformance`.`fo_city`" => "fo_city",
		"`VenPerformance`.`fo_state`" => "fo_state",
		"`VenPerformance`.`fo_zip`" => "fo_zip",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_workphone`,3), MID(`VenPerformance`.`fo_workphone`,4,3), RIGHT(`VenPerformance`.`fo_workphone`,4))" => "fo_workphone",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_mobile`,3), MID(`VenPerformance`.`fo_mobile`,4,3))" => "fo_mobile",
		"`VenPerformance`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`ot_FileLoc`,3), MID(`VenPerformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`VenPerformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`VenPerformance`.`ot_comments`" => "ot_comments",
		"`VenPerformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`VenPerformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`VenPerformance`.`ot_Ref01`" => "ot_Ref01",
		"`VenPerformance`.`ot_Ref02`" => "ot_Ref02",
		"`VenPerformance`.`ot_Ref03`" => "ot_Ref03",
		"`VenPerformance`.`ot_Ref04`" => "ot_Ref04",
		"`VenPerformance`.`ot_Ref05`" => "ot_Ref05",
		"`VenPerformance`.`ot_Ref06`" => "ot_Ref06",
		"`VenPerformance`.`ot_Photo01`" => "ot_Photo01",
		"`VenPerformance`.`ot_Photo02`" => "ot_Photo02",
		"`VenPerformance`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`VenPerformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`VenPerformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`VenPerformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`VenPerformance`.`ot_ap_filed`,date_format(`VenPerformance`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`VenPerformance`.`ot_ap_lastmodified`,date_format(`VenPerformance`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`VenPerformance`.`id`" => "ID",
		"`VenPerformance`.`VendPerfNumber`" => "Record ID",
		"`VenPerformance`.`DocItem`" => "Title",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "Vendor",
		"`VenPerformance`.`fo_NewList`" => "New Vendor",
		"`VenPerformance`.`fo_DocumentDescription`" => "Description",
		"`VenPerformance`.`fo_Classification`" => "Classification",
		"`VenPerformance`.`fo_Perfdate`" => "Review Date",
		"`VenPerformance`.`fo_address`" => "Address",
		"`VenPerformance`.`fo_city`" => "City",
		"`VenPerformance`.`fo_state`" => "State",
		"`VenPerformance`.`fo_zip`" => "Zip",
		"`VenPerformance`.`fo_workphone`" => "Work phone",
		"`VenPerformance`.`fo_mobile`" => "Mobile",
		"`VenPerformance`.`fo_contactperson`" => "Contact person",
		"`VenPerformance`.`ot_FileLoc`" => "File Location & Number",
		"`VenPerformance`.`ot_otherdetails`" => "Other details",
		"`VenPerformance`.`ot_comments`" => "Comments",
		"`VenPerformance`.`ot_SharedLink1`" => "Shared Link 1",
		"`VenPerformance`.`ot_SharedLink2`" => "Shared Link 2",
		"`VenPerformance`.`ot_Ref01`" => "Reference_1",
		"`VenPerformance`.`ot_Ref02`" => "Reference_2",
		"`VenPerformance`.`ot_Ref03`" => "Reference_3",
		"`VenPerformance`.`ot_Ref04`" => "Reference_4",
		"`VenPerformance`.`ot_Ref05`" => "Reference_5",
		"`VenPerformance`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`VenPerformance`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`VenPerformance`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`VenPerformance`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`VenPerformance`.`ot_ap_filed`" => "Register",
		"`VenPerformance`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`VenPerformance`.`id`" => "id",
		"`VenPerformance`.`VendPerfNumber`" => "VendPerfNumber",
		"`VenPerformance`.`DocItem`" => "DocItem",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"concat('<i class=\"glyphicon glyphicon-', if(`VenPerformance`.`fo_NewList`, 'check', 'unchecked'), '\"></i>')" => "fo_NewList",
		"`VenPerformance`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`VenPerformance`.`fo_Classification`" => "fo_Classification",
		"if(`VenPerformance`.`fo_Perfdate`,date_format(`VenPerformance`.`fo_Perfdate`,'%m/%d/%Y'),'')" => "fo_Perfdate",
		"`VenPerformance`.`fo_address`" => "fo_address",
		"`VenPerformance`.`fo_city`" => "fo_city",
		"`VenPerformance`.`fo_state`" => "fo_state",
		"`VenPerformance`.`fo_zip`" => "fo_zip",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_workphone`,3), MID(`VenPerformance`.`fo_workphone`,4,3), RIGHT(`VenPerformance`.`fo_workphone`,4))" => "fo_workphone",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`fo_mobile`,3), MID(`VenPerformance`.`fo_mobile`,4,3))" => "fo_mobile",
		"`VenPerformance`.`fo_contactperson`" => "fo_contactperson",
		"CONCAT_WS('-', LEFT(`VenPerformance`.`ot_FileLoc`,3), MID(`VenPerformance`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`VenPerformance`.`ot_otherdetails`" => "ot_otherdetails",
		"`VenPerformance`.`ot_comments`" => "ot_comments",
		"`VenPerformance`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`VenPerformance`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`VenPerformance`.`ot_Ref01`" => "ot_Ref01",
		"`VenPerformance`.`ot_Ref02`" => "ot_Ref02",
		"`VenPerformance`.`ot_Ref03`" => "ot_Ref03",
		"`VenPerformance`.`ot_Ref04`" => "ot_Ref04",
		"`VenPerformance`.`ot_Ref05`" => "ot_Ref05",
		"`VenPerformance`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`VenPerformance`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`VenPerformance`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`VenPerformance`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`VenPerformance`.`ot_ap_filed`,date_format(`VenPerformance`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`VenPerformance`.`ot_ap_lastmodified`,date_format(`VenPerformance`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'fo_SupplierID' => 'Vendor', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`VenPerformance` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`VenPerformance`.`fo_SupplierID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`VenPerformance`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`VenPerformance`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`VenPerformance`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "VenPerformance_view.php";
	$x->RedirectAfterInsert = "VenPerformance_view.php?SelectedID=#ID#";
	$x->TableTitle = "Vendor Performance and Evaluation";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`VenPerformance`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 120, 200, 100, 70, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Title", "Vendor", "New Vendor", "Classification", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('VendPerfNumber', 'DocItem', 'fo_SupplierID', 'fo_NewList', 'fo_Classification', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 31, 33, 35, 37, 38);

	// template paths below are based on the app main directory
	$x->Template = 'templates/VenPerformance_templateTV.html';
	$x->SelectedTemplate = 'templates/VenPerformance_templateTVS.html';
	$x->TemplateDV = 'templates/VenPerformance_templateDV.html';
	$x->TemplateDVP = 'templates/VenPerformance_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `VenPerformance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='VenPerformance' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `VenPerformance`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='VenPerformance' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`VenPerformance`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: VenPerformance_init
	$render=TRUE;
	if(function_exists('VenPerformance_init')){
		$args=array();
		$render=VenPerformance_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: VenPerformance_header
	$headerCode='';
	if(function_exists('VenPerformance_header')){
		$args=array();
		$headerCode=VenPerformance_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: VenPerformance_footer
	$footerCode='';
	if(function_exists('VenPerformance_footer')){
		$args=array();
		$footerCode=VenPerformance_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>