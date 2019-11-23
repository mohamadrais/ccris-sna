<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Receivables.php");
	include("$currDir/Receivables_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Receivables');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Receivables";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Receivables`.`id`" => "id",
		"`Receivables`.`ClaimNo`" => "ClaimNo",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "ProjectsID",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "ResourcesID",
		"`Receivables`.`fo_Classification`" => "fo_Classification",
		"`Receivables`.`fo_DocItem`" => "fo_DocItem",
		"CONCAT('$', FORMAT(`Receivables`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Receivables`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`Receivables`.`fo_Registerdate`,date_format(`Receivables`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`Receivables`.`ot_FileLoc`,3), MID(`Receivables`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Receivables`.`ot_otherdetails`" => "ot_otherdetails",
		"`Receivables`.`ot_comments`" => "ot_comments",
		"`Receivables`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Receivables`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Receivables`.`ot_Ref01`" => "ot_Ref01",
		"`Receivables`.`ot_Ref02`" => "ot_Ref02",
		"`Receivables`.`ot_Ref03`" => "ot_Ref03",
		"`Receivables`.`ot_Ref04`" => "ot_Ref04",
		"`Receivables`.`ot_Ref05`" => "ot_Ref05",
		"`Receivables`.`ot_Ref06`" => "ot_Ref06",
		"`Receivables`.`ot_Photo01`" => "ot_Photo01",
		"`Receivables`.`ot_Photo02`" => "ot_Photo02",
		"`Receivables`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Receivables`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Receivables`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Receivables`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Receivables`.`ot_ap_filed`,date_format(`Receivables`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Receivables`.`ot_ap_lastmodified`,date_format(`Receivables`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Receivables`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`Receivables`.`fo_UnitPrice`',
		8 => 8,
		9 => '`Receivables`.`fo_Registerdate`',
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
		24 => '`Leadership1`.`Status`',
		25 => 25,
		26 => '`Approval1`.`Status`',
		27 => 27,
		28 => '`IMSControl1`.`Status`',
		29 => 29,
		30 => '`Receivables`.`ot_ap_filed`',
		31 => '`Receivables`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Receivables`.`id`" => "id",
		"`Receivables`.`ClaimNo`" => "ClaimNo",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "ProjectsID",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "ResourcesID",
		"`Receivables`.`fo_Classification`" => "fo_Classification",
		"`Receivables`.`fo_DocItem`" => "fo_DocItem",
		"CONCAT('$', FORMAT(`Receivables`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Receivables`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`Receivables`.`fo_Registerdate`,date_format(`Receivables`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`Receivables`.`ot_FileLoc`,3), MID(`Receivables`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Receivables`.`ot_otherdetails`" => "ot_otherdetails",
		"`Receivables`.`ot_comments`" => "ot_comments",
		"`Receivables`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Receivables`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Receivables`.`ot_Ref01`" => "ot_Ref01",
		"`Receivables`.`ot_Ref02`" => "ot_Ref02",
		"`Receivables`.`ot_Ref03`" => "ot_Ref03",
		"`Receivables`.`ot_Ref04`" => "ot_Ref04",
		"`Receivables`.`ot_Ref05`" => "ot_Ref05",
		"`Receivables`.`ot_Ref06`" => "ot_Ref06",
		"`Receivables`.`ot_Photo01`" => "ot_Photo01",
		"`Receivables`.`ot_Photo02`" => "ot_Photo02",
		"`Receivables`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Receivables`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Receivables`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Receivables`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Receivables`.`ot_ap_filed`,date_format(`Receivables`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Receivables`.`ot_ap_lastmodified`,date_format(`Receivables`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Receivables`.`id`" => "ID",
		"`Receivables`.`ClaimNo`" => "Record ID",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "Project ID",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "Resources ID",
		"`Receivables`.`fo_Classification`" => "Receivables Classification",
		"`Receivables`.`fo_DocItem`" => "Title",
		"`Receivables`.`fo_UnitPrice`" => "Lump Sum Amount",
		"`Receivables`.`fo_DocumentDescription`" => "Description",
		"`Receivables`.`fo_Registerdate`" => "Register date",
		"`Receivables`.`ot_FileLoc`" => "File Location & Number",
		"`Receivables`.`ot_otherdetails`" => "Other details",
		"`Receivables`.`ot_comments`" => "Comments",
		"`Receivables`.`ot_SharedLink1`" => "Shared Link 1",
		"`Receivables`.`ot_SharedLink2`" => "Shared Link 2",
		"`Receivables`.`ot_Ref01`" => "Reference_1",
		"`Receivables`.`ot_Ref02`" => "Reference_2",
		"`Receivables`.`ot_Ref03`" => "Reference_3",
		"`Receivables`.`ot_Ref04`" => "Reference_4",
		"`Receivables`.`ot_Ref05`" => "Reference_5",
		"`Receivables`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`Receivables`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`Receivables`.`ot_ap_ApprComment`" => "Obstetric history",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`Receivables`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`Receivables`.`ot_ap_filed`" => "Filed",
		"`Receivables`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Receivables`.`id`" => "id",
		"`Receivables`.`ClaimNo`" => "ClaimNo",
		"IF(    CHAR_LENGTH(`projects1`.`projectID`) || CHAR_LENGTH(`projects1`.`Name`), CONCAT_WS('',   `projects1`.`projectID`, '::', `projects1`.`Name`), '') /* Project ID */" => "ProjectsID",
		"IF(    CHAR_LENGTH(`resources1`.`ResourcesID`) || CHAR_LENGTH(`resources1`.`Name`), CONCAT_WS('',   `resources1`.`ResourcesID`, '::', `resources1`.`Name`), '') /* Resources ID */" => "ResourcesID",
		"`Receivables`.`fo_Classification`" => "fo_Classification",
		"`Receivables`.`fo_DocItem`" => "fo_DocItem",
		"CONCAT('$', FORMAT(`Receivables`.`fo_UnitPrice`, 2))" => "fo_UnitPrice",
		"`Receivables`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"if(`Receivables`.`fo_Registerdate`,date_format(`Receivables`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`Receivables`.`ot_FileLoc`,3), MID(`Receivables`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`Receivables`.`ot_otherdetails`" => "ot_otherdetails",
		"`Receivables`.`ot_comments`" => "ot_comments",
		"`Receivables`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`Receivables`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`Receivables`.`ot_Ref01`" => "ot_Ref01",
		"`Receivables`.`ot_Ref02`" => "ot_Ref02",
		"`Receivables`.`ot_Ref03`" => "ot_Ref03",
		"`Receivables`.`ot_Ref04`" => "ot_Ref04",
		"`Receivables`.`ot_Ref05`" => "ot_Ref05",
		"`Receivables`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`Receivables`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`Receivables`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`Receivables`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`Receivables`.`ot_ap_filed`,date_format(`Receivables`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`Receivables`.`ot_ap_lastmodified`,date_format(`Receivables`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ProjectsID' => 'Project ID', 'ResourcesID' => 'Resources ID', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`Receivables` LEFT JOIN `projects` as projects1 ON `projects1`.`Id`=`Receivables`.`ProjectsID` LEFT JOIN `resources` as resources1 ON `resources1`.`Id`=`Receivables`.`ResourcesID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`Receivables`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`Receivables`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`Receivables`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "Receivables_view.php";
	$x->RedirectAfterInsert = "Receivables_view.php?SelectedID=#ID#";
	$x->TableTitle = "Project Receivables";
	$x->TableIcon = "resources/table_icons/ehow.png";
	$x->PrimaryKey = "`Receivables`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 120, 70, 150, 75, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Project ID", "Resources ID", "Receivables Classification", "Lump Sum Amount", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('ClaimNo', 'ProjectsID', 'ResourcesID', 'fo_Classification', 'fo_UnitPrice', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 24, 26, 28, 30, 31);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Receivables_templateTV.html';
	$x->SelectedTemplate = 'templates/Receivables_templateTVS.html';
	$x->TemplateDV = 'templates/Receivables_templateDV.html';
	$x->TemplateDVP = 'templates/Receivables_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Receivables`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Receivables' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Receivables`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Receivables' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Receivables`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Receivables_init
	$render=TRUE;
	if(function_exists('Receivables_init')){
		$args=array();
		$render=Receivables_init($x, getMemberInfo(), $args);
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
				$QueryWhere = 'where `Receivables`.`id` in ('.substr($QueryWhere, 0, -1).')';
			}else{ // if no selected records, write the where clause to return an empty result
				$QueryWhere = 'where 1=0';
			}
		}else{
			$QueryWhere = $x->QueryWhere;
		}

		$sumQuery = "select CONCAT('$', FORMAT(sum(`Receivables`.`fo_UnitPrice`), 2)) from {$x->QueryFrom} {$QueryWhere}";
		$res = sql($sumQuery, $eo);
		if($row = db_fetch_row($res)){
			$sumRow = '<tr class="success">';
			if(!isset($_REQUEST['Print_x'])) $sumRow .= '<td class="text-center"><strong>&sum;</strong></td>';
			$sumRow .= '<td class="Receivables-ClaimNo"></td>';
			$sumRow .= '<td class="Receivables-ProjectsID"></td>';
			$sumRow .= '<td class="Receivables-ResourcesID"></td>';
			$sumRow .= '<td class="Receivables-fo_Classification"></td>';
			$sumRow .= "<td class=\"Receivables-fo_UnitPrice text-right\">{$row[0]}</td>";
			$sumRow .= '<td class="Receivables-ot_ap_Review"></td>';
			$sumRow .= '<td class="Receivables-ot_ap_Approval"></td>';
			$sumRow .= '<td class="Receivables-ot_ap_QC"></td>';
			$sumRow .= '<td class="Receivables-ot_ap_filed"></td>';
			$sumRow .= '<td class="Receivables-ot_ap_lastmodified"></td>';
			$sumRow .= '</tr>';

			$x->HTML = str_replace('<!-- tv data below -->', '', $x->HTML);
			$x->HTML = str_replace('<!-- tv data above -->', $sumRow, $x->HTML);
		}
	}

	// hook: Receivables_header
	$headerCode='';
	if(function_exists('Receivables_header')){
		$args=array();
		$headerCode=Receivables_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Receivables_footer
	$footerCode='';
	if(function_exists('Receivables_footer')){
		$args=array();
		$footerCode=Receivables_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>