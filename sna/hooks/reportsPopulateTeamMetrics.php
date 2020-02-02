<?php
    $_script_started = microtime(1);

    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
    $output = array();
    $memberInfo = getMemberInfo();
    
    // get team array
    $team_array_res = sql("SELECT DISTINCT `memberID`, `Name` from `employees`", $eo);
    $team_array = array();
    if (isset($team_array_res) && $team_array_res->num_rows > 0) {
        while($row = db_fetch_array($team_array_res)) {
            $team_array[] = $row;
        }
    }
    else{
        return;
    }

    $metric_array = array();

    foreach($team_array as $member){
        $metric_array[$member[0]] = array(
            "weekly_hours" => getWeeklyHoursEngaged($member[0]),
            "myWOCompleted" => getWeeklyTeamMetrics($member[0], 'myWOCompleted'),
            "myWOTotal" => getWeeklyTeamMetrics($member[0], 'myWOTotal'),
            "myWOAvgPerMonth" => getWeeklyTeamMetrics($member[0], 'myWOAvgPerMonth'),
            "myWOAvgCompTime" => getWeeklyTeamMetrics($member[0], 'myWOAvgCompTime'),
            "myWORating" => getWeeklyTeamMetrics($member[0], 'myWORating'),
            "myTaskRatingWeeklyAvg" => getWeeklyTeamMetrics($member[0], 'myTaskRatingWeeklyAvg'),
            "myTaskRatingMonthly" => getWeeklyTeamMetrics($member[0], 'myTaskRatingMonthly')
        );
        $insert_update_sql = "INSERT INTO `weekly_team_metrics` (`memberID`, `Name`, `weekly_hours`, `myWOCompleted`, `myWOTotal`, `myWOAvgPerMonth`, `myWOAvgCompTime`, `myWORating`, `myTaskRatingWeeklyAvg`, `myTaskRatingMonthly`)
        VALUES (" .
            "'" . $member[0] . "', " . 
            "'" . $member[1] . "', " . 
            "'" .  $metric_array[$member[0]]["weekly_hours"] . "', " . 
            ""  .  $metric_array[$member[0]]["myWOCompleted"] . ", " . 
            ""  .  $metric_array[$member[0]]["myWOTotal"] . ", " . 
            ""  .  $metric_array[$member[0]]["myWOAvgPerMonth"] . ", " . 
            "'" .  $metric_array[$member[0]]["myWOAvgCompTime"] . "', " . 
            ""  .  $metric_array[$member[0]]["myWORating"] . ", " . 
            ""  .  $metric_array[$member[0]]["myTaskRatingWeeklyAvg"] . ", " . 
            ""  .  $metric_array[$member[0]]["myTaskRatingMonthly"] .
        ") ON DUPLICATE KEY UPDATE " .
           "`memberID` = '" . $member[0] . "', " . 
           "`Name` = '" . $member[1] . "', " . 
           "`weekly_hours` = '" . $metric_array[$member[0]]["weekly_hours"] . "', " . 
           "`myWOCompleted` = " . $metric_array[$member[0]]["myWOCompleted"] . ", " . 
           "`myWOTotal` = " . $metric_array[$member[0]]["myWOTotal"] . ", " . 
           "`myWOAvgPerMonth` = " . $metric_array[$member[0]]["myWOAvgPerMonth"] . ", " . 
           "`myWOAvgCompTime` = '" . $metric_array[$member[0]]["myWOAvgCompTime"] . "', " . 
           "`myWORating` = " . $metric_array[$member[0]]["myWORating"] . ", " . 
           "`myTaskRatingWeeklyAvg` = " . $metric_array[$member[0]]["myTaskRatingWeeklyAvg"] . ", " . 
           "`myTaskRatingMonthly` = " . $metric_array[$member[0]]["myTaskRatingMonthly"] . ", " . 
           "`last_updated` = CURRENT_TIMESTAMP";
        sql($insert_update_sql, $eo);

    }

    $_page_time_seconds = microtime(1) - $_script_started;
    echo 'Weekly team metrics successfully refreshed (time taken: '. $_page_time_seconds . ' seconds).';
?>	


 


