<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
    $output = array();
    $memberInfo = getMemberInfo();
    
    //kpiCommon.php

    // get kpi array
    $kpi_array_res = sql("SELECT DISTINCT `fo_Section_Name`, `fo_TaskCompDuration`, max(`ot_ap_Date`) from `kpi` group by 1, 2 order by 1", $eo);
    $kpi_array = array();
    while($row = db_fetch_array($kpi_array_res)) {
        $kpi_array[$row[0]] = $row[1];
    }

    // get all records created by each user
    $all_records = sql("SELECT `memberID`, `tableName`, `pkValue` FROM `membership_userrecords` WHERE `tableName` in (select DISTINCT `fo_Section_Name` from `kpi`) and `tableName` not in ('ActCard', 'batches', 'categories', 'EventNotification', 'IMSReport', 'Item', 'PersonnalFile', 'Recruitment', 'resources', 'TeamSoftBoard', 'transactions') and from_unixtime(`dateAdded`) >=  (SELECT DATE_SUB(NOW(), INTERVAL 365 day)) order by 1, 2, 3", $eo);
    
    $notifyArray = array();

    // process all records 
    while($row = db_fetch_array($all_records)) {
        $currTableMemberID = $row[0];
        $currTable = $row[1];
        $currTablePKFieldValue = $row[2];
        $currTablePKFieldName = getPKFieldName($currTable);
        $currTableDisplayFieldName = get_summary_custom_display($currTable, 0);
        $currTableTitleFieldName = getDbTitleField($currTable);
        $currTableDateAddedField = getDbDateField($currTable, 'dateAdded');
        $currTableDateModifiedField = getDbDateField($currTable, 'dateModified');

        // check if need to notify 
        $currTableSql = "SELECT `" . $currTablePKFieldName . "`, `" . $currTableTitleFieldName . "`, DATEDIFF(COALESCE(`" . $currTableDateModifiedField . "`, CURRENT_TIMESTAMP), `" . $currTableDateAddedField . "`) as `days`, '" . $kpi_array[$currTable] . "' as `kpi_metric` FROM `" . $currTable . "` WHERE `" . $currTablePKFieldName . "` = '" . $currTablePKFieldValue . "' and (COALESCE(`ot_ap_Review`,0) <> 4 or COALESCE(`ot_ap_Approval`,0) <> 4 or COALESCE(`ot_ap_QC`,0) <> 4) and DATEDIFF(COALESCE(`" . $currTableDateModifiedField . "`, CURRENT_TIMESTAMP), `" . $currTableDateAddedField . "`) > " . $kpi_array[$currTable];
        $currNeedToNotify = sql($currTableSql, $eo);
        if($row2=@db_fetch_row($currNeedToNotify)){
            if($row2[0]!=''){
                // add to notify
                $newNotification = new UserNotification([]);
                $newNotification->setNotif_title('KPI not achieved');
                $newNotification->setNotif_msg('Your ' . $currTableDisplayFieldName . ' task ' . $row2[1] . ' has exceed target completion duration of ' . $row2[3] . ' days');
                $newNotification->setNotif_url($currTable . '_view.php?SelectedID=' . $currTablePKFieldValue);
                $newNotification->setNotif_time(date('Y-m-d H:i:s'));
                $newNotification->setMemberID($currTableMemberID);
                $notifyArray[] = $newNotification;
            }
        }
    }

    // process all notifications
    if (count($notifyArray) > 0){
        foreach($notifyArray as $n){
            $n->createNotification();
        }
    }

