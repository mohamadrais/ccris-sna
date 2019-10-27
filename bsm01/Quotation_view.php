<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Quotation.php");
	include("$currDir/Quotation_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Quotation');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Quotation";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Quotation`.`id`" => "id",
		"`Quotation`.`QuoID`" => "QuoID",
		"IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') /* Order ID */" => "OrderID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor ID */" => "fo_Vendor",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"`Quotation`.`fo_Price`" => "fo_Price",
		"`Quotation`.`fo_Description`" => "fo_Description",
		"CONCAT('$', FORMAT(`Quotation`.`fo_Discount`, 2))" => "fo_Discount",
		"CONCAT_WS('-', LEFT(`Quotation`.`ot_FileLoc`,3), MID(`Quotation`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Quotation`.`ot_otherdetails`" => "ot_otherdetails",
		"`Quotation`.`ot_comments`" => "ot_comments",
		"`Quotation`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Quotation`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Quotation`.`ot_Ref01`" => "ot_Ref01",
		"`Quotation`.`ot_Ref02`" => "ot_Ref02",
		"`Quotation`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Quotation`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Quotation`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Quotation`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`Quotation`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Quotation`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Quotation`.`id`',
		2 => 2,
		3 => '`orders1`.`OrderID`',
		4 => 4,
		5 => 5,
		6 => '`Quotation`.`fo_Price`',
		7 => 7,
		8 => '`Quotation`.`fo_Discount`',
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
		23 => '`Quotation`.`ot_ap_filed`',
		24 => '`Quotation`.`ot_ap_last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Quotation`.`id`" => "id",
		"`Quotation`.`QuoID`" => "QuoID",
		"IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') /* Order ID */" => "OrderID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor ID */" => "fo_Vendor",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"`Quotation`.`fo_Price`" => "fo_Price",
		"`Quotation`.`fo_Description`" => "fo_Description",
		"CONCAT('$', FORMAT(`Quotation`.`fo_Discount`, 2))" => "fo_Discount",
		"CONCAT_WS('-', LEFT(`Quotation`.`ot_FileLoc`,3), MID(`Quotation`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Quotation`.`ot_otherdetails`" => "ot_otherdetails",
		"`Quotation`.`ot_comments`" => "ot_comments",
		"`Quotation`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Quotation`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Quotation`.`ot_Ref01`" => "ot_Ref01",
		"`Quotation`.`ot_Ref02`" => "ot_Ref02",
		"`Quotation`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Quotation`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Quotation`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Quotation`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`Quotation`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Quotation`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Quotation`.`id`" => "ID",
		"`Quotation`.`QuoID`" => "Quotation ID",
		"IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') /* Order ID */" => "Order ID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor ID */" => "Vendor ID",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "Ship Via",
		"`Quotation`.`fo_Price`" => "Lump Sum Price",
		"`Quotation`.`fo_Description`" => "Description",
		"`Quotation`.`fo_Discount`" => "Discount",
		"`Quotation`.`ot_FileLoc`" => "File Location & Number",
		"`Quotation`.`ot_otherdetails`" => "Other details",
		"`Quotation`.`ot_comments`" => "Comments",
		"`Quotation`.`ot_SharedLink1`" => "Shared Link 1",
		"`Quotation`.`ot_SharedLink2`" => "Shared Link 2",
		"`Quotation`.`ot_Ref01`" => "Reference_1",
		"`Quotation`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`Quotation`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`Quotation`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`Quotation`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`Quotation`.`ot_ap_filed`" => "Filed",
		"`Quotation`.`ot_ap_last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Quotation`.`id`" => "id",
		"`Quotation`.`QuoID`" => "QuoID",
		"IF(    CHAR_LENGTH(`orders1`.`OrderID`), CONCAT_WS('',   `orders1`.`OrderID`), '') /* Order ID */" => "OrderID",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor ID */" => "fo_Vendor",
		"IF(    CHAR_LENGTH(`Logistics1`.`LogisticID`) || CHAR_LENGTH(`Logistics1`.`CompanyName`), CONCAT_WS('',   `Logistics1`.`LogisticID`, '::', `Logistics1`.`CompanyName`), '') /* Ship Via */" => "fo_ShipVia",
		"`Quotation`.`fo_Price`" => "fo_Price",
		"`Quotation`.`fo_Description`" => "fo_Description",
		"CONCAT('$', FORMAT(`Quotation`.`fo_Discount`, 2))" => "fo_Discount",
		"CONCAT_WS('-', LEFT(`Quotation`.`ot_FileLoc`,3), MID(`Quotation`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Quotation`.`ot_otherdetails`" => "ot_otherdetails",
		"`Quotation`.`ot_comments`" => "ot_comments",
		"`Quotation`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Quotation`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Quotation`.`ot_Ref01`" => "ot_Ref01",
		"`Quotation`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Quotation`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Quotation`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Quotation`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`Quotation`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`Quotation`.`ot_ap_last_modified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'OrderID' => 'Order ID', 'fo_Vendor' => 'Vendor ID', 'fo_ShipVia' => 'Ship Via', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`Quotation` LEFT JOIN `orders` as orders1 ON `orders1`.`id`=`Quotation`.`OrderID` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`Quotation`.`fo_Vendor` LEFT JOIN `Logistics` as Logistics1 ON `Logistics1`.`ShipperID`=`Quotation`.`fo_ShipVia` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Quotation`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Quotation`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Quotation`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "Quotation_view.php";
	$x->RedirectAfterInsert = "Quotation_view.php?SelectedID=#ID#";
	$x->TableTitle = "Quotations";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`Quotation`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 70, 70, 150, 80, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Quotation ID", "Order ID", "Vendor ID", "Ship Via", "Lump Sum Price", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('QuoID', 'OrderID', 'fo_Vendor', 'fo_ShipVia', 'fo_Price', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_last_modified');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 17, 19, 21, 23, 24);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Quotation_templateTV.html';
	$x->SelectedTemplate = 'templates/Quotation_templateTVS.html';
	$x->TemplateDV = 'templates/Quotation_templateDV.html';
	$x->TemplateDVP = 'templates/Quotation_templateDVP.html';

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
		$x->QueryWhere="where `Quotation`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Quotation' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Quotation`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Quotation' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Quotation`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Quotation_init
	$render=TRUE;
	if(function_exists('Quotation_init')){
		$args=array();
		$render=Quotation_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Quotation_header
	$headerCode='';
	if(function_exists('Quotation_header')){
		$args=array();
		$headerCode=Quotation_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Quotation_footer
	$footerCode='';
	if(function_exists('Quotation_footer')){
		$args=array();
		$footerCode=Quotation_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>