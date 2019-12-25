<?php
include("../defaultLang.php");
include("../language.php");
include("../lib.php");
// include(CALENDAR_PATH . 'container.php');

// $sql = "SELECT id, title, start, end, color FROM events ";
// $events = sql($sql,$eo);

try {
	$dbServer = config('dbServer');
    $dbUsername = config('dbUsername');
    $dbPassword = config('dbPassword');
    $dbDatabase = config('dbDatabase');
	$conn = new PDO('mysql:host='.$dbServer.';dbname='.$dbDatabase.';charset=utf8', $dbUsername, $dbPassword);
}
catch(Exception $e) {
    die('Erreur : '.$e->getMessage());
}
