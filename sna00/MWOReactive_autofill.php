<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('MWOReactive');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk=$_GET['mfk'];
	$id=makeSafe($_GET['id']);
	$rnd1=intval($_GET['rnd1']); if(!$rnd1) $rnd1='';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'fo_EmployeeID':
			if(!$id){
				?>
				$('fo_Position<?php echo $rnd1; ?>').innerHTML='&nbsp;';
				<?php
				break;
			}
			$res = sql("SELECT `employees`.`EmployeeID` as 'EmployeeID', `employees`.`EmpNo` as 'EmpNo', `employees`.`Name` as 'Name', IF(    CHAR_LENGTH(`WorkLocation1`.`BaseLocation`) || CHAR_LENGTH(`WorkLocation1`.`DocItem`), CONCAT_WS('',   `WorkLocation1`.`BaseLocation`, ': ', `WorkLocation1`.`DocItem`), '') as 'BaseLocation', `employees`.`fo_TermEmployment` as 'fo_TermEmployment', `employees`.`fo_Photo` as 'fo_Photo', `employees`.`fo_Position` as 'fo_Position', if(`employees`.`fo_BirthDate`,date_format(`employees`.`fo_BirthDate`,'%m/%d/%Y'),'') as 'fo_BirthDate', if(`employees`.`fo_HireDate`,date_format(`employees`.`fo_HireDate`,'%m/%d/%Y'),'') as 'fo_HireDate', `employees`.`fo_Address` as 'fo_Address', `employees`.`fo_City` as 'fo_City', `employees`.`fo_Region` as 'fo_Region', `employees`.`fo_PostalCode` as 'fo_PostalCode', `employees`.`fo_Country` as 'fo_Country', `employees`.`fo_HomePhone` as 'fo_HomePhone', `employees`.`fo_Extension` as 'fo_Extension', `employees`.`fo_Notes` as 'fo_Notes', IF(    CHAR_LENGTH(`employees1`.`Name`) || CHAR_LENGTH(`employees1`.`EmployeeID`), CONCAT_WS('',   `employees1`.`Name`, ', ', `employees1`.`EmployeeID`), '') as 'fo_ReportsTo', concat('<img src=\"', if(`employees`.`fo_Acknowledgement`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />') as 'fo_Acknowledgement', concat('<img src=\"', if(`employees`.`fo_Induction`, 'checked.gif', 'checkednot.gif'), '\" border=\"0\" />') as 'fo_Induction', CONCAT_WS('-', LEFT(`employees`.`ot_FileLoc`,3), MID(`employees`.`ot_FileLoc`,4,3)) as 'ot_FileLoc', `employees`.`ot_otherdetails` as 'ot_otherdetails', `employees`.`ot_comments` as 'ot_comments', `employees`.`ot_SharedLink1` as 'ot_SharedLink1', `employees`.`ot_SharedLink2` as 'ot_SharedLink2', `employees`.`ot_Ref01` as 'ot_Ref01', `employees`.`ot_Ref02` as 'ot_Ref02', IF(    CHAR_LENGTH(`Leadership1`.`Status`), CONCAT_WS('',   `Leadership1`.`Status`), '') as 'ot_ap_Review', `employees`.`ot_ap_RevComment` as 'ot_ap_RevComment', IF(    CHAR_LENGTH(`Approval1`.`Status`), CONCAT_WS('',   `Approval1`.`Status`), '') as 'ot_ap_Approval', `employees`.`ot_ap_ApprComment` as 'ot_ap_ApprComment', IF(    CHAR_LENGTH(`IMSControl1`.`Status`), CONCAT_WS('',   `IMSControl1`.`Status`), '') as 'ot_ap_QC', `employees`.`ot_ap_QCComment` as 'ot_ap_QCComment', DATE_FORMAT(`employees`.`ot_ap_filed`, '%e/%c/%Y %l:%i%p') as 'ot_ap_filed', DATE_FORMAT(`employees`.`ot_ap_lastmodified`, '%e/%c/%Y %l:%i%p') as 'ot_ap_lastmodified' FROM `employees` LEFT JOIN `WorkLocation` as WorkLocation1 ON `WorkLocation1`.`id`=`employees`.`BaseLocation` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`employees`.`fo_ReportsTo` LEFT JOIN `Leadership` as Leadership1 ON `Leadership1`.`id`=`employees`.`ot_ap_Review` LEFT JOIN `Approval` as Approval1 ON `Approval1`.`id`=`employees`.`ot_ap_Approval` LEFT JOIN `IMSControl` as IMSControl1 ON `IMSControl1`.`id`=`employees`.`ot_ap_QC`  WHERE `employees`.`EmployeeID`='$id' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#fo_Position<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['fo_Position']))); ?>&nbsp;');
			<?php
			break;


	}

?>