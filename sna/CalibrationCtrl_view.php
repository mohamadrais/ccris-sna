<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/CalibrationCtrl.php");
	include("$currDir/CalibrationCtrl_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('CalibrationCtrl');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "CalibrationCtrl";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`CalibrationCtrl`.`id`" => "id",
		"`CalibrationCtrl`.`CalibrationID`" => "CalibrationID",
		"`CalibrationCtrl`.`Calibtitle`" => "Calibtitle",
		"IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '; ', `Inventory1`.`asset_title`), '') /* Asset ID */" => "fo_InventoryID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '; ', `vendor1`.`CopanyName`), '') /* Company Name */" => "fo_CalCom",
		"`CalibrationCtrl`.`fo_DurCal`" => "fo_DurCal",
		"if(`CalibrationCtrl`.`fo_Delivdate`,date_format(`CalibrationCtrl`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"`CalibrationCtrl`.`fo_contact_person`" => "fo_contact_person",
		"CONCAT_WS('-', LEFT(`CalibrationCtrl`.`ot_FileLoc`,3), MID(`CalibrationCtrl`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`CalibrationCtrl`.`ot_otherdetails`" => "ot_otherdetails",
		"`CalibrationCtrl`.`ot_comments`" => "ot_comments",
		"`CalibrationCtrl`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`CalibrationCtrl`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`CalibrationCtrl`.`ot_Ref01`" => "ot_Ref01",
		"`CalibrationCtrl`.`ot_Ref02`" => "ot_Ref02",
		"`CalibrationCtrl`.`ot_Ref03`" => "ot_Ref03",
		"`CalibrationCtrl`.`ot_Ref04`" => "ot_Ref04",
		"`CalibrationCtrl`.`ot_Ref05`" => "ot_Ref05",
		"`CalibrationCtrl`.`ot_Ref06`" => "ot_Ref06",
		"`CalibrationCtrl`.`ot_Photo01`" => "ot_Photo01",
		"`CalibrationCtrl`.`ot_Photo02`" => "ot_Photo02",
		"`CalibrationCtrl`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`CalibrationCtrl`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`CalibrationCtrl`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`CalibrationCtrl`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`CalibrationCtrl`.`ot_ap_filed`,date_format(`CalibrationCtrl`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`CalibrationCtrl`.`ot_ap_lastmodified`,date_format(`CalibrationCtrl`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`CalibrationCtrl`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`CalibrationCtrl`.`fo_Delivdate`',
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
		29 => '`CalibrationCtrl`.`ot_ap_filed`',
		30 => '`CalibrationCtrl`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`CalibrationCtrl`.`id`" => "id",
		"`CalibrationCtrl`.`CalibrationID`" => "CalibrationID",
		"`CalibrationCtrl`.`Calibtitle`" => "Calibtitle",
		"IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '; ', `Inventory1`.`asset_title`), '') /* Asset ID */" => "fo_InventoryID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '; ', `vendor1`.`CopanyName`), '') /* Company Name */" => "fo_CalCom",
		"`CalibrationCtrl`.`fo_DurCal`" => "fo_DurCal",
		"if(`CalibrationCtrl`.`fo_Delivdate`,date_format(`CalibrationCtrl`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"`CalibrationCtrl`.`fo_contact_person`" => "fo_contact_person",
		"CONCAT_WS('-', LEFT(`CalibrationCtrl`.`ot_FileLoc`,3), MID(`CalibrationCtrl`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`CalibrationCtrl`.`ot_otherdetails`" => "ot_otherdetails",
		"`CalibrationCtrl`.`ot_comments`" => "ot_comments",
		"`CalibrationCtrl`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`CalibrationCtrl`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`CalibrationCtrl`.`ot_Ref01`" => "ot_Ref01",
		"`CalibrationCtrl`.`ot_Ref02`" => "ot_Ref02",
		"`CalibrationCtrl`.`ot_Ref03`" => "ot_Ref03",
		"`CalibrationCtrl`.`ot_Ref04`" => "ot_Ref04",
		"`CalibrationCtrl`.`ot_Ref05`" => "ot_Ref05",
		"`CalibrationCtrl`.`ot_Ref06`" => "ot_Ref06",
		"`CalibrationCtrl`.`ot_Photo01`" => "ot_Photo01",
		"`CalibrationCtrl`.`ot_Photo02`" => "ot_Photo02",
		"`CalibrationCtrl`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`CalibrationCtrl`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`CalibrationCtrl`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`CalibrationCtrl`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`CalibrationCtrl`.`ot_ap_filed`,date_format(`CalibrationCtrl`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`CalibrationCtrl`.`ot_ap_lastmodified`,date_format(`CalibrationCtrl`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`CalibrationCtrl`.`id`" => "ID",
		"`CalibrationCtrl`.`CalibrationID`" => "Calibration Record ID",
		"`CalibrationCtrl`.`Calibtitle`" => "Calibration Title",
		"IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '; ', `Inventory1`.`asset_title`), '') /* Asset ID */" => "Asset ID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '; ', `vendor1`.`CopanyName`), '') /* Company Name */" => "Company Name",
		"`CalibrationCtrl`.`fo_DurCal`" => "Duration required ",
		"`CalibrationCtrl`.`fo_Delivdate`" => "Re-calibration date",
		"`CalibrationCtrl`.`fo_contact_person`" => "Contact Person",
		"`CalibrationCtrl`.`ot_FileLoc`" => "File Location & Number",
		"`CalibrationCtrl`.`ot_otherdetails`" => "Other details",
		"`CalibrationCtrl`.`ot_comments`" => "Comments",
		"`CalibrationCtrl`.`ot_SharedLink1`" => "Shared Link 1",
		"`CalibrationCtrl`.`ot_SharedLink2`" => "Shared Link 2",
		"`CalibrationCtrl`.`ot_Ref01`" => "Reference_1",
		"`CalibrationCtrl`.`ot_Ref02`" => "Reference_2",
		"`CalibrationCtrl`.`ot_Ref03`" => "Reference_3",
		"`CalibrationCtrl`.`ot_Ref04`" => "Reference_4",
		"`CalibrationCtrl`.`ot_Ref05`" => "Reference_5",
		"`CalibrationCtrl`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`CalibrationCtrl`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`CalibrationCtrl`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`CalibrationCtrl`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`CalibrationCtrl`.`ot_ap_filed`" => "Filed",
		"`CalibrationCtrl`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`CalibrationCtrl`.`id`" => "id",
		"`CalibrationCtrl`.`CalibrationID`" => "CalibrationID",
		"`CalibrationCtrl`.`Calibtitle`" => "Calibtitle",
		"IF(    CHAR_LENGTH(`Inventory1`.`InventoryID`) || CHAR_LENGTH(`Inventory1`.`asset_title`), CONCAT_WS('',   `Inventory1`.`InventoryID`, '; ', `Inventory1`.`asset_title`), '') /* Asset ID */" => "fo_InventoryID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '; ', `vendor1`.`CopanyName`), '') /* Company Name */" => "fo_CalCom",
		"`CalibrationCtrl`.`fo_DurCal`" => "fo_DurCal",
		"if(`CalibrationCtrl`.`fo_Delivdate`,date_format(`CalibrationCtrl`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"`CalibrationCtrl`.`fo_contact_person`" => "fo_contact_person",
		"CONCAT_WS('-', LEFT(`CalibrationCtrl`.`ot_FileLoc`,3), MID(`CalibrationCtrl`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`CalibrationCtrl`.`ot_otherdetails`" => "ot_otherdetails",
		"`CalibrationCtrl`.`ot_comments`" => "ot_comments",
		"`CalibrationCtrl`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`CalibrationCtrl`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`CalibrationCtrl`.`ot_Ref01`" => "ot_Ref01",
		"`CalibrationCtrl`.`ot_Ref02`" => "ot_Ref02",
		"`CalibrationCtrl`.`ot_Ref03`" => "ot_Ref03",
		"`CalibrationCtrl`.`ot_Ref04`" => "ot_Ref04",
		"`CalibrationCtrl`.`ot_Ref05`" => "ot_Ref05",
		"`CalibrationCtrl`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`CalibrationCtrl`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`CalibrationCtrl`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`CalibrationCtrl`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`CalibrationCtrl`.`ot_ap_filed`,date_format(`CalibrationCtrl`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`CalibrationCtrl`.`ot_ap_lastmodified`,date_format(`CalibrationCtrl`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'fo_InventoryID' => 'Asset ID', 'fo_CalCom' => 'Company Name', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`CalibrationCtrl` LEFT JOIN `Inventory` as Inventory1 ON `Inventory1`.`id`=`CalibrationCtrl`.`fo_InventoryID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`CalibrationCtrl`.`fo_CalCom` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`CalibrationCtrl`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`CalibrationCtrl`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`CalibrationCtrl`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "CalibrationCtrl_view.php";
	$x->RedirectAfterInsert = "CalibrationCtrl_view.php?SelectedID=#ID#";
	$x->TableTitle = "Calibration Control";
	$x->TableIcon = "resources/table_icons/cog_add.png";
	$x->PrimaryKey = "`CalibrationCtrl`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  100, 150, 70, 100, 100, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Calibration Record ID", "Calibration Title", "Asset ID", "Company Name", "Duration required ", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('CalibrationID', 'Calibtitle', 'fo_InventoryID', 'fo_CalCom', 'fo_DurCal', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 23, 25, 27, 29, 30);

	// template paths below are based on the app main directory
	$x->Template = 'templates/CalibrationCtrl_templateTV.html';
	$x->SelectedTemplate = 'templates/CalibrationCtrl_templateTVS.html';
	$x->TemplateDV = 'templates/CalibrationCtrl_templateDV.html';
	$x->TemplateDVP = 'templates/CalibrationCtrl_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `CalibrationCtrl`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CalibrationCtrl' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `CalibrationCtrl`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='CalibrationCtrl' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`CalibrationCtrl`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: CalibrationCtrl_init
	$render=TRUE;
	if(function_exists('CalibrationCtrl_init')){
		$args=array();
		$render=CalibrationCtrl_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: CalibrationCtrl_header
	$headerCode='';
	if(function_exists('CalibrationCtrl_header')){
		$args=array();
		$headerCode=CalibrationCtrl_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: CalibrationCtrl_footer
	$footerCode='';
	if(function_exists('CalibrationCtrl_footer')){
		$args=array();
		$footerCode=CalibrationCtrl_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>