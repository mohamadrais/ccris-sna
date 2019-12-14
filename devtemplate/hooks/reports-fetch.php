<?php
    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");

//fetch-reports.php
if (isset($_POST["report2"]) && isset($_POST["startDate"]) && isset($_POST["endDate"])) {
    $tn = makeSafe($_POST["report2"]);
    $startDate = makeSafe($_POST["startDate"]);
    $endDate = makeSafe($_POST["endDate"]);
    $query = "SELECT `ot_ap_Date` as 'date', sum(`fo_TotalCount`) as 'total_count', sum(`fo_ReviewCount`) as 'total_reviews_closed', sum(`fo_ApprovalCount`) as 'total_approvals_closed', sum(`fo_IMSControlCount`) as 'total_ims_controls_closed' from `summary_dashboard` where `fo_Section_Name` = '". $tn ."' and `ot_ap_Date` between '" . $startDate . "' and '". $endDate . "' group by `ot_ap_Date`";

    $res = sql($query, $eo);

            
    while($row = db_fetch_array($res)) {
        $output[] = array(
            'date'   => $row['date'],
            'total_count'  => intval($row['total_count']),
            'total_reviews_closed'  => intval($row['total_reviews_closed']),
            'total_approvals_closed'  => intval($row['total_approvals_closed']),
            'total_ims_controls_closed'  => intval($row['total_ims_controls_closed']),
        );
    }
    echo json_encode($output);
}
