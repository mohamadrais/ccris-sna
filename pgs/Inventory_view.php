<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Inventory.php");
	include("$currDir/Inventory_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Inventory');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Inventory";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Inventory`.`id`" => "id",
		"`Inventory`.`InventoryID`" => "InventoryID",
		"`Inventory`.`asset_title`" => "asset_title",
		"`Inventory`.`Description`" => "Description",
		"`Inventory`.`fo_Type`" => "fo_Type",
		"`Inventory`.`fo_Manufacturer`" => "fo_Manufacturer",
		"`Inventory`.`fo_ModelNumber`" => "fo_ModelNumber",
		"`Inventory`.`fo_SerialNumber`" => "fo_SerialNumber",
		"`Inventory`.`fo_Condition`" => "fo_Condition",
		"`Inventory`.`fo_history`" => "fo_history",
		"`Inventory`.`fo_Quantity`" => "fo_Quantity",
		"CONCAT('$', FORMAT(`Inventory`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Inventory`.`fo_Remarks`" => "fo_Remarks",
		"if(`Inventory`.`fo_date`,date_format(`Inventory`.`fo_date`,'%m/%d/%Y'),'')" => "fo_date",
		"CONCAT_WS('-', LEFT(`Inventory`.`fo_ItemLocation`,3), MID(`Inventory`.`fo_ItemLocation`,4,3))" => "fo_ItemLocation",
		"`Inventory`.`fo_image`" => "fo_image",
		"CONCAT_WS('-', LEFT(`Inventory`.`ot_FileLoc`,3), MID(`Inventory`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inventory`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inventory`.`ot_comments`" => "ot_comments",
		"`Inventory`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inventory`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inventory`.`ot_Location`" => "ot_Location",
		"`Inventory`.`ot_Ref01`" => "ot_Ref01",
		"`Inventory`.`ot_Ref02`" => "ot_Ref02",
		"`Inventory`.`ot_Ref03`" => "ot_Ref03",
		"`Inventory`.`ot_Ref04`" => "ot_Ref04",
		"`Inventory`.`ot_Ref05`" => "ot_Ref05",
		"`Inventory`.`ot_Ref06`" => "ot_Ref06",
		"`Inventory`.`ot_Photo01`" => "ot_Photo01",
		"`Inventory`.`ot_Photo02`" => "ot_Photo02",
		"`Inventory`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inventory`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inventory`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inventory`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inventory`.`ot_ap_filed`,date_format(`Inventory`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inventory`.`ot_ap_last_modified`,date_format(`Inventory`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Inventory`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => '`Inventory`.`fo_Quantity`',
		12 => '`Inventory`.`fo_UnitPrice`',
		13 => 13,
		14 => '`Inventory`.`fo_date`',
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
		31 => 31,
		32 => '`Leadership1`.`Status`',
		33 => 33,
		34 => '`Approval1`.`Status`',
		35 => 35,
		36 => '`IMSControl1`.`Status`',
		37 => 37,
		38 => '`Inventory`.`ot_ap_filed`',
		39 => '`Inventory`.`ot_ap_last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Inventory`.`id`" => "id",
		"`Inventory`.`InventoryID`" => "InventoryID",
		"`Inventory`.`asset_title`" => "asset_title",
		"`Inventory`.`Description`" => "Description",
		"`Inventory`.`fo_Type`" => "fo_Type",
		"`Inventory`.`fo_Manufacturer`" => "fo_Manufacturer",
		"`Inventory`.`fo_ModelNumber`" => "fo_ModelNumber",
		"`Inventory`.`fo_SerialNumber`" => "fo_SerialNumber",
		"`Inventory`.`fo_Condition`" => "fo_Condition",
		"`Inventory`.`fo_history`" => "fo_history",
		"`Inventory`.`fo_Quantity`" => "fo_Quantity",
		"CONCAT('$', FORMAT(`Inventory`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Inventory`.`fo_Remarks`" => "fo_Remarks",
		"if(`Inventory`.`fo_date`,date_format(`Inventory`.`fo_date`,'%m/%d/%Y'),'')" => "fo_date",
		"CONCAT_WS('-', LEFT(`Inventory`.`fo_ItemLocation`,3), MID(`Inventory`.`fo_ItemLocation`,4,3))" => "fo_ItemLocation",
		"`Inventory`.`fo_image`" => "fo_image",
		"CONCAT_WS('-', LEFT(`Inventory`.`ot_FileLoc`,3), MID(`Inventory`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inventory`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inventory`.`ot_comments`" => "ot_comments",
		"`Inventory`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inventory`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inventory`.`ot_Location`" => "ot_Location",
		"`Inventory`.`ot_Ref01`" => "ot_Ref01",
		"`Inventory`.`ot_Ref02`" => "ot_Ref02",
		"`Inventory`.`ot_Ref03`" => "ot_Ref03",
		"`Inventory`.`ot_Ref04`" => "ot_Ref04",
		"`Inventory`.`ot_Ref05`" => "ot_Ref05",
		"`Inventory`.`ot_Ref06`" => "ot_Ref06",
		"`Inventory`.`ot_Photo01`" => "ot_Photo01",
		"`Inventory`.`ot_Photo02`" => "ot_Photo02",
		"`Inventory`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inventory`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inventory`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inventory`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inventory`.`ot_ap_filed`,date_format(`Inventory`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inventory`.`ot_ap_last_modified`,date_format(`Inventory`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Inventory`.`id`" => "ID",
		"`Inventory`.`InventoryID`" => "Asset Register Number",
		"`Inventory`.`asset_title`" => "Name of Asset",
		"`Inventory`.`Description`" => "Description Of Equipment",
		"`Inventory`.`fo_Type`" => "Type",
		"`Inventory`.`fo_Manufacturer`" => "Manufacturer",
		"`Inventory`.`fo_ModelNumber`" => "OEM Model Number",
		"`Inventory`.`fo_SerialNumber`" => "OEM Serial Number",
		"`Inventory`.`fo_Condition`" => "Equipment Condition",
		"`Inventory`.`fo_history`" => "History",
		"`Inventory`.`fo_Quantity`" => "Quantity",
		"`Inventory`.`fo_UnitPrice`" => "Estimated Total Price",
		"`Inventory`.`fo_Remarks`" => "Remarks",
		"`Inventory`.`fo_date`" => "Checked date",
		"`Inventory`.`fo_ItemLocation`" => "Equipment Location & Number",
		"`Inventory`.`ot_FileLoc`" => "File Location & Number",
		"`Inventory`.`ot_otherdetails`" => "Other details",
		"`Inventory`.`ot_comments`" => "Comments",
		"`Inventory`.`ot_SharedLink1`" => "Shared Link 1",
		"`Inventory`.`ot_SharedLink2`" => "Shared Link 2",
		"`Inventory`.`ot_Location`" => "Location",
		"`Inventory`.`ot_Ref01`" => "Reference_1",
		"`Inventory`.`ot_Ref02`" => "Reference_2",
		"`Inventory`.`ot_Ref03`" => "Reference_3",
		"`Inventory`.`ot_Ref04`" => "Reference_4",
		"`Inventory`.`ot_Ref05`" => "Reference_5",
		"`Inventory`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`Inventory`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`Inventory`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`Inventory`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`Inventory`.`ot_ap_filed`" => "Filed",
		"`Inventory`.`ot_ap_last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Inventory`.`id`" => "id",
		"`Inventory`.`InventoryID`" => "InventoryID",
		"`Inventory`.`asset_title`" => "asset_title",
		"`Inventory`.`Description`" => "Description",
		"`Inventory`.`fo_Type`" => "fo_Type",
		"`Inventory`.`fo_Manufacturer`" => "fo_Manufacturer",
		"`Inventory`.`fo_ModelNumber`" => "fo_ModelNumber",
		"`Inventory`.`fo_SerialNumber`" => "fo_SerialNumber",
		"`Inventory`.`fo_Condition`" => "fo_Condition",
		"`Inventory`.`fo_history`" => "fo_history",
		"`Inventory`.`fo_Quantity`" => "fo_Quantity",
		"CONCAT('$', FORMAT(`Inventory`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Inventory`.`fo_Remarks`" => "fo_Remarks",
		"if(`Inventory`.`fo_date`,date_format(`Inventory`.`fo_date`,'%m/%d/%Y'),'')" => "fo_date",
		"CONCAT_WS('-', LEFT(`Inventory`.`fo_ItemLocation`,3), MID(`Inventory`.`fo_ItemLocation`,4,3))" => "fo_ItemLocation",
		"CONCAT_WS('-', LEFT(`Inventory`.`ot_FileLoc`,3), MID(`Inventory`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Inventory`.`ot_otherdetails`" => "ot_otherdetails",
		"`Inventory`.`ot_comments`" => "ot_comments",
		"`Inventory`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Inventory`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Inventory`.`ot_Location`" => "ot_Location",
		"`Inventory`.`ot_Ref01`" => "ot_Ref01",
		"`Inventory`.`ot_Ref02`" => "ot_Ref02",
		"`Inventory`.`ot_Ref03`" => "ot_Ref03",
		"`Inventory`.`ot_Ref04`" => "ot_Ref04",
		"`Inventory`.`ot_Ref05`" => "ot_Ref05",
		"`Inventory`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Inventory`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Inventory`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Inventory`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Inventory`.`ot_ap_filed`,date_format(`Inventory`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Inventory`.`ot_ap_last_modified`,date_format(`Inventory`.`ot_ap_last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`Inventory` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Inventory`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Inventory`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Inventory`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "Inventory_view.php";
	$x->RedirectAfterInsert = "Inventory_view.php?SelectedID=#ID#";
	$x->TableTitle = "Asset Register";
	$x->TableIcon = "resources/table_icons/change_password.png";
	$x->PrimaryKey = "`Inventory`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 150, 70, 150, 150, 75, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Asset Register Number", "Name of Asset", "Type", "Manufacturer", "Equipment Condition", "Estimated Total Price", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('InventoryID', 'asset_title', 'fo_Type', 'fo_Manufacturer', 'fo_Condition', 'fo_UnitPrice', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_last_modified');
	$x->ColNumber  = array(2, 3, 5, 6, 9, 12, 32, 34, 36, 38, 39);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Inventory_templateTV.html';
	$x->SelectedTemplate = 'templates/Inventory_templateTVS.html';
	$x->TemplateDV = 'templates/Inventory_templateDV.html';
	$x->TemplateDVP = 'templates/Inventory_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Inventory`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Inventory' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Inventory`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Inventory' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Inventory`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Inventory_init
	$render=TRUE;
	if(function_exists('Inventory_init')){
		$args=array();
		$render=Inventory_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `Inventory`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('$', FORMAT(sum(`Inventory`.`fo_UnitPrice`), 2)) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)){
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Inventory-InventoryID"></td>';
			$sumRow .= '<td class="Inventory-asset_title"></td>';
			$sumRow .= '<td class="Inventory-fo_Type"></td>';
			$sumRow .= '<td class="Inventory-fo_Manufacturer"></td>';
			$sumRow .= '<td class="Inventory-fo_Condition"></td>';
			$sumRow .= "<td class=\"Inventory-fo_UnitPrice text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="Inventory-ot_ap_Review"></td>';
			$sumRow .= '<td class="Inventory-ot_ap_Approval"></td>';
			$sumRow .= '<td class="Inventory-ot_ap_QC"></td>';
			$sumRow .= '<td class="Inventory-ot_ap_filed"></td>';
			$sumRow .= '<td class="Inventory-ot_ap_last_modified"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Inventory_header
	$headerCode='';
	if(function_exists('Inventory_header')){
		$args=array();
		$headerCode=Inventory_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Inventory_footer
	$footerCode='';
	if(function_exists('Inventory_footer')){
		$args=array();
		$footerCode=Inventory_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>