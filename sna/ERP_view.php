<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/ERP.php");
	include("$currDir/ERP_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('ERP');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "ERP";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`ERP`.`id`" => "id",
		"`ERP`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`ERP`.`fo_DocItem`" => "fo_DocItem",
		"`ERP`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`ERP`.`fo_Classification`" => "fo_Classification",
		"`ERP`.`fo_Impact`" => "fo_Impact",
		"if(`ERP`.`fo_Registerdate`,date_format(`ERP`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`ERP`.`ot_FileLoc`,3), MID(`ERP`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ERP`.`ot_otherdetails`" => "ot_otherdetails",
		"`ERP`.`ot_comments`" => "ot_comments",
		"`ERP`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ERP`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ERP`.`ot_Location`" => "ot_Location",
		"`ERP`.`ot_Ref01`" => "ot_Ref01",
		"`ERP`.`ot_Ref02`" => "ot_Ref02",
		"`ERP`.`ot_Ref03`" => "ot_Ref03",
		"`ERP`.`ot_Ref04`" => "ot_Ref04",
		"`ERP`.`ot_Ref05`" => "ot_Ref05",
		"`ERP`.`ot_Ref06`" => "ot_Ref06",
		"`ERP`.`ot_Photo01`" => "ot_Photo01",
		"`ERP`.`ot_Photo02`" => "ot_Photo02",
		"`ERP`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ERP`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ERP`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ERP`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ERP`.`ot_ap_filed`,date_format(`ERP`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ERP`.`ot_ap_lastmodified`,date_format(`ERP`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`ERP`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => '`ERP`.`fo_Registerdate`',
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
		23 => 23,
		24 => '`Leadership1`.`Status`',
		25 => 25,
		26 => '`Approval1`.`Status`',
		27 => 27,
		28 => '`IMSControl1`.`Status`',
		29 => 29,
		30 => '`ERP`.`ot_ap_filed`',
		31 => '`ERP`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`ERP`.`id`" => "id",
		"`ERP`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`ERP`.`fo_DocItem`" => "fo_DocItem",
		"`ERP`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`ERP`.`fo_Classification`" => "fo_Classification",
		"`ERP`.`fo_Impact`" => "fo_Impact",
		"if(`ERP`.`fo_Registerdate`,date_format(`ERP`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`ERP`.`ot_FileLoc`,3), MID(`ERP`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ERP`.`ot_otherdetails`" => "ot_otherdetails",
		"`ERP`.`ot_comments`" => "ot_comments",
		"`ERP`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ERP`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ERP`.`ot_Location`" => "ot_Location",
		"`ERP`.`ot_Ref01`" => "ot_Ref01",
		"`ERP`.`ot_Ref02`" => "ot_Ref02",
		"`ERP`.`ot_Ref03`" => "ot_Ref03",
		"`ERP`.`ot_Ref04`" => "ot_Ref04",
		"`ERP`.`ot_Ref05`" => "ot_Ref05",
		"`ERP`.`ot_Ref06`" => "ot_Ref06",
		"`ERP`.`ot_Photo01`" => "ot_Photo01",
		"`ERP`.`ot_Photo02`" => "ot_Photo02",
		"`ERP`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ERP`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ERP`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ERP`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ERP`.`ot_ap_filed`,date_format(`ERP`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ERP`.`ot_ap_lastmodified`,date_format(`ERP`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`ERP`.`id`" => "ID",
		"`ERP`.`DocconNumber`" => "Emergency & Contigency Response ID",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "Work Location",
		"`ERP`.`fo_DocItem`" => "Title",
		"`ERP`.`fo_DocumentDescription`" => "Description",
		"`ERP`.`fo_Classification`" => "Classification",
		"`ERP`.`fo_Impact`" => "Direct Impact",
		"`ERP`.`fo_Registerdate`" => "Register date",
		"`ERP`.`ot_FileLoc`" => "File Location & Number",
		"`ERP`.`ot_otherdetails`" => "Other details",
		"`ERP`.`ot_comments`" => "Comments",
		"`ERP`.`ot_SharedLink1`" => "Shared Link 1",
		"`ERP`.`ot_SharedLink2`" => "Shared Link 2",
		"`ERP`.`ot_Location`" => "Location",
		"`ERP`.`ot_Ref01`" => "Reference_1",
		"`ERP`.`ot_Ref02`" => "Reference_2",
		"`ERP`.`ot_Ref03`" => "Reference_3",
		"`ERP`.`ot_Ref04`" => "Reference_4",
		"`ERP`.`ot_Ref05`" => "Reference_5",
		"`ERP`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`ERP`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`ERP`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`ERP`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`ERP`.`ot_ap_filed`" => "Register",
		"`ERP`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`ERP`.`id`" => "id",
		"`ERP`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, '::', `WorkLocation1`.`DocItem`), '') /* Work Location */" => "BaseLocation",
		"`ERP`.`fo_DocItem`" => "fo_DocItem",
		"`ERP`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`ERP`.`fo_Classification`" => "fo_Classification",
		"`ERP`.`fo_Impact`" => "fo_Impact",
		"if(`ERP`.`fo_Registerdate`,date_format(`ERP`.`fo_Registerdate`,'%m/%d/%Y'),'')" => "fo_Registerdate",
		"CONCAT_WS('-', LEFT(`ERP`.`ot_FileLoc`,3), MID(`ERP`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`ERP`.`ot_otherdetails`" => "ot_otherdetails",
		"`ERP`.`ot_comments`" => "ot_comments",
		"`ERP`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ERP`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ERP`.`ot_Location`" => "ot_Location",
		"`ERP`.`ot_Ref01`" => "ot_Ref01",
		"`ERP`.`ot_Ref02`" => "ot_Ref02",
		"`ERP`.`ot_Ref03`" => "ot_Ref03",
		"`ERP`.`ot_Ref04`" => "ot_Ref04",
		"`ERP`.`ot_Ref05`" => "ot_Ref05",
		"`ERP`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ERP`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ERP`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ERP`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`ERP`.`ot_ap_filed`,date_format(`ERP`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`ERP`.`ot_ap_lastmodified`,date_format(`ERP`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'BaseLocation' => 'Work Location', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`ERP` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`ERP`.`BaseLocation` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ERP`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ERP`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ERP`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "ERP_view.php";
	$x->RedirectAfterInsert = "ERP_view.php?SelectedID=#ID#";
	$x->TableTitle = "Emergency Preparedness & Response";
	$x->TableIcon = "resources/table_icons/delete.png";
	$x->PrimaryKey = "`ERP`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 200, 120, 70, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Emergency & Contigency Response ID", "Work Location", "Title", "Classification", "Direct Impact", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'BaseLocation', 'fo_DocItem', 'fo_Classification', 'fo_Impact', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 6, 7, 24, 26, 28, 30, 31);

	// template paths below are based on the app main directory
	$x->Template = 'templates/ERP_templateTV.html';
	$x->SelectedTemplate = 'templates/ERP_templateTVS.html';
	$x->TemplateDV = 'templates/ERP_templateDV.html';
	$x->TemplateDVP = 'templates/ERP_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ERP`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ERP' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ERP`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ERP' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`ERP`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ERP_init
	$render=TRUE;
	if(function_exists('ERP_init')){
		$args=array();
		$render=ERP_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: ERP_header
	$headerCode='';
	if(function_exists('ERP_header')){
		$args=array();
		$headerCode=ERP_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: ERP_footer
	$footerCode='';
	if(function_exists('ERP_footer')){
		$args=array();
		$footerCode=ERP_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>