<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Item.php");
	include("$currDir/Item_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Item');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Item";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Item`.`ProductID`" => "ProductID",
		"`Item`.`ItemID`" => "ItemID",
		"`Item`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "fo_CategoryID",
		"`Item`.`fo_QuantityPerUnit`" => "fo_QuantityPerUnit",
		"CONCAT('$', FORMAT(`Item`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Item`.`fo_UnitsInStock`" => "fo_UnitsInStock",
		"`Item`.`fo_UnitsOnOrder`" => "fo_UnitsOnOrder",
		"`Item`.`fo_ReorderLevel`" => "fo_ReorderLevel",
		"`Item`.`fo_Description`" => "fo_Description",
		"concat('<i class=\"glyphicon glyphicon-', if(`Item`.`fo_Discontinued`, 'check', 'unchecked'), '\"></i>')" => "fo_Discontinued",
		"CONCAT_WS('-', LEFT(`Item`.`ot_FileLoc`,3), MID(`Item`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Item`.`ot_otherdetails`" => "ot_otherdetails",
		"`Item`.`ot_comments`" => "ot_comments",
		"`Item`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Item`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Item`.`ot_Ref01`" => "ot_Ref01",
		"`Item`.`ot_Ref02`" => "ot_Ref02",
		"`Item`.`ot_Ref03`" => "ot_Ref03",
		"`Item`.`ot_Ref04`" => "ot_Ref04",
		"`Item`.`ot_Ref05`" => "ot_Ref05",
		"`Item`.`ot_Ref06`" => "ot_Ref06",
		"`Item`.`ot_Photo01`" => "ot_Photo01",
		"`Item`.`ot_Photo02`" => "ot_Photo02",
		"`Item`.`ot_Photo03`" => "ot_Photo03",
		"if(`Item`.`ot_ap_filed`,date_format(`Item`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Item`.`ot_ap_lastmodified`,date_format(`Item`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Item`.`ProductID`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => '`categories1`.`CategoryName`',
		6 => 6,
		7 => '`Item`.`fo_UnitPrice`',
		8 => '`Item`.`fo_UnitsInStock`',
		9 => '`Item`.`fo_UnitsOnOrder`',
		10 => '`Item`.`fo_ReorderLevel`',
		11 => 11,
		12 => '`Item`.`fo_Discontinued`',
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
		27 => '`Item`.`ot_ap_filed`',
		28 => '`Item`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Item`.`ProductID`" => "ProductID",
		"`Item`.`ItemID`" => "ItemID",
		"`Item`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "fo_CategoryID",
		"`Item`.`fo_QuantityPerUnit`" => "fo_QuantityPerUnit",
		"CONCAT('$', FORMAT(`Item`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Item`.`fo_UnitsInStock`" => "fo_UnitsInStock",
		"`Item`.`fo_UnitsOnOrder`" => "fo_UnitsOnOrder",
		"`Item`.`fo_ReorderLevel`" => "fo_ReorderLevel",
		"`Item`.`fo_Description`" => "fo_Description",
		"`Item`.`fo_Discontinued`" => "fo_Discontinued",
		"CONCAT_WS('-', LEFT(`Item`.`ot_FileLoc`,3), MID(`Item`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Item`.`ot_otherdetails`" => "ot_otherdetails",
		"`Item`.`ot_comments`" => "ot_comments",
		"`Item`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Item`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Item`.`ot_Ref01`" => "ot_Ref01",
		"`Item`.`ot_Ref02`" => "ot_Ref02",
		"`Item`.`ot_Ref03`" => "ot_Ref03",
		"`Item`.`ot_Ref04`" => "ot_Ref04",
		"`Item`.`ot_Ref05`" => "ot_Ref05",
		"`Item`.`ot_Ref06`" => "ot_Ref06",
		"`Item`.`ot_Photo01`" => "ot_Photo01",
		"`Item`.`ot_Photo02`" => "ot_Photo02",
		"`Item`.`ot_Photo03`" => "ot_Photo03",
		"if(`Item`.`ot_ap_filed`,date_format(`Item`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Item`.`ot_ap_lastmodified`,date_format(`Item`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Item`.`ProductID`" => "Product ID",
		"`Item`.`ItemID`" => "Item ID",
		"`Item`.`ProductName`" => "Product Name",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "Vendor",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "Category",
		"`Item`.`fo_QuantityPerUnit`" => "Quantity Per Unit",
		"`Item`.`fo_UnitPrice`" => "Total Value",
		"`Item`.`fo_UnitsInStock`" => "Units In Stock",
		"`Item`.`fo_UnitsOnOrder`" => "Units On Order",
		"`Item`.`fo_ReorderLevel`" => "Reorder Level",
		"`Item`.`fo_Description`" => "Description ",
		"`Item`.`fo_Discontinued`" => "Discontinued",
		"`Item`.`ot_FileLoc`" => "File Location & Number",
		"`Item`.`ot_otherdetails`" => "Other details",
		"`Item`.`ot_comments`" => "Comments",
		"`Item`.`ot_SharedLink1`" => "Shared Link 1",
		"`Item`.`ot_SharedLink2`" => "Shared Link 2",
		"`Item`.`ot_Ref01`" => "Reference_1",
		"`Item`.`ot_Ref02`" => "Reference_2",
		"`Item`.`ot_Ref03`" => "Reference_3",
		"`Item`.`ot_Ref04`" => "Reference_4",
		"`Item`.`ot_Ref05`" => "Reference_5",
		"`Item`.`ot_Ref06`" => "Reference_6",
		"`Item`.`ot_ap_filed`" => "Filed",
		"`Item`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Item`.`ProductID`" => "ProductID",
		"`Item`.`ItemID`" => "ItemID",
		"`Item`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`vendor1`.`CompanyID`) || CHAR_LENGTH(`vendor1`.`CopanyName`), CONCAT_WS('',   `vendor1`.`CompanyID`, '::', `vendor1`.`CopanyName`), '') /* Vendor */" => "fo_SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "fo_CategoryID",
		"`Item`.`fo_QuantityPerUnit`" => "fo_QuantityPerUnit",
		"CONCAT('$', FORMAT(`Item`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Item`.`fo_UnitsInStock`" => "fo_UnitsInStock",
		"`Item`.`fo_UnitsOnOrder`" => "fo_UnitsOnOrder",
		"`Item`.`fo_ReorderLevel`" => "fo_ReorderLevel",
		"`Item`.`fo_Description`" => "fo_Description",
		"concat('<i class=\"glyphicon glyphicon-', if(`Item`.`fo_Discontinued`, 'check', 'unchecked'), '\"></i>')" => "fo_Discontinued",
		"CONCAT_WS('-', LEFT(`Item`.`ot_FileLoc`,3), MID(`Item`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Item`.`ot_otherdetails`" => "ot_otherdetails",
		"`Item`.`ot_comments`" => "ot_comments",
		"`Item`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Item`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Item`.`ot_Ref01`" => "ot_Ref01",
		"`Item`.`ot_Ref02`" => "ot_Ref02",
		"`Item`.`ot_Ref03`" => "ot_Ref03",
		"`Item`.`ot_Ref04`" => "ot_Ref04",
		"`Item`.`ot_Ref05`" => "ot_Ref05",
		"`Item`.`ot_Ref06`" => "ot_Ref06",
		"if(`Item`.`ot_ap_filed`,date_format(`Item`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Item`.`ot_ap_lastmodified`,date_format(`Item`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'fo_SupplierID' => 'Vendor', 'fo_CategoryID' => 'Category');

	$x->QueryFrom = "`Item` LEFT JOIN `vendor` as vendor1 ON `vendor1`.`VendorID`=`Item`.`fo_SupplierID` LEFT JOIN `categories` as categories1 ON `categories1`.`CategoryID`=`Item`.`fo_CategoryID` ";
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
	$x->ScriptFileName = "Item_view.php";
	$x->RedirectAfterInsert = "Item_view.php";
	$x->TableTitle = "Resources Inventory";
	$x->TableIcon = "resources/table_icons/barcode.png";
	$x->PrimaryKey = "`Item`.`ProductID`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 250, 200, 120, 70, 100, 150, 150);
	$x->ColCaption = array("Item ID", "Product Name", "Vendor", "Category", "Total Value", "Discontinued", "Filed", "Last modified");
	$x->ColFieldName = array('ItemID', 'ProductName', 'fo_SupplierID', 'fo_CategoryID', 'fo_UnitPrice', 'fo_Discontinued', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 12, 27, 28);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Item_templateTV.html';
	$x->SelectedTemplate = 'templates/Item_templateTVS.html';
	$x->TemplateDV = 'templates/Item_templateDV.html';
	$x->TemplateDVP = 'templates/Item_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Item`.`ProductID`=membership_userrecords.pkValue and membership_userrecords.tableName='Item' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Item`.`ProductID`=membership_userrecords.pkValue and membership_userrecords.tableName='Item' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Item`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Item_init
	$render=TRUE;
	if(function_exists('Item_init')){
		$args=array();
		$render=Item_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// column sums
	if(strpos($x->HTML, '<!-- tv data below -->')){
		// if printing multi-selection TV, calculate the sum only for the selected records
		if(isset($_REQUEST['Print_x']) && is_array($_REQUEST['record_selector'])){
			$QueryWhere = '';
			foreach($_REQUEST['record_selector'] as $id){   // get selected records
				if($id != '') $QueryWhere .= "'" . makeSafe($id) . "',";
			}
			if($QueryWhere != ''){
				$QueryWhere = 'where `Item`.`ProductID` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('$', FORMAT(sum(`Item`.`fo_UnitPrice`), 2)) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)){
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Item-ItemID"></td>';
			$sumRow .= '<td class="Item-ProductName"></td>';
			$sumRow .= '<td class="Item-fo_SupplierID"></td>';
			$sumRow .= '<td class="Item-fo_CategoryID"></td>';
			$sumRow .= "<td class=\"Item-fo_UnitPrice text-left\">{$row[0]}</td>";
			$sumRow .= '<td class="Item-fo_Discontinued"></td>';
			$sumRow .= '<td class="Item-ot_ap_filed"></td>';
			$sumRow .= '<td class="Item-ot_ap_lastmodified"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Item_header
	$headerCode='';
	if(function_exists('Item_header')){
		$args=array();
		$headerCode=Item_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Item_footer
	$footerCode='';
	if(function_exists('Item_footer')){
		$args=array();
		$footerCode=Item_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>