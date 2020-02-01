<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/Leadership.php");
	include("$currDir/Leadership_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('Leadership');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "Leadership";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`Leadership`.`id`" => "id",
		"`Leadership`.`Status`" => "Status",
		"`Leadership`.`Description`" => "Description",
		"`Leadership`.`other_details`" => "other_details",
		"if(`Leadership`.`filed`,date_format(`Leadership`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`Leadership`.`last_modified`,date_format(`Leadership`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`Leadership`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => '`Leadership`.`filed`',
		6 => '`Leadership`.`last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`Leadership`.`id`" => "id",
		"`Leadership`.`Status`" => "Status",
		"`Leadership`.`Description`" => "Description",
		"`Leadership`.`other_details`" => "other_details",
		"if(`Leadership`.`filed`,date_format(`Leadership`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`Leadership`.`last_modified`,date_format(`Leadership`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`Leadership`.`id`" => "ID",
		"`Leadership`.`Status`" => "STATUS",
		"`Leadership`.`Description`" => "Description",
		"`Leadership`.`other_details`" => "Other details",
		"`Leadership`.`filed`" => "Filed",
		"`Leadership`.`last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`Leadership`.`id`" => "id",
		"`Leadership`.`Status`" => "Status",
		"`Leadership`.`Description`" => "Description",
		"`Leadership`.`other_details`" => "other_details",
		"if(`Leadership`.`filed`,date_format(`Leadership`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`Leadership`.`last_modified`,date_format(`Leadership`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`Leadership` ";
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
	$x->ScriptFileName = "Leadership_view.php";
	$x->RedirectAfterInsert = "Leadership_view.php?SelectedID=#ID#";
	$x->TableTitle = "Review & Verification";
	$x->TableIcon = "resources/table_icons/chart_organisation.png";
	$x->PrimaryKey = "`Leadership`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 150, 150);
	$x->ColCaption = array("STATUS", "Filed", "Last modified");
	$x->ColFieldName = array('Status', 'filed', 'last_modified');
	$x->ColNumber  = array(2, 5, 6);

	// template paths below are based on the app main directory
	$x->Template = 'templates/Leadership_templateTV.html';
	$x->SelectedTemplate = 'templates/Leadership_templateTVS.html';
	$x->TemplateDV = 'templates/Leadership_templateDV.html';
	$x->TemplateDVP = 'templates/Leadership_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Leadership`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Leadership' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `Leadership`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='Leadership' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`Leadership`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: Leadership_init
	$render=TRUE;
	if(function_exists('Leadership_init')){
		$args=array();
		$render=Leadership_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: Leadership_header
	$headerCode='';
	if(function_exists('Leadership_header')){
		$args=array();
		$headerCode=Leadership_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: Leadership_footer
	$footerCode='';
	if(function_exists('Leadership_footer')){
		$args=array();
		$footerCode=Leadership_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>