<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/ObsoleteRec.php");
	include("$currDir/ObsoleteRec_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('ObsoleteRec');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "ObsoleteRec";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`ObsoleteRec`.`id`" => "id",
		"`ObsoleteRec`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') /* DCN ID */" => "DCCID",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') /* DCN ID */" => "fo_DCCITEM",
		"`ObsoleteRec`.`fo_Description`" => "fo_Description",
		"`ObsoleteRec`.`ot_FileLoc`" => "ot_FileLoc",
		"`ObsoleteRec`.`ot_otherdetails`" => "ot_otherdetails",
		"`ObsoleteRec`.`ot_comments`" => "ot_comments",
		"`ObsoleteRec`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ObsoleteRec`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ObsoleteRec`.`ot_Ref01`" => "ot_Ref01",
		"`ObsoleteRec`.`ot_Ref02`" => "ot_Ref02",
		"`ObsoleteRec`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ObsoleteRec`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ObsoleteRec`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ObsoleteRec`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`ObsoleteRec`.`id`',
		2 => 2,
		3 => '`DocControl1`.`DocconNumber`',
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
		14 => '`Leadership1`.`Status`',
		15 => 15,
		16 => '`Approval1`.`Status`',
		17 => 17,
		18 => '`IMSControl1`.`Status`',
		19 => 19,
		20 => '`ObsoleteRec`.`ot_ap_filed`',
		21 => '`ObsoleteRec`.`ot_ap_lastmodified`'
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`ObsoleteRec`.`id`" => "id",
		"`ObsoleteRec`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') /* DCN ID */" => "DCCID",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') /* DCN ID */" => "fo_DCCITEM",
		"`ObsoleteRec`.`fo_Description`" => "fo_Description",
		"`ObsoleteRec`.`ot_FileLoc`" => "ot_FileLoc",
		"`ObsoleteRec`.`ot_otherdetails`" => "ot_otherdetails",
		"`ObsoleteRec`.`ot_comments`" => "ot_comments",
		"`ObsoleteRec`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ObsoleteRec`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ObsoleteRec`.`ot_Ref01`" => "ot_Ref01",
		"`ObsoleteRec`.`ot_Ref02`" => "ot_Ref02",
		"`ObsoleteRec`.`ot_Photo`" => "ot_Photo",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ObsoleteRec`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ObsoleteRec`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ObsoleteRec`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`ObsoleteRec`.`id`" => "ID",
		"`ObsoleteRec`.`DocconNumber`" => "Record ID",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') /* DCN ID */" => "DCN ID",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') /* DCN ID */" => "DCN ID",
		"`ObsoleteRec`.`fo_Description`" => "Description",
		"`ObsoleteRec`.`ot_FileLoc`" => "File Location & Number",
		"`ObsoleteRec`.`ot_otherdetails`" => "Other details",
		"`ObsoleteRec`.`ot_comments`" => "Comments",
		"`ObsoleteRec`.`ot_SharedLink1`" => "Shared Link 1",
		"`ObsoleteRec`.`ot_SharedLink2`" => "Shared Link 2",
		"`ObsoleteRec`.`ot_Ref01`" => "Reference_1",
		"`ObsoleteRec`.`ot_Ref02`" => "Reference_2",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "Review",
		"`ObsoleteRec`.`ot_ap_RevComment`" => "Review Comment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "Approval",
		"`ObsoleteRec`.`ot_ap_ApprComment`" => "Approval Comment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "IMS Control",
		"`ObsoleteRec`.`ot_ap_QCComment`" => "IMS Control Comment",
		"`ObsoleteRec`.`ot_ap_filed`" => "Filed",
		"`ObsoleteRec`.`ot_ap_lastmodified`" => "Last modified"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`ObsoleteRec`.`id`" => "id",
		"`ObsoleteRec`.`DocconNumber`" => "DocconNumber",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocconNumber`), CONCAT_WS('',   `DocControl1`.`DocconNumber`), '') /* DCN ID */" => "DCCID",
		"IF(    CHAR_LENGTH(`DocControl1`.`DocItem`) || CHAR_LENGTH(`DocControl1`.`fo_Class`), CONCAT_WS('',   `DocControl1`.`DocItem`, '::', `DocControl1`.`fo_Class`), '') /* DCN ID */" => "fo_DCCITEM",
		"`ObsoleteRec`.`fo_Description`" => "fo_Description",
		"`ObsoleteRec`.`ot_FileLoc`" => "ot_FileLoc",
		"`ObsoleteRec`.`ot_otherdetails`" => "ot_otherdetails",
		"`ObsoleteRec`.`ot_comments`" => "ot_comments",
		"`ObsoleteRec`.`ot_SharedLink1`" => "ot_SharedLink1",
		"`ObsoleteRec`.`ot_SharedLink2`" => "ot_SharedLink2",
		"`ObsoleteRec`.`ot_Ref01`" => "ot_Ref01",
		"`ObsoleteRec`.`ot_Ref02`" => "ot_Ref02",
		"IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') /* Review */" => "ot_ap_Review",
		"`ObsoleteRec`.`ot_ap_RevComment`" => "ot_ap_RevComment",
		"IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') /* Approval */" => "ot_ap_Approval",
		"`ObsoleteRec`.`ot_ap_ApprComment`" => "ot_ap_ApprComment",
		"IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') /* IMS Control */" => "ot_ap_QC",
		"`ObsoleteRec`.`ot_ap_QCComment`" => "ot_ap_QCComment",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p')" => "ot_ap_filed",
		"DATE_FORMAT(`ObsoleteRec`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p')" => "ot_ap_lastmodified"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'DCCID' => 'DCN ID', 'ot_ap_Review' => 'Review', 'ot_ap_Approval' => 'Approval', 'ot_ap_QC' => 'IMS Control');

	$x->QueryFrom = "`ObsoleteRec` LEFT JOIN `DocControl` as DocControl1 ON `DocControl1`.`id`=`ObsoleteRec`.`DCCID` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`ObsoleteRec`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`ObsoleteRec`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`ObsoleteRec`.`ot_ap_QC` ";
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
	$x->ScriptFileName = "ObsoleteRec_view.php";
	$x->RedirectAfterInsert = "ObsoleteRec_view.php?SelectedID=#ID#";
	$x->TableTitle = "Obsolete Record Register";
	$x->TableIcon = "resources/table_icons/application_form_magnify.png";
	$x->PrimaryKey = "`ObsoleteRec`.`id`";
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth   = array(  120, 70, 70, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Record ID", "DCN ID", "DCN ID", "Review", "Approval", "IMS Control", "Filed", "Last modified");
	$x->ColFieldName = array('DocconNumber', 'DCCID', 'fo_DCCITEM', 'ot_ap_Review', 'ot_ap_Approval', 'ot_ap_QC', 'ot_ap_filed', 'ot_ap_lastmodified');
	$x->ColNumber  = array(2, 3, 4, 14, 16, 18, 20, 21);

	// template paths below are based on the app main directory
	$x->Template = 'templates/ObsoleteRec_templateTV.html';
	$x->SelectedTemplate = 'templates/ObsoleteRec_templateTVS.html';
	$x->TemplateDV = 'templates/ObsoleteRec_templateDV.html';
	$x->TemplateDVP = 'templates/ObsoleteRec_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ObsoleteRec`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ObsoleteRec' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `ObsoleteRec`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='ObsoleteRec' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`ObsoleteRec`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: ObsoleteRec_init
	$render=TRUE;
	if(function_exists('ObsoleteRec_init')){
		$args=array();
		$render=ObsoleteRec_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: ObsoleteRec_header
	$headerCode='';
	if(function_exists('ObsoleteRec_header')){
		$args=array();
		$headerCode=ObsoleteRec_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: ObsoleteRec_footer
	$footerCode='';
	if(function_exists('ObsoleteRec_footer')){
		$args=array();
		$footerCode=ObsoleteRec_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>