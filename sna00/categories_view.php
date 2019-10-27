<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/categories.php");
	include("$currDir/categories_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('categories');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "categories";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`fo_Description`" => "fo_Description",
		"CONCAT_WS('-', LEFT(`categories`.`ot_FileLoc`,3), MID(`categories`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`categories`.`ot_otherdetails`" => "ot_otherdetails",
		"`categories`.`ot_comments`" => "ot_comments",
		"`categories`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`categories`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`categories`.`ot_Ref01`" => "ot_Ref01",
		"`categories`.`ot_Ref02`" => "ot_Ref02",
		"`categories`.`ot_Picture`" => "ot_Picture",
		"DATE_FORMAT(`categories`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`categories`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`categories`.`CategoryID`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => '`categories`.`ot_ap_filed`',
		13 => '`categories`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`fo_Description`" => "fo_Description",
		"CONCAT_WS('-', LEFT(`categories`.`ot_FileLoc`,3), MID(`categories`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`categories`.`ot_otherdetails`" => "ot_otherdetails",
		"`categories`.`ot_comments`" => "ot_comments",
		"`categories`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`categories`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`categories`.`ot_Ref01`" => "ot_Ref01",
		"`categories`.`ot_Ref02`" => "ot_Ref02",
		"`categories`.`ot_Picture`" => "ot_Picture",
		"DATE_FORMAT(`categories`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`categories`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`categories`.`CategoryID`" => "Category ID",
		"`categories`.`CategoryName`" => "Category Name",
		"`categories`.`fo_Description`" => "Description",
		"`categories`.`ot_FileLoc`" => "File Location & Number",
		"`categories`.`ot_otherdetails`" => "Other details",
		"`categories`.`ot_comments`" => "Comments",
		"`categories`.`ot_SharedLink1`" => "Shared Link 1",
		"`categories`.`ot_SharedLink2`" => "Shared Link 2",
		"`categories`.`ot_Ref01`" => "Reference_1",
		"`categories`.`ot_Ref02`" => "Reference_2",
		"`categories`.`ot_ap_filed`" => "Filed",
		"`categories`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`categories`.`CategoryID`" => "CategoryID",
		"`categories`.`CategoryName`" => "CategoryName",
		"`categories`.`fo_Description`" => "fo_Description",
		"CONCAT_WS('-', LEFT(`categories`.`ot_FileLoc`,3), MID(`categories`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`categories`.`ot_otherdetails`" => "ot_otherdetails",
		"`categories`.`ot_comments`" => "ot_comments",
		"`categories`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`categories`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`categories`.`ot_Ref01`" => "ot_Ref01",
		"`categories`.`ot_Ref02`" => "ot_Ref02",
		"DATE_FORMAT(`categories`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`categories`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`categories` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 0;
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
	$x->ScriptFileName = "categories_view.php";
	$x->RedirectAfterInsert = "categories_view.php?SelectedID=#ID#";
	$x->TableTitle = "Item Categories";
	$x->TableIcon = "resources/table_icons/award_star_bronze_1.png";
	$x->PrimaryKey = "`categories`.`CategoryID`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  150, 75, 150, 150);
	$x->ColCaption = array("Category Name", "Picture", "Filed", "Last modified");
	$x->ColFieldName = array('CategoryName', 'ot_Picture', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 11, 12, 13);

	// template paths below are based on the app main directory
	$x->Template = 'templates/categories_templateTV.html';
	$x->SelectedTemplate = 'templates/categories_templateTVS.html';
	$x->TemplateDV = 'templates/categories_templateDV.html';
	$x->TemplateDVP = 'templates/categories_templateDVP.html';

	$x->ShowTableHeader = 0;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "col-lg-6";
	$x->DVClasses = "col-lg-6";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `categories`.`CategoryID`=membership_userrecords.pkValue and membership_userrecords.tableName='categories' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `categories`.`CategoryID`=membership_userrecords.pkValue and membership_userrecords.tableName='categories' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`categories`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: categories_init
	$render=TRUE;
	if(function_exists('categories_init')){
		$args=array();
		$render=categories_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: categories_header
	$headerCode='';
	if(function_exists('categories_header')){
		$args=array();
		$headerCode=categories_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: categories_footer
	$footerCode='';
	if(function_exists('categories_footer')){
		$args=array();
		$footerCode=categories_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>