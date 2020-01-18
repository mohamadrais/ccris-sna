<?php

// Data functions (insert, update, delete, form) for table summary_dashboard

// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

function summary_dashboard_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('summary_dashboard');
	if(!$arrPerm[1]){
		return false;
	}

	$data['fo_CustomDisplayField1'] = makeSafe($_REQUEST['fo_CustomDisplayField1']);
		if($data['fo_CustomDisplayField1'] == empty_lookup_value){ $data['fo_CustomDisplayField1'] = ''; }
	$data['fo_CustomDisplayField2'] = makeSafe($_REQUEST['fo_CustomDisplayField2']);
		if($data['fo_CustomDisplayField2'] == empty_lookup_value){ $data['fo_CustomDisplayField2'] = ''; }

	// hook: summary_dashboard_before_insert
	if(function_exists('summary_dashboard_before_insert')){
		$args=array();
		if(!summary_dashboard_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `summary_dashboard` set       `fo_CustomDisplayField1`=' . (($data['fo_CustomDisplayField1'] !== '' && $data['fo_CustomDisplayField1'] !== NULL) ? "'{$data['fo_CustomDisplayField1']}'" : 'NULL') . ', `fo_CustomDisplayField2`=' . (($data['fo_CustomDisplayField2'] !== '' && $data['fo_CustomDisplayField2'] !== NULL) ? "'{$data['fo_CustomDisplayField2']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"summary_dashboard_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: summary_dashboard_after_insert
	if(function_exists('summary_dashboard_after_insert')){
		$res = sql("select * from `summary_dashboard` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!summary_dashboard_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('summary_dashboard', $recID, getLoggedMemberID());

	return $recID;
}

function summary_dashboard_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('summary_dashboard');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='summary_dashboard' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='summary_dashboard' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: summary_dashboard_before_delete
	if(function_exists('summary_dashboard_before_delete')){
		$args=array();
		if(!summary_dashboard_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `summary_dashboard` where `id`='$selected_id'", $eo);

	// hook: summary_dashboard_after_delete
	if(function_exists('summary_dashboard_after_delete')){
		$args=array();
		summary_dashboard_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='summary_dashboard' and pkValue='$selected_id'", $eo);
}

function summary_dashboard_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('summary_dashboard');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='summary_dashboard' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='summary_dashboard' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['fo_CustomDisplayField1'] = makeSafe($_REQUEST['fo_CustomDisplayField1']);
		if($data['fo_CustomDisplayField1'] == empty_lookup_value){ $data['fo_CustomDisplayField1'] = ''; }
	$data['fo_CustomDisplayField2'] = makeSafe($_REQUEST['fo_CustomDisplayField2']);
		if($data['fo_CustomDisplayField2'] == empty_lookup_value){ $data['fo_CustomDisplayField2'] = ''; }
	$data['ot_ap_lastmodified'] = parseCode('<%%editingDateTime%%>', false, true);
	$data['selectedID']=makeSafe($selected_id);

	// hook: summary_dashboard_before_update
	if(function_exists('summary_dashboard_before_update')){
		$args=array();
		if(!summary_dashboard_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `summary_dashboard` set       `fo_CustomDisplayField1`=' . (($data['fo_CustomDisplayField1'] !== '' && $data['fo_CustomDisplayField1'] !== NULL) ? "'{$data['fo_CustomDisplayField1']}'" : 'NULL') . ', `fo_CustomDisplayField2`=' . (($data['fo_CustomDisplayField2'] !== '' && $data['fo_CustomDisplayField2'] !== NULL) ? "'{$data['fo_CustomDisplayField2']}'" : 'NULL') . ', `ot_ap_lastmodified`=' . "'{$data['ot_ap_lastmodified']}'" . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="summary_dashboard_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: summary_dashboard_after_update
	if(function_exists('summary_dashboard_after_update')){
		$res = sql("SELECT * FROM `summary_dashboard` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!summary_dashboard_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='summary_dashboard' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function summary_dashboard_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('summary_dashboard');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: ot_ap_Date
	$combo_ot_ap_Date = new DateCombo;
	$combo_ot_ap_Date->DateFormat = "mdy";
	$combo_ot_ap_Date->MinYear = 1900;
	$combo_ot_ap_Date->MaxYear = 2100;
	$combo_ot_ap_Date->DefaultDate = parseMySQLDate('', '');
	$combo_ot_ap_Date->MonthNames = $Translation['month names'];
	$combo_ot_ap_Date->NamePrefix = 'ot_ap_Date';

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='summary_dashboard' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='summary_dashboard' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `summary_dashboard` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'summary_dashboard_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_ot_ap_Date->DefaultDate = $row['ot_ap_Date'];
	}else{
	}

	ob_start();
	?>

	<script>
		// initial lookup values

		jQuery(function() {
			setTimeout(function(){
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/summary_dashboard_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/summary_dashboard_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Detail View', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="no-style-button" id="insert" name="insert_x" value="1" onclick="return summary_dashboard_validateData();"><a href="#" title=" ' . $Translation['Save New'] . '"><i class="ti-plus"></i></a></button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="no-style-button" id="insert" name="insert_y" value="1" onclick="return summary_dashboard_validateData();"><a href="#" title=" ' . $Translation['Save As Copy'] . '"><i class="ti-files"></i></a></button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(1).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="no-style-button" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><a href="#" title="' . html_attr($Translation['Print Preview']) . '"><i class="ti-printer"></i></a></button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<a id="updateRecord" class="btn btn-warning float-btn-2"  href="#" style="display:none;" title="' . html_attr($Translation['Save Changes']) . '"><button class="no-style-button" id="update" name="update_x" value="1" onclick="return summary_dashboard_validateData();"><i class="fa fa-floppy-o"></i></button></a>', $templateCode);
			$templateCode = str_replace('<%%EDIT_BUTTON%%>', '<a id="startEdit" class="btn btn-warning float-btn-2" href="#Edit"><i class="ti-pencil-alt mr-2" aria-hidden="true"></i></a>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="no-style-button" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');"><a href="#" title="' . html_attr($Translation['Delete']) . '"><i class="ti-trash"></i></a></button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%CANCELEDIT_BUTTON%%>', '<button style="width:unset;height:unset;color:unset;border:none;background:none;display:none;" title="' . html_attr($Translation['Cancel']) . '" type="submit" name="backToReadMode" id="backToReadMode" value="1" ><a href="#" title="' . html_attr($Translation['Cancel']) . '"><i class="ti-arrow-left"></i></a></button>', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button style="width:unset;height:unset;color:unset;border:none;background:none"  onClick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '" type="submit" name="deselect_x" id="deselect" value="1" ><a href="#" title="' . html_attr($Translation['Back']) . '"><i class="ti-arrow-left"></i></a></button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%EDIT_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%ATTACH_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%CANCELEDIT_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="no-style-button" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><a href="#" title="' . html_attr($Translation['Back']) . '"><i class="ti-arrow-left"></i></a></button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#startEdit').hide();\n";
		$jsReadOnly .= "\tjQuery('#fo_CustomDisplayField1').replaceWith('<div class=\"form-control-static\" id=\"fo_CustomDisplayField1\">' + (jQuery('#fo_CustomDisplayField1').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#fo_CustomDisplayField2').replaceWith('<div class=\"form-control-static\" id=\"fo_CustomDisplayField2\">' + (jQuery('#fo_CustomDisplayField2').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(ot_ap_Date)%%>', ($selected_id && !$arrPerm[3] ? '<div class="form-control-static">' . $combo_ot_ap_Date->GetHTML(true) . '</div>' : $combo_ot_ap_Date->GetHTML()), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(ot_ap_Date)%%>', $combo_ot_ap_Date->GetHTML(true), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array();
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(ot_ap_Date)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_Section_Name)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_Section_Caption)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_TotalDisplayField)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_TotalCount)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_ReviewCount)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_ApprovalCount)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_IMSControlCount)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_CustomDisplayField1)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_CustomDisplayValue1)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_CustomDisplayField2)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(fo_CustomDisplayValue2)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(ot_ap_lastmodified)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode = str_replace('<%%VALUE(ot_ap_Date)%%>', @date('m/d/Y', @strtotime(html_attr($row['ot_ap_Date']))), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ot_ap_Date)%%>', urlencode(@date('m/d/Y', @strtotime(html_attr($urow['ot_ap_Date'])))), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_Section_Name)%%>', safe_html($urow['fo_Section_Name']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_Section_Name)%%>', urlencode($urow['fo_Section_Name']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_Section_Caption)%%>', safe_html($urow['fo_Section_Caption']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_Section_Caption)%%>', urlencode($urow['fo_Section_Caption']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_TotalDisplayField)%%>', safe_html($urow['fo_TotalDisplayField']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_TotalDisplayField)%%>', urlencode($urow['fo_TotalDisplayField']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_TotalCount)%%>', safe_html($urow['fo_TotalCount']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_TotalCount)%%>', urlencode($urow['fo_TotalCount']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_ReviewCount)%%>', safe_html($urow['fo_ReviewCount']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_ReviewCount)%%>', urlencode($urow['fo_ReviewCount']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_ApprovalCount)%%>', safe_html($urow['fo_ApprovalCount']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_ApprovalCount)%%>', urlencode($urow['fo_ApprovalCount']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_IMSControlCount)%%>', safe_html($urow['fo_IMSControlCount']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_IMSControlCount)%%>', urlencode($urow['fo_IMSControlCount']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(fo_CustomDisplayField1)%%>', safe_html($urow['fo_CustomDisplayField1']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(fo_CustomDisplayField1)%%>', html_attr($row['fo_CustomDisplayField1']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayField1)%%>', urlencode($urow['fo_CustomDisplayField1']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayValue1)%%>', safe_html($urow['fo_CustomDisplayValue1']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayValue1)%%>', urlencode($urow['fo_CustomDisplayValue1']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(fo_CustomDisplayField2)%%>', safe_html($urow['fo_CustomDisplayField2']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(fo_CustomDisplayField2)%%>', html_attr($row['fo_CustomDisplayField2']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayField2)%%>', urlencode($urow['fo_CustomDisplayField2']), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayValue2)%%>', safe_html($urow['fo_CustomDisplayValue2']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayValue2)%%>', urlencode($urow['fo_CustomDisplayValue2']), $templateCode);
		$templateCode = str_replace('<%%VALUE(ot_ap_lastmodified)%%>', app_datetime($row['ot_ap_lastmodified'], 'dt'), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ot_ap_lastmodified)%%>', urlencode(app_datetime($urow['ot_ap_lastmodified'], 'dt')), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(ot_ap_Date)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ot_ap_Date)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_Section_Name)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_Section_Name)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_Section_Caption)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_Section_Caption)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_TotalDisplayField)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_TotalDisplayField)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_TotalCount)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_TotalCount)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_ReviewCount)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_ReviewCount)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_ApprovalCount)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_ApprovalCount)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_IMSControlCount)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_IMSControlCount)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayField1)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayField1)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayValue1)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayValue1)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayField2)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayField2)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(fo_CustomDisplayValue2)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(fo_CustomDisplayValue2)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(ot_ap_lastmodified)%%>', '<%%editingDateTime%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(ot_ap_lastmodified)%%>', urlencode('<%%editingDateTime%%>'), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('summary_dashboard');
	if($selected_id){
		$jdata = get_joined_record('summary_dashboard', $selected_id);
		if($jdata === false) $jdata = get_defaults('summary_dashboard');
		$rdata = $row;
	}
	$templateCode .= loadView('summary_dashboard-ajax-cache', array('rdata' => $rdata, 'jdata' => $jdata));

	// hook: summary_dashboard_dv
	if(function_exists('summary_dashboard_dv')){
		$args=array();
		summary_dashboard_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>