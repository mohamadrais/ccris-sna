<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/TeamSoftBoard.php");
	include("$currDir/TeamSoftBoard_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('TeamSoftBoard');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "TeamSoftBoard";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`TeamSoftBoard`.`Postid`" => "Postid",
		"`TeamSoftBoard`.`Title`" => "Title",
		"`TeamSoftBoard`.`image01`" => "image01",
		"`TeamSoftBoard`.`image02`" => "image02",
		"`TeamSoftBoard`.`image03`" => "image03",
		"`TeamSoftBoard`.`TextPost`" => "TextPost",
		"`TeamSoftBoard`.`website`" => "website",
		"`TeamSoftBoard`.`Ref01`" => "Ref01",
		"`TeamSoftBoard`.`Ref02`" => "Ref02",
		"`TeamSoftBoard`.`Ref03`" => "Ref03",
		"`TeamSoftBoard`.`Ref04`" => "Ref04",
		"`TeamSoftBoard`.`Ref05`" => "Ref05",
		"`TeamSoftBoard`.`Ref06`" => "Ref06",
		"if(`TeamSoftBoard`.`filed`,date_format(`TeamSoftBoard`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`TeamSoftBoard`.`last_modified`,date_format(`TeamSoftBoard`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`TeamSoftBoard`.`Postid`',
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
		12 => 12,
		13 => 13,
		14 => '`TeamSoftBoard`.`filed`',
		15 => '`TeamSoftBoard`.`last_modified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`TeamSoftBoard`.`Postid`" => "Postid",
		"`TeamSoftBoard`.`Title`" => "Title",
		"`TeamSoftBoard`.`image01`" => "image01",
		"`TeamSoftBoard`.`image02`" => "image02",
		"`TeamSoftBoard`.`image03`" => "image03",
		"`TeamSoftBoard`.`TextPost`" => "TextPost",
		"`TeamSoftBoard`.`website`" => "website",
		"`TeamSoftBoard`.`Ref01`" => "Ref01",
		"`TeamSoftBoard`.`Ref02`" => "Ref02",
		"`TeamSoftBoard`.`Ref03`" => "Ref03",
		"`TeamSoftBoard`.`Ref04`" => "Ref04",
		"`TeamSoftBoard`.`Ref05`" => "Ref05",
		"`TeamSoftBoard`.`Ref06`" => "Ref06",
		"if(`TeamSoftBoard`.`filed`,date_format(`TeamSoftBoard`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`TeamSoftBoard`.`last_modified`,date_format(`TeamSoftBoard`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`TeamSoftBoard`.`Postid`" => "ID",
		"`TeamSoftBoard`.`Title`" => "Post Title",
		"`TeamSoftBoard`.`TextPost`" => "Detail Posting",
		"`TeamSoftBoard`.`website`" => "Shared Link",
		"`TeamSoftBoard`.`Ref01`" => "Reference Item 1",
		"`TeamSoftBoard`.`Ref02`" => "Reference Item 2",
		"`TeamSoftBoard`.`Ref03`" => "Reference Item 3",
		"`TeamSoftBoard`.`Ref04`" => "Reference Item 4",
		"`TeamSoftBoard`.`Ref05`" => "Reference Item 5",
		"`TeamSoftBoard`.`Ref06`" => "Reference Item 6",
		"`TeamSoftBoard`.`filed`" => "Posting Date",
		"`TeamSoftBoard`.`last_modified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`TeamSoftBoard`.`Postid`" => "Postid",
		"`TeamSoftBoard`.`Title`" => "Title",
		"`TeamSoftBoard`.`TextPost`" => "TextPost",
		"`TeamSoftBoard`.`website`" => "website",
		"`TeamSoftBoard`.`Ref01`" => "Ref01",
		"`TeamSoftBoard`.`Ref02`" => "Ref02",
		"`TeamSoftBoard`.`Ref03`" => "Ref03",
		"`TeamSoftBoard`.`Ref04`" => "Ref04",
		"`TeamSoftBoard`.`Ref05`" => "Ref05",
		"`TeamSoftBoard`.`Ref06`" => "Ref06",
		"if(`TeamSoftBoard`.`filed`,date_format(`TeamSoftBoard`.`filed`,'%m/%d/%Y %h:%i %p'),'')" => "filed",
		"if(`TeamSoftBoard`.`last_modified`,date_format(`TeamSoftBoard`.`last_modified`,'%m/%d/%Y %h:%i %p'),'')" => "last_modified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`TeamSoftBoard` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 0;
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
	$x->ScriptFileName = "TeamSoftBoard_view.php";
	$x->RedirectAfterInsert = "TeamSoftBoard_view.php?SelectedID=#ID#";
	$x->TableTitle = "Organization Softboard";
	$x->TableIcon = "resources/table_icons/group_link.png";
	$x->PrimaryKey = "`TeamSoftBoard`.`Postid`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Post Title", "Image_1", "Image_2", "Image_3", "Posting Date", "Last modified");
	$x->ColFieldName = array('Title', 'image01', 'image02', 'image03', 'filed', 'last_modified');
	$x->ColNumber  = array(2, 3, 4, 5, 14, 15);

	// template paths below are based on the app main directory
	$x->Template = 'templates/TeamSoftBoard_templateTV.html';
	$x->SelectedTemplate = 'templates/TeamSoftBoard_templateTVS.html';
	$x->TemplateDV = 'templates/TeamSoftBoard_templateDV.html';
	$x->TemplateDVP = 'templates/TeamSoftBoard_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "col-lg-6";
	$x->DVClasses = "col-lg-6";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `TeamSoftBoard`.`Postid`=membership_userrecords.pkValue and membership_userrecords.tableName='TeamSoftBoard' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `TeamSoftBoard`.`Postid`=membership_userrecords.pkValue and membership_userrecords.tableName='TeamSoftBoard' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`TeamSoftBoard`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: TeamSoftBoard_init
	$render=TRUE;
	if(function_exists('TeamSoftBoard_init')){
		$args=array();
		$render=TeamSoftBoard_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: TeamSoftBoard_header
	$headerCode='';
	if(function_exists('TeamSoftBoard_header')){
		$args=array();
		$headerCode=TeamSoftBoard_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: TeamSoftBoard_footer
	$footerCode='';
	if(function_exists('TeamSoftBoard_footer')){
		$args=array();
		$footerCode=TeamSoftBoard_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>