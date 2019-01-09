<?php

require_once("header.php");
require_once "db_config.php";

$sql_stat = "SELECT * FROM `lockers`";
$result_stat = $connection -> query($sql_stat);
$numberOfUsersRow = $result_stat -> num_rows;


if (!$result_stat){
	die('Invalid query: ');
}

$locker1;
$locker2;
$locker3;
$locker4;

while($row = $result_stat->fetch_assoc()){
	if($row["locker_id"] == "1" && $row["status"] == "available"){
		$locker1 = "1";
	}
	 else if($row["locker_id"] == "1" && $row["status"] == "occupied"){
		$locker1 = "2";	
	}
	else if($row["locker_id"] == "1" && $row["status"] == "reserved"){
		$locker1 = "3";	
	} 
	//__________________________________________________________________
	if($row["locker_id"] == "2" && $row["status"] == "available"){
		$locker2 = "1";
	}
	else if($row["locker_id"] == "2" && $row["status"] == "occupied"){
		$locker2 = "2";	
	}
	else if($row["locker_id"] == "2" && $row["status"] == "reserved"){
		$locker2 = "3";	
	}
	//__________________________________________________________________
	if($row["locker_id"] == "3" && $row["status"] == "available"){
		$locker3 = "1";
	}
	else if($row["locker_id"] == "3" && $row["status"] == "occupied"){
		$locker3 = "2";	
	}
	else if($row["locker_id"] == "3" && $row["status"] == "reserved"){
		$locker3 = "3";	
	}
	//__________________________________________________________________
	if($row["locker_id"] == "4" && $row["status"] == "available"){
		$locker4 = "1";
	}
	else if($row["locker_id"] == "4" && $row["status"] == "occupied"){
		$locker4 = "2";	
	}
	else if($row["locker_id"] == "4" && $row["status"] == "reserved"){
		$locker4 = "3";	
	break;
	}
	
	
	
	
}//end while
	echo"*".$locker1.$locker2.$locker3.$locker4;


 
  ?>

