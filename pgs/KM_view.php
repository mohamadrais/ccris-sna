<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/KM.php");
	include("$currDir/KM_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('KM');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "KM";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`KM`.`id`" => "id",
		"`KM`.`DocumentName`" => "DocumentName",
		"`KM`.`fo_Description`" => "fo_Description",
		"`KM`.`fo_Reference`" => "fo_Reference",
		"`KM`.`fo_Volume`" => "fo_Volume",
		"`KM`.`fo_Classification`" => "fo_Classification",
		"`KM`.`fo_Class`" => "fo_Class",
		"if(`KM`.`fo_Regdate`,date_format(`KM`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`KM`.`ot_FileLoc`,3), MID(`KM`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`KM`.`ot_otherdetails`" => "ot_otherdetails",
		"`KM`.`ot_comments`" => "ot_comments",
		"`KM`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`KM`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`KM`.`ot_Ref01`" => "ot_Ref01",
		"`KM`.`ot_Ref02`" => "ot_Ref02",
		"`KM`.`ot_Ref03`" => "ot_Ref03",
		"`KM`.`ot_Ref04`" => "ot_Ref04",
		"`KM`.`ot_Ref05`" => "ot_Ref05",
		"`KM`.`ot_Ref06`" => "ot_Ref06",
		"`KM`.`ot_Photo01`" => "ot_Photo01",
		"`KM`.`ot_Photo02`" => "ot_Photo02",
		"`KM`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`KM`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`KM`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`KM`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`KM`.`ot_ap_filed`,date_format(`KM`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`KM`.`ot_ap_lastmodified`,date_format(`KM`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`KM`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`KM`.`fo_Regdate`',
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
		29 => '`KM`.`ot_ap_filed`',
		30 => '`KM`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`KM`.`id`" => "id",
		"`KM`.`DocumentName`" => "DocumentName",
		"`KM`.`fo_Description`" => "fo_Description",
		"`KM`.`fo_Reference`" => "fo_Reference",
		"`KM`.`fo_Volume`" => "fo_Volume",
		"`KM`.`fo_Classification`" => "fo_Classification",
		"`KM`.`fo_Class`" => "fo_Class",
		"if(`KM`.`fo_Regdate`,date_format(`KM`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`KM`.`ot_FileLoc`,3), MID(`KM`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`KM`.`ot_otherdetails`" => "ot_otherdetails",
		"`KM`.`ot_comments`" => "ot_comments",
		"`KM`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`KM`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`KM`.`ot_Ref01`" => "ot_Ref01",
		"`KM`.`ot_Ref02`" => "ot_Ref02",
		"`KM`.`ot_Ref03`" => "ot_Ref03",
		"`KM`.`ot_Ref04`" => "ot_Ref04",
		"`KM`.`ot_Ref05`" => "ot_Ref05",
		"`KM`.`ot_Ref06`" => "ot_Ref06",
		"`KM`.`ot_Photo01`" => "ot_Photo01",
		"`KM`.`ot_Photo02`" => "ot_Photo02",
		"`KM`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`KM`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`KM`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`KM`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`KM`.`ot_ap_filed`,date_format(`KM`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`KM`.`ot_ap_lastmodified`,date_format(`KM`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`KM`.`id`" => "ID",
		"`KM`.`DocumentName`" => "Document & Record Title",
		"`KM`.`fo_Description`" => "Description",
		"`KM`.`fo_Reference`" => "Source of References",
		"`KM`.`fo_Volume`" => "Volume/ Revision",
		"`KM`.`fo_Classification`" => "Type Document",
		"`KM`.`fo_Class`" => "Classification",
		"`KM`.`fo_Regdate`" => "Register date",
		"`KM`.`ot_FileLoc`" => "File Location & Number",
		"`KM`.`ot_otherdetails`" => "Other details",
		"`KM`.`ot_comments`" => "Comments",
		"`KM`.`ot_SharedLink1`" => "Shared Link 1",
		"`KM`.`ot_SharedLink2`" => "Shared Link 2",
		"`KM`.`ot_Ref01`" => "Reference_1",
		"`KM`.`ot_Ref02`" => "Reference_2",
		"`KM`.`ot_Ref03`" => "Reference_3",
		"`KM`.`ot_Ref04`" => "Reference_4",
		"`KM`.`ot_Ref05`" => "Reference_5",
		"`KM`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`KM`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`KM`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`KM`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`KM`.`ot_ap_filed`" => "Filed",
		"`KM`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`KM`.`id`" => "id",
		"`KM`.`DocumentName`" => "DocumentName",
		"`KM`.`fo_Description`" => "fo_Description",
		"`KM`.`fo_Reference`" => "fo_Reference",
		"`KM`.`fo_Volume`" => "fo_Volume",
		"`KM`.`fo_Classification`" => "fo_Classification",
		"`KM`.`fo_Class`" => "fo_Class",
		"if(`KM`.`fo_Regdate`,date_format(`KM`.`fo_Regdate`,'%m/%d/%Y'),'')" => "fo_Regdate",
		"CONCAT_WS('-', LEFT(`KM`.`ot_FileLoc`,3), MID(`KM`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`KM`.`ot_otherdetails`" => "ot_otherdetails",
		"`KM`.`ot_comments`" => "ot_comments",
		"`KM`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`KM`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`KM`.`ot_Ref01`" => "ot_Ref01",
		"`KM`.`ot_Ref02`" => "ot_Ref02",
		"`KM`.`ot_Ref03`" => "ot_Ref03",
		"`KM`.`ot_Ref04`" => "ot_Ref04",
		"`KM`.`ot_Ref05`" => "ot_Ref05",
		"`KM`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`KM`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`KM`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`KM`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`KM`.`ot_ap_filed`,date_format(`KM`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`KM`.`ot_ap_lastmodified`,date_format(`KM`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`KM` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`KM`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`KM`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`KM`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "KM_view.php";
	$x->RedirectAfterInsert = "KM_view.php";
	$x->TableTitle = "Organizational Knowledge";
	$x->TableIcon = "resources/table_icons/application_view_tile.png";
	$x->PrimaryKey = "`KM`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 120, 70, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Document & Record Title", "Source of References", "Volume/ Revision", "Type Document", "Classification", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('DocumentName', 'fo_Reference', 'fo_Volume', 'fo_Classification', 'fo_Class', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 4, 5, 6, 7, 23, 25, 27, 29, 30);

	// template paths below are based on the app main directory
	$x->Template = 'templates/KM_templateTV.html';
	$x->SelectedTemplate = 'templates/KM_templateTVS.html';
	$x->TemplateDV = 'templates/KM_templateDV.html';
	$x->TemplateDVP = 'templates/KM_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `KM`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='KM' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `KM`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='KM' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`KM`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: KM_init
	$render=TRUE;
	if(function_exists('KM_init')){
		$args=array();
		$render=KM_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: KM_header
	$headerCode='';
	if(function_exists('KM_header')){
		$args=array();
		$headerCode=KM_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: KM_footer
	$footerCode='';
	if(function_exists('KM_footer')){
		$args=array();
		$footerCode=KM_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>