<?php


require_once("header.php");  
require_once "db_config.php";

date_default_timezone_set("Asia/Manila");
$currdate=date("Y-m-d");
$currtime=date("H:i:s");

$fieldToGet = $_GET['UID'];

$sql_cancel = "SELECT * FROM `transactions` WHERE status = \"reserved\" AND UID=\"$fieldToGet\"";
$result_cancel = $connection -> query($sql_cancel);
$numberOfUsersRow = $result_start -> num_rows;

if (!$result_cancel){
	die('Invalid query:');
}

$time_reserved1_now;
$time_reserved2_now;
$time_reserved3_now;
$time_reserved4_now;

				$sql_reserved1 = "SELECT * FROM `timers`";
				$result_reserved1 = $connection -> query($sql_reserved1);
				
				while($row4 = $result_reserved1->fetch_assoc()){	
					
					if($row4["user"]=="1"){
						$time_reserved1_now=$row4["reserved"];
						$time_logout1_now=$row4["logout"];
						//break;
					}
					if($row4["user"]=="2"){
						$time_reserved2_now=$row4["reserved"];
						$time_logout2_now=$row4["logout"];
						//break;
					}
					if($row4["user"]=="3"){
						$time_reserved3_now=$row4["reserved"];
						$time_logout3_now=$row4["logout"];
						//break;
					}
					if($row4["user"]=="4"){
						$time_reserved4_now=$row4["reserved"];
						$time_logout4_now=$row4["logout"];
						break;
					}
					else{}
				
				} 

while($row = $result_cancel->fetch_assoc()){
	
	if($row["UID"]== $fieldToGet && $row["locker_id"]=="1" && $row["status"] == "reserved"){
		
			$sql_C1T = "UPDATE transactions SET status ='cancelled' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C1T = $connection -> query($sql_C1T);	
							
			$sql_C1L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
			$result_C1L = $connection -> query($sql_C1L);
						
			$sql_C1U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1'";
			$result_C1U = $connection -> query($sql_C1U);
							
			$sql_C1TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='1'";
			$result_C1TI = $connection -> query($sql_C1TI);
			echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="2" && $row["status"] == "reserved"){
		
			$sql_C2T = "UPDATE transactions SET status ='cancelled' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C2T = $connection -> query($sql_C2T);	
							
			$sql_C2L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
			$result_C2L = $connection -> query($sql_C2L);
						
			$sql_C2U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='2'";
			$result_C2U = $connection -> query($sql_C2U);
							
			$sql_C2TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='2'";
			$result_C2TI = $connection -> query($sql_C2TI);
			echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="3" && $row["status"] == "reserved"){
		
			$sql_C3T = "UPDATE transactions SET status ='cancelled' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C3T = $connection -> query($sql_C3T);	
							
			$sql_C3L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
			$result_C3L = $connection -> query($sql_C3L);
						
			$sql_C3U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='3'";
			$result_C3U = $connection -> query($sql_C3U);
							
			$sql_C3TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='3'";
			$result_C3TI = $connection -> query($sql_C3TI);
			echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="4" && $row["status"] == "reserved"){
		
			$sql_C4T = "UPDATE transactions SET status ='cancelled' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C4T = $connection -> query($sql_C4T);	
							
			$sql_C4L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
			$result_C4L = $connection -> query($sql_C4L);
						
			$sql_C4U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='4'";
			$result_C4U = $connection -> query($sql_C4U);
							
			$sql_C4TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='4'";
			$result_C4TI = $connection -> query($sql_C4TI);
			echo"*U2";
	}
	else{
		
		//echo"*UN";
	}
}

?>