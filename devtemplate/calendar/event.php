<?php
// url example: "calendar/event.php?from=1575129600000&to=1577808000000&utc_offset_from=-480&utc_offset_to=-480"

include_once("db_connect.php");
// $from = intval((intval($_GET["from"])/1000) + (intval($_GET["utc_offset_from"])*60));
$from = intval(intval($_GET["from"])/1000);
$to = intval(intval($_GET["to"])/1000);

$sql = "SELECT `id`, `title`, `start`, `end`, `tableName`, `pkValue`, `ot_ap_Approval` FROM `events` where (`start` >= from_unixtime($from) and coalesce(`end`, `start`) <= from_unixtime($to)) or (from_unixtime($from) between `start` and coalesce(`end`, `start`)) or (from_unixtime($to) between `start` and coalesce(`end`, `start`))";
$events = sql($sql, $eo);

$calendar = array();
while( $rows = db_fetch_row($events) ) {
    $start = ''; $end = ''; $tempStart = ''; $tempEnd = ''; $class = ''; $status = ''; $statusClass = ''; 
    switch ($rows[6]){
        case 1:
            $class = 'event-important';
            $status = 'Open';
            $statusClass = 'label label-light-danger';
            break;
        case 2:
            $class = 'event-info';
            $status = 'On Going';
            $statusClass = 'label label-light-megna';
            break;
        case 3:
            $class = 'event-warning';
            $status = 'Pending';
            $statusClass = 'label label-light-warning';
            break;
        case 4:
            $class = 'event-success';
            $status = 'Closed';
            $statusClass = 'label label-light-success';
            break;
        default:
            $class = 'event-inverse';
            $status = '';
            $statusClass = '';

    }

    // convert  date to milliseconds
    // if start timestamp is midnight
    if ( substr($rows[2],11,8) == '00:00:00' ) {
        $tempStart = substr($rows[2],0,10) . ' 00:00:00';
        $start = strtotime($rows[2]) * 1000;

        // if there is no end date, convert end date to start timestamp but hours set to 23:59:59
        if ( !isset($rows[3]) || empty($rows[3]) ){
            $tempEnd = substr($rows[2],0,10) . ' 23:59:59';
            $end = strtotime($tempEnd) * 1000;
        }
        // else if end timestamp is midnight for the same day, set it to 23:59:59 as well
        else if ( (substr($rows[2],0,10) == substr($rows[3],0,10)) && (substr($rows[3],11,8) == '00:00:00') ){
            $tempEnd = substr($rows[2],0,10) . ' 23:59:59';
            $end = strtotime($tempEnd) * 1000;
        }
        // else if end timestamp is midnight, then set it to 23:59:59
        else if ( (substr($rows[3],11,8) == '00:00:00') ){
            $tempEnd = substr($rows[3],0,10) . ' 23:59:59';
            $end = strtotime($tempEnd) * 1000;
        }
    }
    // else (i.e. for timestamps other than midnight) convert normally and set end to start + 1 hour if empty
    else{
        $start = strtotime($rows[2]) * 1000;
        $end = (isset($rows[3]) && !empty($rows[3])) ? strtotime($rows[3]) * 1000 : (strtotime($rows[2]) + 3600) * 1000;
    }
    
    $url = "";
    if(isset($rows[4]) && !empty($rows[4]) && isset($rows[5]) && !empty($rows[5])){
        $url = "".$rows[4]."_view.php?SelectedID=".$rows[5]."";
        switch ($rows[4]){
            case "Marketing":$class.=" glyphicon-record";break;
            case "InOutRegister":$class.=" glyphicon-stop";break;
            case "Audit":$class.=" glyphicon-triangle-top";break;
            case "projects":$class.=" glyphicon-star";break;
            case "Inquiry":$class.=" glyphicon-briefcase";break;
        }
    }
	$calendar[] = array(
        'id' => $rows[0],
        'title' => $rows[1],
        'titleAbbreviated' => substr($rows[1],0,20) . '...',
        'url' => "$url",
		"class" => $class,
        'start' => "$start",
        'end' => "$end",
        'status' => "$status",
        'statusClass' => "$statusClass"
    );
}
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
exit;
?>