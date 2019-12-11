<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/InOutRegister.php");
	include("$currDir/InOutRegister_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('InOutRegister');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "InOutRegister";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`InOutRegister`.`id`" => "id",
		"`InOutRegister`.`RecordNumber`" => "RecordNumber",
		"`InOutRegister`.`DocItem`" => "DocItem",
		"`InOutRegister`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`InOutRegister`.`fo_Classification`" => "fo_Classification",
		"if(`InOutRegister`.`fo_Delivdate`,date_format(`InOutRegister`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"CONCAT_WS('-', LEFT(`InOutRegister`.`ot_FileLoc`,3), MID(`InOutRegister`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`InOutRegister`.`ot_otherdetails`" => "ot_otherdetails",
		"`InOutRegister`.`ot_comments`" => "ot_comments",
		"`InOutRegister`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`InOutRegister`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`InOutRegister`.`ot_Ref01`" => "ot_Ref01",
		"`InOutRegister`.`ot_Ref02`" => "ot_Ref02",
		"`InOutRegister`.`ot_Ref03`" => "ot_Ref03",
		"`InOutRegister`.`ot_Ref04`" => "ot_Ref04",
		"`InOutRegister`.`ot_Ref05`" => "ot_Ref05",
		"`InOutRegister`.`ot_Ref06`" => "ot_Ref06",
		"`InOutRegister`.`ot_Photo01`" => "ot_Photo01",
		"`InOutRegister`.`ot_Photo02`" => "ot_Photo02",
		"`InOutRegister`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`InOutRegister`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`InOutRegister`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`InOutRegister`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`InOutRegister`.`ot_ap_filed`,date_format(`InOutRegister`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`InOutRegister`.`ot_ap_lastmodified`,date_format(`InOutRegister`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`InOutRegister`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => '`InOutRegister`.`fo_Delivdate`',
		7 => 7,
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
		21 => '`Leadership1`.`Status`',
		22 => 22,
		23 => '`Approval1`.`Status`',
		24 => 24,
		25 => '`IMSControl1`.`Status`',
		26 => 26,
		27 => '`InOutRegister`.`ot_ap_filed`',
		28 => '`InOutRegister`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`InOutRegister`.`id`" => "id",
		"`InOutRegister`.`RecordNumber`" => "RecordNumber",
		"`InOutRegister`.`DocItem`" => "DocItem",
		"`InOutRegister`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`InOutRegister`.`fo_Classification`" => "fo_Classification",
		"if(`InOutRegister`.`fo_Delivdate`,date_format(`InOutRegister`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"CONCAT_WS('-', LEFT(`InOutRegister`.`ot_FileLoc`,3), MID(`InOutRegister`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`InOutRegister`.`ot_otherdetails`" => "ot_otherdetails",
		"`InOutRegister`.`ot_comments`" => "ot_comments",
		"`InOutRegister`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`InOutRegister`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`InOutRegister`.`ot_Ref01`" => "ot_Ref01",
		"`InOutRegister`.`ot_Ref02`" => "ot_Ref02",
		"`InOutRegister`.`ot_Ref03`" => "ot_Ref03",
		"`InOutRegister`.`ot_Ref04`" => "ot_Ref04",
		"`InOutRegister`.`ot_Ref05`" => "ot_Ref05",
		"`InOutRegister`.`ot_Ref06`" => "ot_Ref06",
		"`InOutRegister`.`ot_Photo01`" => "ot_Photo01",
		"`InOutRegister`.`ot_Photo02`" => "ot_Photo02",
		"`InOutRegister`.`ot_Photo03`" => "ot_Photo03",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`InOutRegister`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`InOutRegister`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`InOutRegister`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`InOutRegister`.`ot_ap_filed`,date_format(`InOutRegister`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`InOutRegister`.`ot_ap_lastmodified`,date_format(`InOutRegister`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`InOutRegister`.`id`" => "ID",
		"`InOutRegister`.`RecordNumber`" => "Record ID",
		"`InOutRegister`.`DocItem`" => "Title",
		"`InOutRegister`.`fo_DocumentDescription`" => "Description",
		"`InOutRegister`.`fo_Classification`" => "Classification",
		"`InOutRegister`.`fo_Delivdate`" => "Send/Receive date",
		"`InOutRegister`.`ot_FileLoc`" => "File Location & Number",
		"`InOutRegister`.`ot_otherdetails`" => "Other details",
		"`InOutRegister`.`ot_comments`" => "Comments",
		"`InOutRegister`.`ot_SharedLink1`" => "Shared Link 1",
		"`InOutRegister`.`ot_SharedLink2`" => "Shared Link 2",
		"`InOutRegister`.`ot_Ref01`" => "Reference_1",
		"`InOutRegister`.`ot_Ref02`" => "Reference_2",
		"`InOutRegister`.`ot_Ref03`" => "Reference_3",
		"`InOutRegister`.`ot_Ref04`" => "Reference_4",
		"`InOutRegister`.`ot_Ref05`" => "Reference_5",
		"`InOutRegister`.`ot_Ref06`" => "Reference_6",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`InOutRegister`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`InOutRegister`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`InOutRegister`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`InOutRegister`.`ot_ap_filed`" => "Register",
		"`InOutRegister`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`InOutRegister`.`id`" => "id",
		"`InOutRegister`.`RecordNumber`" => "RecordNumber",
		"`InOutRegister`.`DocItem`" => "DocItem",
		"`InOutRegister`.`fo_DocumentDescription`" => "fo_DocumentDescription",
		"`InOutRegister`.`fo_Classification`" => "fo_Classification",
		"if(`InOutRegister`.`fo_Delivdate`,date_format(`InOutRegister`.`fo_Delivdate`,'%m/%d/%Y'),'')" => "fo_Delivdate",
		"CONCAT_WS('-', LEFT(`InOutRegister`.`ot_FileLoc`,3), MID(`InOutRegister`.`ot_FileLoc`,4,3))" => "ot_FileLoc",
		"`InOutRegister`.`ot_otherdetails`" => "ot_otherdetails",
		"`InOutRegister`.`ot_comments`" => "ot_comments",
		"`InOutRegister`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`InOutRegister`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`InOutRegister`.`ot_Ref01`" => "ot_Ref01",
		"`InOutRegister`.`ot_Ref02`" => "ot_Ref02",
		"`InOutRegister`.`ot_Ref03`" => "ot_Ref03",
		"`InOutRegister`.`ot_Ref04`" => "ot_Ref04",
		"`InOutRegister`.`ot_Ref05`" => "ot_Ref05",
		"`InOutRegister`.`ot_Ref06`" => "ot_Ref06",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`InOutRegister`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`InOutRegister`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`InOutRegister`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"if(`InOutRegister`.`ot_ap_filed`,date_format(`InOutRegister`.`ot_ap_filed`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_filed",
		"if(`InOutRegister`.`ot_ap_lastmodified`,date_format(`InOutRegister`.`ot_ap_lastmodified`,'%m/%d/%Y %h:%i %p'),'')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`InOutRegister` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`InOutRegister`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`InOutRegister`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`InOutRegister`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "InOutRegister_view.php";
	$x->RedirectAfterInsert = "InOutRegister_view.php";
	$x->TableTitle = "Incoming & Outgoing Record Register";
	$x->TableIcon = "resources/table_icons/arrow_refresh.png";
	$x->PrimaryKey = "`InOutRegister`.`id`";
	$x->DefaultSortField = '1';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 120, 70, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "Title", "Classification", "Review", "Approval", "IMS Control", "Register", "Last modified");
	$x->ColFieldName = array('RecordNumber', 'DocItem', 'fo_Classification', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 5, 21, 23, 25, 27, 28);

	// template paths below are based on the app main directory
	$x->Template = 'templates/InOutRegister_templateTV.html';
	$x->SelectedTemplate = 'templates/InOutRegister_templateTVS.html';
	$x->TemplateDV = 'templates/InOutRegister_templateDV.html';
	$x->TemplateDVP = 'templates/InOutRegister_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "col-lg-6";
	$x->DVClasses = "col-lg-6";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `InOutRegister`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='InOutRegister' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `InOutRegister`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='InOutRegister' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`InOutRegister`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: InOutRegister_init
	$render=TRUE;
	if(function_exists('InOutRegister_init')){
		$args=array();
		$render=InOutRegister_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: InOutRegister_header
	$headerCode='';
	if(function_exists('InOutRegister_header')){
		$args=array();
		$headerCode=InOutRegister_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: InOutRegister_footer
	$footerCode='';
	if(function_exists('InOutRegister_footer')){
		$args=array();
		$footerCode=InOutRegister_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>