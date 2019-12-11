<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/ContinualImprovement.php");
	include("$currDir/ContinualImprovement_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('ContinualImprovement');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "ContinualImprovement";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`ContinualImprovement`.`id`" => "id",
		"`ContinualImprovement`.`CAPARno`" => "CAPARno",
		"`ContinualImprovement`.`RecTitle`" => "RecTitle",
		"`ContinualImprovement`.`fo_Class`" => "fo_Class",
		"`ContinualImprovement`.`fo_CAPAR`" => "fo_CAPAR",
		"`ContinualImprovement`.`fo_Desc`" => "fo_Desc",
		"if(`ContinualImprovement`.`fo_Regdate`,date_format(`ContinualImprovement`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`ContinualImprovement`.`ot_FileLoc`,3), MID(`ContinualImprovement`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContinualImprovement`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContinualImprovement`.`ot_comments`" => "ot_comments",
		"`ContinualImprovement`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContinualImprovement`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContinualImprovement`.`ot_Ref01`" => "ot_Ref01",
		"`ContinualImprovement`.`ot_Ref02`" => "ot_Ref02",
		"`ContinualImprovement`.`ot_Ref03`" => "ot_Ref03",
		"`ContinualImprovement`.`ot_Ref04`" => "ot_Ref04",
		"`ContinualImprovement`.`ot_Ref05`" => "ot_Ref05",
		"`ContinualImprovement`.`ot_Ref06`" => "ot_Ref06",
		"`ContinualImprovement`.`ot_Photo01`" => "ot_Photo01",
		"`ContinualImprovement`.`ot_Photo02`" => "ot_Photo02",
		"`ContinualImprovement`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContinualImprovement`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContinualImprovement`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContinualImprovement`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ContinualImprovement`.`ot_ap_filed`,date_format(`ContinualImprovement`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ContinualImprovement`.`ot_ap_lastmodified`,date_format(`ContinualImprovement`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`ContinualImprovement`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`ContinualImprovement`.`fo_Regdate`',
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
		22 => '`Leadership1`.`Status`',
		23 => 23,
		24 => '`Approval1`.`Status`',
		25 => 25,
		26 => '`IMSControl1`.`Status`',
		27 => 27,
		28 => '`ContinualImprovement`.`ot_ap_filed`',
		29 => '`ContinualImprovement`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`ContinualImprovement`.`id`" => "id",
		"`ContinualImprovement`.`CAPARno`" => "CAPARno",
		"`ContinualImprovement`.`RecTitle`" => "RecTitle",
		"`ContinualImprovement`.`fo_Class`" => "fo_Class",
		"`ContinualImprovement`.`fo_CAPAR`" => "fo_CAPAR",
		"`ContinualImprovement`.`fo_Desc`" => "fo_Desc",
		"if(`ContinualImprovement`.`fo_Regdate`,date_format(`ContinualImprovement`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`ContinualImprovement`.`ot_FileLoc`,3), MID(`ContinualImprovement`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContinualImprovement`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContinualImprovement`.`ot_comments`" => "ot_comments",
		"`ContinualImprovement`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContinualImprovement`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContinualImprovement`.`ot_Ref01`" => "ot_Ref01",
		"`ContinualImprovement`.`ot_Ref02`" => "ot_Ref02",
		"`ContinualImprovement`.`ot_Ref03`" => "ot_Ref03",
		"`ContinualImprovement`.`ot_Ref04`" => "ot_Ref04",
		"`ContinualImprovement`.`ot_Ref05`" => "ot_Ref05",
		"`ContinualImprovement`.`ot_Ref06`" => "ot_Ref06",
		"`ContinualImprovement`.`ot_Photo01`" => "ot_Photo01",
		"`ContinualImprovement`.`ot_Photo02`" => "ot_Photo02",
		"`ContinualImprovement`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContinualImprovement`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContinualImprovement`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContinualImprovement`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ContinualImprovement`.`ot_ap_filed`,date_format(`ContinualImprovement`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ContinualImprovement`.`ot_ap_lastmodified`,date_format(`ContinualImprovement`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`ContinualImprovement`.`id`" => "ID",
		"`ContinualImprovement`.`CAPARno`" => "CAPAR ID",
		"`ContinualImprovement`.`RecTitle`" => "Title",
		"`ContinualImprovement`.`fo_Class`" => "Focus of CAPAR",
		"`ContinualImprovement`.`fo_CAPAR`" => "CAPAR",
		"`ContinualImprovement`.`fo_Desc`" => "Description",
		"`ContinualImprovement`.`fo_Regdate`" => "Register date",
		"`ContinualImprovement`.`ot_FileLoc`" => "File Location & Number",
		"`ContinualImprovement`.`ot_otherdetails`" => "Other details",
		"`ContinualImprovement`.`ot_comments`" => "Comments",
		"`ContinualImprovement`.`ot_SharedLink1`" => "Shared Link 1",
		"`ContinualImprovement`.`ot_SharedLink2`" => "Shared Link 2",
		"`ContinualImprovement`.`ot_Ref01`" => "Reference_1",
		"`ContinualImprovement`.`ot_Ref02`" => "Reference_2",
		"`ContinualImprovement`.`ot_Ref03`" => "Reference_3",
		"`ContinualImprovement`.`ot_Ref04`" => "Reference_4",
		"`ContinualImprovement`.`ot_Ref05`" => "Reference_5",
		"`ContinualImprovement`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`ContinualImprovement`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`ContinualImprovement`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`ContinualImprovement`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`ContinualImprovement`.`ot_ap_filed`" => "Filed",
		"`ContinualImprovement`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`ContinualImprovement`.`id`" => "id",
		"`ContinualImprovement`.`CAPARno`" => "CAPARno",
		"`ContinualImprovement`.`RecTitle`" => "RecTitle",
		"`ContinualImprovement`.`fo_Class`" => "fo_Class",
		"`ContinualImprovement`.`fo_CAPAR`" => "fo_CAPAR",
		"`ContinualImprovement`.`fo_Desc`" => "fo_Desc",
		"if(`ContinualImprovement`.`fo_Regdate`,date_format(`ContinualImprovement`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`ContinualImprovement`.`ot_FileLoc`,3), MID(`ContinualImprovement`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ContinualImprovement`.`ot_otherdetails`" => "ot_otherdetails",
		"`ContinualImprovement`.`ot_comments`" => "ot_comments",
		"`ContinualImprovement`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ContinualImprovement`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ContinualImprovement`.`ot_Ref01`" => "ot_Ref01",
		"`ContinualImprovement`.`ot_Ref02`" => "ot_Ref02",
		"`ContinualImprovement`.`ot_Ref03`" => "ot_Ref03",
		"`ContinualImprovement`.`ot_Ref04`" => "ot_Ref04",
		"`ContinualImprovement`.`ot_Ref05`" => "ot_Ref05",
		"`ContinualImprovement`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ContinualImprovement`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ContinualImprovement`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ContinualImprovement`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ContinualImprovement`.`ot_ap_filed`,date_format(`ContinualImprovement`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ContinualImprovement`.`ot_ap_lastmodified`,date_format(`ContinualImprovement`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`ContinualImprovement` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ContinualImprovement`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ContinualImprovement`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ContinualImprovement`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "ContinualImprovement_view.php";
	$x->RedirectAfterInsert = "ContinualImprovement_view.php?SelectedID=#ID#";
	$x->TableTitle = "CAPAR";
	$x->TableIcon = "resources/table_icons/finance.png";
	$x->PrimaryKey = "`ContinualImprovement`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 150, 70, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("CAPAR ID", "Title", "Focus of CAPAR", "CAPAR", "Register date", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('CAPARno', 'RecTitle', 'fo_Class', 'fo_CAPAR', 'fo_Regdate', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 5, 7, 22, 24, 26, 28, 29);

	// template paths below are based on the app main directory
	$x->Template = 'templates/ContinualImprovement_templateTV.html';
	$x->SelectedTemplate = 'templates/ContinualImprovement_templateTVS.html';
	$x->TemplateDV = 'templates/ContinualImprovement_templateDV.html';
	$x->TemplateDVP = 'templates/ContinualImprovement_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ContinualImprovement`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ContinualImprovement' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ContinualImprovement`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ContinualImprovement' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`ContinualImprovement`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ContinualImprovement_init
	$render=TRUE;
	if(function_exists('ContinualImprovement_init')){
		$args=array();
		$render=ContinualImprovement_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: ContinualImprovement_header
	$headerCode='';
	if(function_exists('ContinualImprovement_header')){
		$args=array();
		$headerCode=ContinualImprovement_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: ContinualImprovement_footer
	$footerCode='';
	if(function_exists('ContinualImprovement_footer')){
		$args=array();
		$footerCode=ContinualImprovement_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>