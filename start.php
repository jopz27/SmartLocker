<?php


require_once("header.php");  
require_once "db_config.php";

date_default_timezone_set("Asia/Manila");
$currdate=date("Y-m-d");
$currtime=date("H:i:s");

$fieldToGet = $_GET['UID'];

$sql_start = "SELECT * FROM `transactions` WHERE status = \"reserved\" AND UID=\"$fieldToGet\"";
$result_start = $connection -> query($sql_start);
$numberOfUsersRow = $result_start -> num_rows;

if (!$result_start){
	die('Invalid query:');
}

$time_reserved1_now;
$time_reserved2_now;
$time_reserved3_now;
$time_reserved4_now;

$what_day;

	if((date("l") == "Saturday")){
		$what_day = "we";
	}
	else{
		$what_day = "wd";
	}

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

while($row = $result_start->fetch_assoc()){
	
	if($row["UID"]== $fieldToGet && $row["locker_id"]=="1" && $row["status"] == "reserved"){
		$id_num1 = $row["id_number"];
	 	
		$now_reserved1 = time();
		$timeSince_C1 = $now_reserved1-$time_reserved1_now;
						
		echo "C1:".$timeSince_C1;
		if($timeSince_C1 >=600){
			$sql_C1T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C1T = $connection -> query($sql_C1T);	
							
			$sql_C1L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
			$result_C1L = $connection -> query($sql_C1L);
						
			$sql_C1U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1' AND UID='$fieldToGet'";
			$result_C1U = $connection -> query($sql_C1U);
							
			$sql_C1TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='1'";
			$result_C1TI = $connection -> query($sql_C1TI);
			echo"*R7";
			
		}
		else{
			$sql_C1T = "UPDATE transactions SET status ='ongoing', occurence='1', date_in = '$currdate', time_in = '$currtime', day='$what_day' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C1T = $connection -> query($sql_C1T);	
			
			$sql_C1L = "UPDATE lockers SET status ='occupied', id_number= '$id_num1' WHERE locker_id='1'";
			$result_C1L = $connection -> query($sql_C1L);
			
			$sql_C1TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='1'";
			$result_C1TI = $connection -> query($sql_C1TI);
			echo"*U2";
		}
		break;
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="2" && $row["status"] == "reserved"){
		$id_num2 = $row["id_number"];
	 	
		$now_reserved2 = time();
		$timeSince_C2 = $now_reserved2-$time_reserved2_now;
						
		echo "C1:".$timeSince_C2;
		if($timeSince_C2 >=600){
			$sql_C2T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C2T = $connection -> query($sql_C2T);	
							
			$sql_C2L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
			$result_C2L = $connection -> query($sql_C2L);
						
			$sql_C2U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1' AND UID='$fieldToGet'";
			$result_C2U = $connection -> query($sql_C2U);
							
			$sql_C2TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='2'";
			$result_C2TI = $connection -> query($sql_C2TI);
			echo"*R7";
		}
		else{
			$sql_C2T = "UPDATE transactions SET status ='ongoing', occurence='1', date_in = '$currdate', time_in = '$currtime', day='$what_day' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C2T = $connection -> query($sql_C2T);	
			
			$sql_C2L = "UPDATE lockers SET status ='occupied', id_number= '$id_num2' WHERE locker_id='2'";
			$result_C2L = $connection -> query($sql_C2L);
			
			$sql_C2TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='2'";
			$result_C2TI = $connection -> query($sql_C2TI);
			echo"*U2";
		}
	 break;
	}
	
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="3" && $row["status"] == "reserved"){
		$id_num3 = $row["id_number"];
	 	
		$now_reserved3 = time();
		$timeSince_C3 = $now_reserved3-$time_reserved3_now;
						
		echo "C1:".$timeSince_C3;
		if($timeSince_C3 >=600){
			$sql_C3T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C3T = $connection -> query($sql_C3T);	
							
			$sql_C3L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
			$result_C3L = $connection -> query($sql_C3L);
						
			$sql_C3U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='3' AND UID='$fieldToGet'";
			$result_C3U = $connection -> query($sql_C3U);
							
			$sql_C3TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='3'";
			$result_C3TI = $connection -> query($sql_C3TI);
			echo"*R7";
		}
		else{
			$sql_C3T = "UPDATE transactions SET status ='ongoing', occurence='1', date_in = '$currdate', time_in = '$currtime', day='$what_day' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C3T = $connection -> query($sql_C3T);	
			
			$sql_C3L = "UPDATE lockers SET status ='occupied', id_number= '$id_num3' WHERE locker_id='3'";
			$result_C3L = $connection -> query($sql_C3L);
			
			$sql_C3TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='3'";
			$result_C3TI = $connection -> query($sql_C3TI);
			echo"*U2";
		}
	    break;
	}
	
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="4" && $row["status"] == "reserved"){
		$id_num4 = $row["id_number"];
	 	
		$now_reserved4 = time();
		$timeSince_C4 = $now_reserved4-$time_reserved4_now;
						
		echo "C1:".$timeSince_C4;
		if($timeSince_C4 >=600){
			$sql_C4T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C4T = $connection -> query($sql_C3T);	
							
			$sql_C4L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
			$result_C4L = $connection -> query($sql_C4L);
						
			$sql_C4U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='4' AND UID='$fieldToGet'";
			$result_C4U = $connection -> query($sql_C4U);
							
			$sql_C4TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='4'";
			$result_C4TI = $connection -> query($sql_C4TI);
			echo"*R7";
		}
		else{
			$sql_C4T = "UPDATE transactions SET status ='ongoing', occurence='1', date_in = '$currdate', time_in = '$currtime', day='$what_day' WHERE UID='$fieldToGet' AND status='reserved'";
			$result_C4T = $connection -> query($sql_C4T);	
			
			$sql_C4L = "UPDATE lockers SET status ='occupied', id_number= '$id_num4' WHERE locker_id='4'";
			$result_C4L = $connection -> query($sql_C4L);
			
			$sql_C4TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='4'";
			$result_C4TI = $connection -> query($sql_C4TI);
			echo"*U2";
		}
	break;
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="1" && $row["status"] == "ongoing"){
		 echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="2" && $row["status"] == "ongoing"){
		 echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="3" && $row["status"] == "ongoing"){
		 echo"*U2";
	}
	else if($row["UID"]== $fieldToGet && $row["locker_id"]=="4" && $row["status"] == "ongoing"){
		 echo"*U2";
	}
	else{
		echo"*UN";
	}
}

?>