<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('DCN');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'DCCID':
			if(!$id){
				?>
				$('fo_DCCITEM<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `DocControl`.`id` as 'id', `DocControl`.`DocconNumber` as 'DocconNumber', `DocControl`.`DocItem` as 'DocItem', `DocControl`.`fo_DocumentDescription` as 'fo_DocumentDescription', `DocControl`.`fo_Class` as 'fo_Class', `DocControl`.`fo_DocumentType` as 'fo_DocumentType', `DocControl`.`fo_Rev` as 'fo_Rev', if(`DocControl`.`fo_date`,date_format(`DocControl`.`fo_date`,'%m/%d/%Y'),'') as 'fo_date', CONCAT_WS('-', LEFT(`DocControl`.`ot_FileLoc`,3), MID(`DocControl`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `DocControl`.`ot_otherdetails` as 'ot_otherdetails', `DocControl`.`ot_comments` as 'ot_comments', `DocControl`.`ot_SharedLink1` as 'ot_SharedLink1', `DocControl`.`ot_SharedLink2` as 'ot_SharedLink2', `DocControl`.`ot_Ref01` as 'ot_Ref01', `DocControl`.`ot_Ref02` as 'ot_Ref02', `DocControl`.`ot_Photo` as 'ot_Photo', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `DocControl`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `DocControl`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `DocControl`.`ot_ap_QCComment` as 'ot_ap_QCComment', DATE_FORMAT(`DocControl`.`ot_ap_filed`, '%c/%e/%Y %l:%i%p') as 'ot_ap_filed', DATE_FORMAT(`DocControl`.`ot_ap_lastmodified`, '%c/%e/%Y %l:%i%p') as 'ot_ap_lastmodified' FROM `DocControl` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`DocControl`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`DocControl`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`DocControl`.`ot_ap_QC`  WHERE `DocControl`.`id`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#fo_DCCITEM<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['DocItem'].'::'.$row['fo_Class']))); ?>&nbsp;');
			<?php
			break;


	}

?>