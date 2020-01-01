<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
    $output = array();

//fetch-reports.php
if (isset($_POST["report2"]) && isset($_POST["startDate"]) && isset($_POST["endDate"])) {
    $tn = makeSafe($_POST["report2"]);
    $startDate = makeSafe($_POST["startDate"]);
    $endDate = makeSafe($_POST["endDate"]);
    $num_of_fields = 0; 
    $query = '';
    $total_display = 'Total ' . get_summary_custom_display($tn, 0);
    $total_custom_display_1 = '';
    $total_custom_display_2 = '';

    switch($tn){
        // Only Total (1 field)
        case 'EventNotification':
        case 'batches':
        case 'categories':
            $num_of_fields = 1; 
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
            break;
        // Only Total and Custom 1 (2 fields)
        case 'PersonnalFile':
        case 'Item':
        case 'IMSReport':
        case 'TeamSoftBoard':
            $num_of_fields = 2;
            $total_custom_display_1 = get_summary_custom_display($tn, 1);
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_CustomDisplayValue1`) as 'total_custom_value_1' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
            break;
        // Only Total, Custom 1 and Custom 2 (3 fields)
        case 'ActCard':
        case 'Recruitment':
        case 'ReportComment':
        case 'SoftboardComment':
        case 'resources':
        case 'transactions':
            $num_of_fields = 3;
            $total_custom_display_1 = get_summary_custom_display($tn, 1);
            $total_custom_display_2 = get_summary_custom_display($tn, 3);
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_CustomDisplayValue1`) as 'total_custom_value_1', sum(`fo_CustomDisplayValue2`) as 'total_custom_value_2' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
            break;
        // Only Total, Reviews, Approvals and IMS Controls (4 fields)
        case 'JD_JS':
            $num_of_fields = 4;
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_ReviewCount`) as 'total_reviews_closed', sum(`fo_ApprovalCount`) as 'total_approvals_closed', sum(`fo_IMSControlCount`) as 'total_ims_controls_closed' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
            break;
        // Only Total, Reviews, Approvals, IMS Controls and Custom1 (5 fields)
        case 'CalibrationCtrl':
        case 'Logistics':
        case 'vendor':
        case 'Bi_WeeklyMeeting':
        case 'DCN':
        case 'DeliveryOrder':
        case 'MWConditionBased':
        case 'MWOCorrective':
        case 'MWOPlanned':
        case 'MWOpreventive':
        case 'MWOproactive':
        case 'MWOReactive':
        case 'ObsoleteRec':
        case 'QuarterlyMeeting':
        case 'ToolBoxMeeting':
        case 'PROInitiation':
        case 'WorkLocation':
        case 'CommConsParticipate':
        case 'StakeholderSatisfaction':
            $num_of_fields = 5;
            $total_custom_display_1 = get_summary_custom_display($tn, 1);
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_ReviewCount`) as 'total_reviews_closed', sum(`fo_ApprovalCount`) as 'total_approvals_closed', sum(`fo_IMSControlCount`) as 'total_ims_controls_closed', sum(`fo_CustomDisplayValue1`) as 'total_custom_value_1' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
            break;
        // Total, Reviews, Approvals, IMS Controls, Custom1 and Custom2 (All 6 fields)
        default:
            $num_of_fields = 6;
            $total_custom_display_1 = get_summary_custom_display($tn, 1);
            $total_custom_display_2 = get_summary_custom_display($tn, 3);
            $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_ReviewCount`) as 'total_reviews_closed', sum(`fo_ApprovalCount`) as 'total_approvals_closed', sum(`fo_IMSControlCount`) as 'total_ims_controls_closed', sum(`fo_CustomDisplayValue1`) as 'total_custom_value_1', sum(`fo_CustomDisplayValue2`) as 'total_custom_value_2' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";
    }

    $total_custom_display_1 = str_replace("this", "per", $total_custom_display_1);
    $total_custom_display_1 = str_replace(" ", "_", $total_custom_display_1);
    $total_custom_display_2 = str_replace("this", "per", $total_custom_display_2);
    $total_custom_display_2 = str_replace(" ", "_", $total_custom_display_2);

    $res = sql($query, $eo);
            
    while($row = db_fetch_array($res)) {
        switch($num_of_fields){
            // Only Total (1 field)
            case '1':
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count'])
                );
                break;
            // Only Total and Custom 1 (2 fields)
            case '2':
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count']),
                    $total_custom_display_1     => intval($row['total_custom_value_1'])
                );
                break;
            // Only Total, Custom 1 and Custom 2 (3 fields)
            case '3':
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count']),
                    $total_custom_display_1     => intval($row['total_custom_value_1']),
                    $total_custom_display_2     => intval($row['total_custom_value_2'])
                );
                break;
            // Only Total, Reviews, Approvals and IMS Controls (4 fields)
            case '4':
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count']),
                    'Total_Reviews_Closed'      => intval($row['total_reviews_closed']),
                    'Total_Approvals_Closed'    => intval($row['total_approvals_closed']),
                    'Total_IMS_Controls_Closed' => intval($row['total_ims_controls_closed'])
                );
                break;
            // Only Total, Reviews, Approvals, IMS Controls and Custom1 (5 fields)
            case '5':
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count']),
                    'Total_Reviews_Closed'      => intval($row['total_reviews_closed']),
                    'Total_Approvals_Closed'    => intval($row['total_approvals_closed']),
                    'Total_IMS_Controls_Closed' => intval($row['total_ims_controls_closed']),
                    $total_custom_display_1     => intval($row['total_custom_value_1'])
                );
                break;
            // Total, Reviews, Approvals, IMS Controls, Custom1 and Custom2 (All 6 fields)
            default:
                $output[] = array(
                    'Date'                      => $row['date'],
                    'Total_Count'               => intval($row['total_count']),
                    'Total_Reviews_Closed'      => intval($row['total_reviews_closed']),
                    'Total_Approvals_Closed'    => intval($row['total_approvals_closed']),
                    'Total_IMS_Controls_Closed' => intval($row['total_ims_controls_closed']),
                    $total_custom_display_1     => intval($row['total_custom_value_1']),
                    $total_custom_display_2     => intval($row['total_custom_value_2'])
                );
        }
        
    }
    echo json_encode($output);
}
else if (isset($_POST["type"])) {
    $type = makeSafe($_POST["type"]);
    if($type == 'load_default_data'){
        $resTopMembers=sql("select lcase(memberID), count(1) from membership_userrecords group by memberID order by 2 desc limit 5", $eo);

        $tg=sqlValue("select count(1) from membership_groups");
        $activeM=sqlValue("select count(1) from membership_users where isApproved=1 and isBanned=0");
        $awaitingM=intval(sqlValue("select count(1) from membership_users where isApproved=0"));
        $bannedM=intval(sqlValue("select count(1) from membership_users where isApproved=1 and isBanned=1"));
        $totalM=intval(sqlValue("select count(1) from membership_users"));

        while($row = db_fetch_array($resTopMembers)) {
            $output[] = array(
                'members'       => $row[0],
                'record_counts' => intval($row[1])
            );
        }
        $output[] = array(
            'total_groups'  => intval($tg),
            'active'        => intval($activeM),
            'awaiting'      => intval($awaitingM),
            'banned'        => intval($bannedM),
            'total_members' => intval($totalM)
        );
        echo json_encode($output);

    }
}
else if (isset($_POST["kpi"])) {
    $kpi = makeSafe($_POST["kpi"]);
    $tn = makeSafe($_POST["report2"]);
    if($kpi == 'true'){
        $tn = makeSafe($_POST["report2"]);
        $kpiResult=sql("SELECT `fo_MinRecordRequired`, `fo_TaskCompDuration`, (SELECT CONCAT (COALESCE(ROUND((count(mu.`recID`)/k.`fo_minRecordRequired`)*100, 2), 0.00), '%') from `kpi` k inner join `membership_userrecords` mu on mu.`tableName` = k.`fo_Section_Name` where k.`id` = `kpi`.`id` and (YEAR(from_unixtime(mu.`dateAdded`)) = YEAR(CURRENT_DATE()))) as `fo_PercentageAchieved` from `kpi` where `kpi`.`fo_Section_Name` = '$tn'", $eo);
        while($row = db_fetch_array($kpiResult)) {
            $output[] = array(
                'min_records_required'  => $row[0],
                'task_completion'       => $row[1],
                'percentage_kpi_annum'  => $row[2]
            );
        }
        echo json_encode($output);
    }
}
