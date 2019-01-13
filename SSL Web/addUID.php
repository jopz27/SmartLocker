<?php


require_once("header.php");  
require_once "db_config.php";

date_default_timezone_set("Asia/Manila");
$currdate=date("Y-m-d");
$currtime=date("H:i:s");

$fieldToGet = $_GET['UID'];

$sql_start = "SELECT * FROM `UIDS`";
$result_start = $connection -> query($sql_start);
$numberOfUsersRow = $result_start -> num_rows;

if (!$result_start){
	die('Invalid query:');
}


while($row = $result_start->fetch_assoc()){
	
	$sql_add = "INSERT INTO UIDS(UID) 
				VALUES('$fieldToGet')";
	$result_start = $connection -> query($sql_add);
	
	
}

?>