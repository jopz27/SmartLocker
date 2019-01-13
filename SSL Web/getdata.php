<?php



//define this page as restricted
//define( 'RESTRICTED', true );

require_once("header.php");
    
//require database details
require_once "db_config.php";



$fieldToGet = $_GET['UID'];
$checker = $_GET['check'];

$ID_temp1;
$ID_temp2;
$ID_temp3;
$ID_temp4;

$ID_C1;
$ID_C2;
$ID_C3;
$ID_C4;

$locker1=0;
$locker2=0;
$locker3=0;
$locker4=0;

$onsite_locker="";
$onsite_name="";
$onsite_UID="";
$onsite_id="";
$onsite_status="";
$onsite_occurence="";


$time_logout1_now;
$time_logout2_now;
$time_logout3_now;
$time_logout4_now;

$time_reserved1_now;
$time_reserved2_now;
$time_reserved3_now;
$time_reserved4_now;


$send_sms=0;

$now;
$timeSince;

$passcode;
$onsite=0;
$sql = "SELECT * FROM `users` WHERE UID = \"$fieldToGet\"";
//$sql = "SELECT * FROM `users`";
$result = $connection -> query($sql);
$numberOfUsersRow = $result -> num_rows;

date_default_timezone_set("Asia/Manila");
$currdate=date("Y-m-d");
$currtime=date("H:i:s");

if (!$result){
	die('Invalid query: ');

}

if($checker=="ok"){
	function clean($string) {
		$string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);// Removes special chars.
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
		//1524118727
		
		$sql_check = "SELECT * FROM `transactions`";
		$result_check = $connection -> query($sql_check);
		
		while($row = $result_check->fetch_assoc()){			
				
			//___________________________________________________________________________________
			//___________________________________________________________________________________LOGOUT COUNTDOWN
			if($row["locker_id"]=="1" && $row["occurence"] == "2" && $row["status"] == "ongoing"){
				$ID_temp1 = $row["UID"];
					
					$now_logout1 = time();
					$timeSince_E1 = $now_logout1-$time_logout1_now;
					
					echo "E1:".$timeSince_E1;
					if($timeSince_E1 >=30){
						
							$sql_finished1 = "UPDATE transactions SET status ='finished', 
											  date_out='$currdate', time_out='$currtime'
											  WHERE UID='$ID_temp1' AND status='ongoing'";
							$result_finished1 = $connection -> query($sql_finished1);	
							
							$sql_locker1 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
							$result_locker1 = $connection -> query($sql_locker1);
							
							$sql_user1 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1'";
							$result_user1 = $connection -> query($sql_user1);
							
							$sql_timer1 = "UPDATE timers SET logout ='0' WHERE user='1'";
							$result_timer1 = $connection -> query($sql_timer1);
							echo"Done1";	
					}
			}
			//__________________________________________________________________________________________________________
		 	if($row["locker_id"]=="2" && $row["occurence"] == "2" && $row["status"] == "ongoing"){
				$ID_temp2 = $row["UID"];
				
					$now_logout2 = time();
					$timeSince_E2 = $now_logout2-$time_logout2_now;
					
					echo "E2:".$timeSince_E2;
					if($timeSince_E2 >=30){
							$sql_finished2 = "UPDATE transactions SET status ='finished',
											  date_out='$currdate', time_out='$currtime'
											  WHERE UID='$ID_temp2' AND status='ongoing'";
							$result_finished2 = $connection -> query($sql_finished2);	
							
							$sql_locker2 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
							$result_locker2 = $connection -> query($sql_locker2);
							
							$sql_user2 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='2'";
							$result_user2 = $connection -> query($sql_user2);
							
							$sql_timer2 = "UPDATE timers SET logout ='0' WHERE user='2'";
							$result_timer2 = $connection -> query($sql_timer2);
							echo"Done2";
					}
			} 

			//_________________________________________________________________________________________________________________
			if($row["locker_id"]=="3" && $row["occurence"] == "2" && $row["status"] == "ongoing"){
				$ID_temp3 = $row["UID"];
					
					$now_logout3 = time();
					$timeSince_E3 = $now_logout3-$time_logout3_now;
		
					echo "E3:".$timeSince_E3;
					if($timeSince_E3 >=30){
							$sql_finished3 = "UPDATE transactions SET status ='finished',
											  date_out='$currdate', time_out='$currtime'
											  WHERE UID='$ID_temp3'AND status='ongoing'";
							$result_finished3 = $connection -> query($sql_finished3);	
							
							$sql_locker3 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
							$result_locker3 = $connection -> query($sql_locker3);
							
							$sql_user3 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='3'";
							$result_user3 = $connection -> query($sql_user3);
							
							$sql_timer3 = "UPDATE timers SET logout ='0' WHERE user='3'";
							$result_timer3 = $connection -> query($sql_timer3);
							echo"Done3";
					}
			}
			//________________________________________________________________________________________________________________
			if($row["locker_id"]=="4" && $row["occurence"] == "2" && $row["status"] == "ongoing"){
				$ID_temp4 = $row["UID"];
					
					$now_logout4 = time();
					$timeSince_E4 = $now_logout4-$time_logout4_now;
		
					echo "E4:".$timeSince_E4;
					if($timeSince_E4 >=30){
							$sql_finished4 = "UPDATE transactions SET status ='finished',
											  date_out='$currdate', time_out='$currtime'
											  WHERE UID='$ID_temp4' AND status='ongoing'";
							$result_finished4 = $connection -> query($sql_finished4);	
							
							$sql_locker4 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
							$result_locker4 = $connection -> query($sql_locker4);
							
							$sql_user4 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='4'";
							$result_user4 = $connection -> query($sql_user4);
							
							$sql_timer4 = "UPDATE timers SET logout ='0' WHERE user='4'";
							$result_timer4 = $connection -> query($sql_timer4);
							echo"Done4";
					}
			}
			//________________________________________________________________________________________________
			//________________________________________________________________________________________________RESERVE COUNTDOWN
			 
			 if($row["locker_id"]=="1" && $row["status"] == "reserved"){
				$ID_C1=$row["UID"];
				
					$now_reserved1 = time();							//get current time
					$timeSince_C1 = $now_reserved1-$time_reserved1_now; //subtract current time to reserved time//incrementing
					
					$fin_res1 = strtotime(date("00:10:00"));			//set time example 1 minute countdown
					
					$minus1 = $fin_res1-$timeSince_C1;					//subtract expected expire time 1 minute to incrementing time since reserved//decrement
					
					$reserved_C1 = gmdate("i:s",$minus1);				//convert decrement time to readable timestamp.					
						
						echo "C1:".$timeSince_C1;
						if($timeSince_C1 >=600){							//incrementing ang e compare dili ang countdown para sayon
							$sql_C1T = "UPDATE transactions SET status ='expired' WHERE UID='$ID_C1' AND status='reserved'";
							$result_C1T = $connection -> query($sql_C1T);	
							
							$sql_C1L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
							$result_C1L = $connection -> query($sql_C1L);
							
							$sql_C1U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1'";
							$result_C1U = $connection -> query($sql_C1U);
							
							$sql_C1TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='1'";
							$result_C1TI = $connection -> query($sql_C1TI);
							echo"DoneC1";
						}
						else{
							$sql_C1T = "UPDATE timers SET remaining ='$reserved_C1' WHERE user='1'";
							$result_C1T = $connection -> query($sql_C1T);
							
						}
			}
			//___________________________________________________________________________________________________
			if($row["locker_id"]=="2" && $row["status"] == "reserved"){
				$ID_C2=$row["UID"];
			
					$now_reserved2 = time();
					$timeSince_C2 = $now_reserved2-$time_reserved2_now;
					
					$fin_res2 = strtotime(date("00:10:00"));			//set time example 1 minute countdown
					
					$minus2 = $fin_res2-$timeSince_C2;					//subtract expected expire time 1 minute to incrementing time since reserved//decrement
					
					$reserved_C2 = gmdate("i:s",$minus2);


					
						echo "C2:".$timeSince_C2;
						if($timeSince_C2 >=600){
							$sql_C2T = "UPDATE transactions SET status ='expired' WHERE UID='$ID_C2' AND status='reserved'";
							$result_C2T = $connection -> query($sql_C2T);	
							
							$sql_C2L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
							$result_C2L = $connection -> query($sql_C2L);
							
							$sql_C2U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='2'";
							$result_C2U = $connection -> query($sql_C2U);
							
							$sql_C2TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='2'";
							$result_C2TI = $connection -> query($sql_C2TI);
							echo"DoneC2";
						}
						else{
							$sql_C2T = "UPDATE timers SET remaining ='$reserved_C2' WHERE user='2'";
							$result_C2T = $connection -> query($sql_C2T);
							
						}
			}
			//_____________________________________________________________________________________________
			if($row["locker_id"]=="3" && $row["status"] == "reserved"){
				$ID_C3=$row["UID"];
				
					$now_reserved3 = time();
					$timeSince_C3 = $now_reserved3-$time_reserved3_now;
					
					$fin_res3 = strtotime(date("00:10:00"));			//set time example 1 minute countdown
					
					$minus3 = $fin_res3-$timeSince_C3;					//subtract expected expire time 1 minute to incrementing time since reserved//decrement
					
					$reserved_C3 = gmdate("i:s",$minus3);
					
						echo "C3:".$timeSince_C3;
						if($timeSince_C3 >=600){
							$sql_C3T = "UPDATE transactions SET status ='expired' WHERE UID='$ID_C3' AND status='reserved'";
							$result_C3T = $connection -> query($sql_C3T);	
							
							$sql_C3L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
							$result_C3L = $connection -> query($sql_C3L);
							
							$sql_C3U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='3'";
							$result_C3U = $connection -> query($sql_C3U);
							
							$sql_C3TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='3'";
							$result_C3TI = $connection -> query($sql_C3TI);
							echo"DoneC3";
						}
						else{
							$sql_C3T = "UPDATE timers SET remaining ='$reserved_C3' WHERE user='3'";
							$result_C3T = $connection -> query($sql_C3T);
							
						}		
			}
			//_____________________________________________________________________________________________
			if($row["locker_id"]=="4" && $row["status"] == "reserved"){
				$ID_C4=$row["UID"];
					
					$now_reserved4 = time();
					$timeSince_C4 = $now_reserved4-$time_reserved4_now;
					
					$fin_res4 = strtotime(date("00:10:00"));			//set time example 1 minute countdown
					
					$minus4 = $fin_res4-$timeSince_C4;					//subtract expected expire time 1 minute to incrementing time since reserved//decrement
					
					$reserved_C4 = gmdate("i:s",$minus4);
					
						echo "C4:".$timeSince_C4;
						if($timeSince_C4 >=600){
							$sql_C4T = "UPDATE transactions SET status ='expired' WHERE UID='$ID_C4' AND status='reserved'";
							$result_C4T = $connection -> query($sql_C4T);	
							
							$sql_C4L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
							$result_C4L = $connection -> query($sql_C4L);
							
							$sql_C4U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='4'";
							$result_C4U = $connection -> query($sql_C4U);
							
							$sql_C4TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='4'";
							$result_C4TI = $connection -> query($sql_C4TI);
							echo"DoneC4";
						}
						else{
							$sql_C4T = "UPDATE timers SET remaining ='$reserved_C4' WHERE user='4'";
							$result_C4T = $connection -> query($sql_C4T);
							
						}
			
			}
			//________________________________________________________________________________________________
			//________________________________________________________________________________________________//PENALTY START//_____________________________1
			if($row["locker_id"]=="1" && $row["occurence"] == "1" && $row["status"] == "ongoing"){
				$ID_temp1=$row["UID"];
				$date_in1=$row["date_in"];
					
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:58:00")) && $row["sms_warning"]==NULL){
							$send_sms=1;
							$sql_penalty_count1 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp1' AND status='ongoing'";
							$result_penalty_count1 = $connection -> query($sql_penalty_count1);
					}
					else if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:59:00")) && ($row["penalty_count"]==NULL)){
					
							$start_penalty1=strtotime(date("$date_in1 23:59:00"));
							
							$now1 = time();
							$start_penalty1_hr = $now1 - $start_penalty1;
									
							$penalty1 = gmdate("z:H:i:s",$start_penalty1_hr);
							
												 
							$sql_penalty_count1 = "UPDATE transactions SET penalty_count ='$start_penalty1' WHERE UID='$ID_temp1' AND status='ongoing'";
							$result_penalty_count1 = $connection -> query($sql_penalty_count1);	
							
							$sql_penalty1 = "SELECT * FROM `users`";
							$result_penalty1 = $connection -> query($sql_penalty1);
							
							$sql_penalty11 = "UPDATE users SET start_penalty='$start_penalty1', penalty='$penalty1' WHERE UID='$ID_temp1'";
							$result_penalty11 = $connection -> query($sql_penalty11);
					}
					else if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty1 = "SELECT * FROM `users`";
							$result_penalty1 = $connection -> query($sql_penalty1);
							
							while($row1 = $result_penalty1->fetch_assoc()){	
								if($row1["UID"]==$ID_temp1){
									$time_in1 = $row1["start_penalty"];
									$now1 = time();
									$start_penalty1_hr = $now1 - $time_in1;
									
									$penalty1 = gmdate("z:H:i:s",$start_penalty1_hr);
									
									$sql_penalty11 = "UPDATE users SET run_penalty='$start_penalty1_hr',penalty='$penalty1' WHERE UID='$ID_temp1'";
									$result_penalty11 = $connection -> query($sql_penalty11);
								}
							}
					}
					//___________________________________________________________________________________________________________________________________Weekend1
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:10:30")) && $row["sms_warning"]==NULL){
							$send_sms=1;
							$sql_penalty_count1 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp1' AND status='ongoing'";
							$result_penalty_count1 = $connection -> query($sql_penalty_count1);
					}
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:59:00")) && ($row["penalty_count"]==NULL)){
					
							$start_penalty1=strtotime(date("$date_in1 23:59:00"));
							
							$now1 = time();
							$start_penalty1_hr = $now1 - $start_penalty1;
									
							$penalty1 = gmdate("z:H:i:s",$start_penalty1_hr);
							
												 
							$sql_penalty_count1 = "UPDATE transactions SET penalty_count ='$start_penalty1' WHERE UID='$ID_temp1' AND status='ongoing'";
							$result_penalty_count1 = $connection -> query($sql_penalty_count1);	
							
							$sql_penalty1 = "SELECT * FROM `users`";
							$result_penalty1 = $connection -> query($sql_penalty1);
							
							$sql_penalty11 = "UPDATE users SET start_penalty='$start_penalty1', penalty='$penalty1' WHERE UID='$ID_temp1'";
							$result_penalty11 = $connection -> query($sql_penalty11);
					}
					else if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in1-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty1 = "SELECT * FROM `users`";
							$result_penalty1 = $connection -> query($sql_penalty1);
							
							while($row1 = $result_penalty1->fetch_assoc()){	
								if($row1["UID"]==$ID_temp1){
									$time_in1 = $row1["start_penalty"];
									$now1 = time();
									$start_penalty1_hr = $now1 - $time_in1;
									
									$penalty1 = gmdate("z:H:i:s",$start_penalty1_hr);
									
									$sql_penalty11 = "UPDATE users SET run_penalty='$start_penalty1_hr',penalty='$penalty1' WHERE UID='$ID_temp1'";
									$result_penalty11 = $connection -> query($sql_penalty11);
								}
							}
					}
				
					
			}
			//____________________________________________________________________________________________________________________________________________2
			if($row["locker_id"]=="2" && $row["occurence"] == "1" && $row["status"] == "ongoing"){
				$ID_temp2=$row["UID"];
				$date_in2=$row["date_in"];	
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:58:00")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count2 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp2' AND status='ongoing'";
							$result_penalty_count2 = $connection -> query($sql_penalty_count2);
					}
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty2=strtotime(date("$date_in2 23:59:00"));
							
							$now2 = time();
							$start_penalty2_hr = $now2 - $start_penalty2;
									
							$penalty2 = gmdate("z:H:i:s",$start_penalty2_hr);
							
							
							$sql_penalty_count2 = "UPDATE transactions SET penalty_count ='$start_penalty2' WHERE UID='$ID_temp2' AND status='ongoing'";
							$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
							
							$sql_penalty2 = "SELECT * FROM `users`";
							$result_penalty2 = $connection -> query($sql_penalty2);
							
							$sql_penalty21 = "UPDATE users SET start_penalty='$start_penalty2', penalty='$penalty2' WHERE UID='$ID_temp2'";
							$result_penalty21 = $connection -> query($sql_penalty21);
					}
					else if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty2 = "SELECT * FROM `users`";
							$result_penalty2 = $connection -> query($sql_penalty2);
							
							while($row1 = $result_penalty2->fetch_assoc()){	
								if($row1["UID"]==$ID_temp2){
									$time_in2 = $row1["start_penalty"];
									$now2 = time();
									$start_penalty2_hr = $now2 - $time_in2;
									
									$penalty2 = gmdate("z:H:i:s",$start_penalty2_hr);
									
									$sql_penalty21 = "UPDATE users SET run_penalty='$start_penalty2_hr',penalty='$penalty2' WHERE UID='$ID_temp2'";
									$result_penalty21 = $connection -> query($sql_penalty21);
								}
							}
					}
					//___________________________________________________________________________________________________________________________________Weekend2
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:10:30")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count2 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp2' AND status='ongoing'";
							$result_penalty_count2 = $connection -> query($sql_penalty_count2);
					}
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty2=strtotime(date("$date_in2 23:59:00"));
							
							$now2 = time();
							$start_penalty2_hr = $now2 - $start_penalty2;
									
							$penalty2 = gmdate("z:H:i:s",$start_penalty2_hr);
							
							
							$sql_penalty_count2 = "UPDATE transactions SET penalty_count ='$start_penalty2' WHERE UID='$ID_temp2' AND status='ongoing'";
							$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
							
							$sql_penalty2 = "SELECT * FROM `users`";
							$result_penalty2 = $connection -> query($sql_penalty2);
							
							$sql_penalty21 = "UPDATE users SET start_penalty='$start_penalty2', penalty='$penalty2' WHERE UID='$ID_temp2'";
							$result_penalty21 = $connection -> query($sql_penalty21);
					}
					else if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in2-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty2 = "SELECT * FROM `users`";
							$result_penalty2 = $connection -> query($sql_penalty2);
							
							while($row1 = $result_penalty2->fetch_assoc()){	
								if($row1["UID"]==$ID_temp2){
									$time_in2 = $row1["start_penalty"];
									$now2 = time();
									$start_penalty2_hr = $now2 - $time_in2;
									
									$penalty2 = gmdate("z:H:i:s",$start_penalty2_hr);
									
									$sql_penalty21 = "UPDATE users SET run_penalty='$start_penalty2_hr',penalty='$penalty2' WHERE UID='$ID_temp2'";
									$result_penalty21 = $connection -> query($sql_penalty21);
								}
							}
					}
				
			}
			//____________________________________________________________________________________________________________________________________________3
			if($row["locker_id"]=="3" && $row["occurence"] == "1" && $row["status"] == "ongoing"){
				$ID_temp3=$row["UID"];
				$date_in3=$row["date_in"];	
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:58:00")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count3 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp3' AND status='ongoing'";
							$result_penalty_count3 = $connection -> query($sql_penalty_count3);
					}
					
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty3=strtotime(date("$date_in3 23:59:00"));
							
							$now3 = time();
							$start_penalty3_hr = $now3 - $start_penalty3;
									
							$penalty3 = gmdate("z:H:i:s",$start_penalty3_hr);
							
							
							$sql_penalty_count3 = "UPDATE transactions SET penalty_count ='$start_penalty3' WHERE UID='$ID_temp3' AND status='ongoing'";
							$result_penalty_count3 = $connection -> query($sql_penalty_count3);	
							
							$sql_penalty3 = "SELECT * FROM `users`";
							$result_penalty3 = $connection -> query($sql_penalty3);
							
							$sql_penalty31 = "UPDATE users SET start_penalty='$start_penalty3', penalty='$penalty3' WHERE UID='$ID_temp3'";
							$result_penalty31 = $connection -> query($sql_penalty31);
					}
					else if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty3 = "SELECT * FROM `users`";
							$result_penalty3 = $connection -> query($sql_penalty3);
							
							while($row1 = $result_penalty3->fetch_assoc()){	
								if($row1["UID"]==$ID_temp3){
									$time_in3 = $row1["start_penalty"];
									$now3 = time();
									$start_penalty3_hr = $now3 - $time_in3;
									
									$penalty3 = gmdate("z:H:i:s",$start_penalty3_hr);
									
									$sql_penalty31 = "UPDATE users SET run_penalty='$start_penalty3_hr',penalty='$penalty3' WHERE UID='$ID_temp3'";
									$result_penalty31 = $connection -> query($sql_penalty31);
								}
							}
					}
					//___________________________________________________________________________________________________________________________________Weekend3
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:10:30")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count3 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp3' AND status='ongoing'";
							$result_penalty_count3 = $connection -> query($sql_penalty_count3);
					}
					
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty3=strtotime(date("$date_in3 23:59:00"));
							
							$now3 = time();
							$start_penalty3_hr = $now3 - $start_penalty3;
									
							$penalty3 = gmdate("z:H:i:s",$start_penalty3_hr);
							
							
							$sql_penalty_count3 = "UPDATE transactions SET penalty_count ='$start_penalty3' WHERE UID='$ID_temp3' AND status='ongoing'";
							$result_penalty_count3 = $connection -> query($sql_penalty_count3);	
							
							$sql_penalty3 = "SELECT * FROM `users`";
							$result_penalty3 = $connection -> query($sql_penalty3);
							
							$sql_penalty31 = "UPDATE users SET start_penalty='$start_penalty3', penalty='$penalty3' WHERE UID='$ID_temp3'";
							$result_penalty31 = $connection -> query($sql_penalty31);
					}
					else if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in3-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty3 = "SELECT * FROM `users`";
							$result_penalty3 = $connection -> query($sql_penalty3);
							
							while($row1 = $result_penalty3->fetch_assoc()){	
								if($row1["UID"]==$ID_temp3){
									$time_in3 = $row1["start_penalty"];
									$now3 = time();
									$start_penalty3_hr = $now3 - $time_in3;
									
									$penalty3 = gmdate("z:H:i:s",$start_penalty3_hr);
									
									$sql_penalty31 = "UPDATE users SET run_penalty='$start_penalty3_hr',penalty='$penalty3' WHERE UID='$ID_temp3'";
									$result_penalty31 = $connection -> query($sql_penalty31);
								}
							}
					}
				
			}
			//_______________________________________________________________________________________________________________________________________4
			if($row["locker_id"]=="4" && $row["occurence"] == "1" && $row["status"] == "ongoing"){
				$ID_temp4=$row["UID"];
				$date_in4=$row["date_in"];	
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:58:00")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count4 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp4' AND status='ongoing'";
							$result_penalty_count4 = $connection -> query($sql_penalty_count4);
					}
					if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty4=strtotime(date("$date_in4 23:59:00"));
							
							$now4 = time();
							$start_penalty4_hr = $now4 - $start_penalty4;
									
							$penalty4 = gmdate("z:H:i:s",$start_penalty4_hr);
							
							
							$sql_penalty_count4 = "UPDATE transactions SET penalty_count ='$start_penalty4' WHERE UID='$ID_temp4' AND status='ongoing'";
							$result_penalty_count4 = $connection -> query($sql_penalty_count4);	
							
							$sql_penalty4 = "SELECT * FROM `users`";
							$result_penalty4 = $connection -> query($sql_penalty4);
							
							$sql_penalty41 = "UPDATE users SET start_penalty='$start_penalty4', penalty='$penalty4' WHERE UID='$ID_temp4'";
							$result_penalty41 = $connection -> query($sql_penalty41);
					}
					else if((date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty4 = "SELECT * FROM `users`";
							$result_penalty4 = $connection -> query($sql_penalty4);
							
							while($row1 = $result_penalty4->fetch_assoc()){	
								if($row1["UID"]==$ID_temp4){
									$time_in4 = $row1["start_penalty"];
									$now4 = time();
									$start_penalty4_hr = $now4 - $time_in4;
									
									$penalty4 = gmdate("z:H:i:s",$start_penalty4_hr);
									
									$sql_penalty41 = "UPDATE users SET run_penalty='$start_penalty4_hr',penalty='$penalty4' WHERE UID='$ID_temp4'";
									$result_penalty41 = $connection -> query($sql_penalty41);
								}
							}
					}
					//___________________________________________________________________________________________________________________________________Weekend4
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:10:30")) && $row["sms_warning"]==NULL){
							//echo"Weekdays";
							$send_sms=1;
							$sql_penalty_count4 = "UPDATE transactions SET sms_warning ='1' WHERE UID='$ID_temp4' AND status='ongoing'";
							$result_penalty_count4 = $connection -> query($sql_penalty_count4);
					}
					if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:59:00")) && ($row["penalty_count"]==NULL)){
							
							$start_penalty4=strtotime(date("$date_in4 23:59:00"));
							
							$now4 = time();
							$start_penalty4_hr = $now4 - $start_penalty4;
									
							$penalty4 = gmdate("z:H:i:s",$start_penalty4_hr);
							
							
							$sql_penalty_count4 = "UPDATE transactions SET penalty_count ='$start_penalty4' WHERE UID='$ID_temp4' AND status='ongoing'";
							$result_penalty_count4 = $connection -> query($sql_penalty_count4);	
							
							$sql_penalty4 = "SELECT * FROM `users`";
							$result_penalty4 = $connection -> query($sql_penalty4);
							
							$sql_penalty41 = "UPDATE users SET start_penalty='$start_penalty4', penalty='$penalty4' WHERE UID='$ID_temp4'";
							$result_penalty41 = $connection -> query($sql_penalty41);
					}
					else if((date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in4-23:59:00")) && ($row["penalty_count"]!=NULL)){
					
							$sql_penalty4 = "SELECT * FROM `users`";
							$result_penalty4 = $connection -> query($sql_penalty4);
							
							while($row1 = $result_penalty4->fetch_assoc()){	
								if($row1["UID"]==$ID_temp4){
									$time_in4 = $row1["start_penalty"];
									$now4 = time();
									$start_penalty4_hr = $now4 - $time_in4;
									
									$penalty4 = gmdate("z:H:i:s",$start_penalty4_hr);
									
									$sql_penalty41 = "UPDATE users SET run_penalty='$start_penalty4_hr',penalty='$penalty4' WHERE UID='$ID_temp4'";
									$result_penalty41 = $connection -> query($sql_penalty41);
								}
							}
					}
				
			}
			//else {break;}
			
			
		}//end while
			//_____________________________________________________________________________________
			//_____________________________________________________________________________________PENALTY COUNTDOWN
			
			$sql_penalty_countdown = "SELECT * FROM `users` WHERE clear_penalty = \"1\"";
			$result_penalty_countdown = $connection -> query($sql_penalty_countdown);
				
			while($row5 = $result_penalty_countdown->fetch_assoc()){
				
				if($row5["clear_penalty"]=="1"){
					$penalty_UID1 = $row5["UID"];
					$fin_pen1 = $row5["fin_penalty"];//time from set time ex 9pm to logout time
					$min1 = $row5["run_penalty"];	//logout time with penalty
					$penalty_fin1 = $row5["penalty"];//coverted final time
					$now=time();
					
					$timeSince1 = $now-$min1; // subtract logout time with current time to get time since logout.
					
					$minutes = $fin_pen1 / 60; // divide total time from start time penalty(ex 9pm) to logout time by 60 to get number of minutes
					$hour = $minutes / 60;	   // divide number of minutes by 60 to get number of hours
					$total_penalty = $hour * 24;//1 hour = day penalty ratio
					$minutes_done = $total_penalty * 60; //get the calculated penalty and multiply by 60 to get minutes
					$seconds_done = $minutes_done * 60;  //multiply minutes of calculated penalty by 60 to get seconds, need seconds to subtrace unix time
						
					
					
					
					
					$sec_new = $seconds_done - $timeSince1;//subtract time since logout to calculated penalty in seconds to get remaining time
					
					
					
					
					//$dtF = new \DateTime('@0');
					//$dtT = new \DateTime("@$sec_new");
					//$penalty1 = $dtF->diff($dtT)->format('%a:%h:%i:%s');
					$penalty1 = gmdate("z:H:i:s",$sec_new);	//convert into 00:00:00:00
		
					if($sec_new <= 0){//if calculated penalty is 0
						
						$sql_penalty1 = "UPDATE users SET penalty='00:00:00:00',
										 start_penalty='0', run_penalty='0',fin_penalty='0',
										 clear_penalty='0',final='00:00:00:00',calculatedPenalty_seconds='0' WHERE UID='$penalty_UID1'";
						$result_penalty1 = $connection -> query($sql_penalty1);
						
						$sql_penalty_count2 = "UPDATE transactions SET penalty_count ='0' WHERE UID='$penalty_UID1'";
						$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
					}
					else{//update remaining time
						$sql_penalty1 = "UPDATE users SET penalty='$penalty1' WHERE UID='$penalty_UID1'";
						$result_penalty1 = $connection -> query($sql_penalty1);
					}
					
					
					
					
					echo"remaining:".$penalty1;
					//echo"remaining:".$sec_new;
					//echo"timesince:".$timeSince1;
					//echo"fin:".$fin_pen1;
					
					
				}
					
			}	
		if($send_sms == 1){
			echo"*UX";
		}
		else{
			echo"*U1";
		}
}
else if($result->num_rows == 0){
		echo"*R6";	
}


while($row = $result->fetch_assoc()){//check reservation
	if(($fieldToGet == $row["UID"]) &&($row["active"]=="no")  && 
		(((date("l") != "Saturday") && (date("H:i:s") < date("23:59:00"))) || 
		((date("l") == "Saturday") && (date("H:i:s") < date("23:59:00"))) )){//on site reserve
		
		//if($row["clear_penalty"]=="1"){

			$fin_pen1 = $row["fin_penalty"];//time from set to logout
			$min1 = $row["run_penalty"];	//logout time//use as base time to get seconds
			$now=time();
					
			$timeSince1 = $now-$min1;
					
			$minutes = $fin_pen1 / 60;
			$hour = $minutes / 60;
			$total_penalty = $hour * 24;//1 hour = day
			$minutes_done = $total_penalty * 60;
			$seconds_done = $minutes_done * 60;
						
		
				$sec_new = $seconds_done - $timeSince1;
				$penalty1 = gmdate("z:H:i:s",$sec_new);		
						
				if($sec_new <= 0){
							
					$sql_penalty1 = "UPDATE users SET penalty='00:00:00:00',
									 start_penalty='0', run_penalty='0',fin_penalty='0',
									 clear_penalty='0', calculatedPenalty_seconds = '0', final='0' WHERE UID='$fieldToGet'";
					$result_penalty1 = $connection -> query($sql_penalty1);
							
					$sql_penalty_count2 = "UPDATE transactions SET penalty_count ='0' WHERE UID='$fieldToGet' AND status = 'finished'";
					$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
				
					
					
					$onsite_name = $row["name"];
					$onsite_UID = $row["UID"];
					$onsite_id = $row["id_number"];
				
					$sql_onsite_select = "SELECT * FROM `lockers`";
					$result_onsite_select = $connection -> query($sql_onsite_select);	
								
					while($row3 = $result_onsite_select->fetch_assoc()){
						if($row3["status"]=="available"){//if available locker, get locker number and reserve
								
								$onsite_locker = $row3["locker_id"];
								
								//mao ni ma mga value ma insert inig reserved onsite or mobile reservation
								$sql_add = "INSERT INTO transactions(UID, id_number, name, locker_id, reserved_date, reserved_time, status, occurence, way) 
											VALUES('$onsite_UID', '$onsite_id', '$onsite_name', '$onsite_locker', '$currdate', '$currtime', 'reserved', '0','onsite')";
								$result_add = $connection -> query($sql_add);	
								
								$sql_yes = "UPDATE users SET active ='yes', locker_id='$onsite_locker' WHERE UID='$fieldToGet'";
								$result_yes = $connection -> query($sql_yes);	
								 
								$sql_update_locker = "UPDATE lockers SET status ='reserved', id_number='$onsite_id' WHERE locker_id='$onsite_locker'";
								$result_update_locker = $connection -> query($sql_update_locker);	
								
								echo"*R".$onsite_locker;

								//___________________________________________________________________
								//insert current time to reserved column
								if($row3["locker_id"]=="1"){
									
									$time_reserved1_now = time();
	
									$sql_reserved1 = "UPDATE timers SET reserved='$time_reserved1_now',remaining = '09:59' WHERE user='1'";
									$result_reserved1 = $connection -> query($sql_reserved1);
					
									break;
								}
								if($row3["locker_id"]=="2"){
									
									$time_reserved2_now = time();
									
									$sql_reserved2 = "UPDATE timers SET reserved='$time_reserved2_now',remaining = '09:59' WHERE user='2'";
									$result_reserved2 = $connection -> query($sql_reserved2);
									
									break;
								}
								if($row3["locker_id"]=="3"){
									
									$time_reserved3_now = time();
									
									$sql_reserved3 = "UPDATE timers SET reserved='$time_reserved3_now',remaining = '09:59' WHERE user='3'";
									$result_reserved3 = $connection -> query($sql_reserved3);
									
									break;
								}
								if($row3["locker_id"]=="4"){
									
									$time_reserved4_now = time();
									
									$sql_reserved4 = "UPDATE timers SET reserved='$time_reserved4_now',remaining = '09:59' WHERE user='4'";
									$result_reserved4 = $connection -> query($sql_reserved4);
									
									break;
								}
								//else{echo"noone";}			
					
							break;
						}
						else if($row3["locker_id"]=="1" && $row3["status"] != "available"){
							$locker1 = 1;
						}
						else if($row3["locker_id"]=="2" && $row3["status"] != "available"){
							$locker2 = 1;
						}
						else if($row3["locker_id"]=="3" && $row3["status"] != "available"){
							$locker3 = 1;
						}
						else if($row3["locker_id"]=="4" && $row3["status"] != "available"){
							$locker4 = 1;
						}
						
						if(($locker1=="1") && ($locker2=="1") && ($locker3=="1") && ($locker4=="1")){
							echo"*R5";
						}
						
					}
					
				}
				else{
					echo"remaining:".$penalty1;
					//echo"timesince:".$timeSince1;
					//echo"fin:".$fin_pen1;
					$sql_penalty1 = "UPDATE users SET penalty='$penalty1' WHERE UID='$fieldToGet'";
					$result_penalty1 = $connection -> query($sql_penalty1);
					echo"*R8";
				}
		
		//}

		break;
	}
	else if(($fieldToGet == $row["UID"]) && ($row["active"]=="no")  && 
		(((date("l") != "Saturday") && (date("H:i:s") > date("23:59:00"))) ||
		((date("l") == "Saturday") && (date("H:i:s") > date("23:59:00"))) )){
		echo"*UX";
	}
	else{
		$sql_reserve = "SELECT * FROM `transactions` WHERE UID = \"$fieldToGet\"";
		$result_reserve = $connection -> query($sql_reserve);
		while($row2 = $result_reserve->fetch_assoc()){
			if($fieldToGet == $row2["UID"] && $row2["status"] == "reserved" && $row2["occurence"]=="0"){//confirm
					
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
				
					if($row2["locker_id"]=="1"){
			
						$now_reserved1 = time();
						$timeSince_C1 = $now_reserved1-$time_reserved1_now;
						
						$fin_res1 = strtotime(date("00:10:00"));
						
						$minus1 = $fin_res1-$timeSince_C1;
					
						$reserved_C1 = gmdate("i:s",$minus1);
	
						if($timeSince_C1 >=600){
							echo "*R7-C1:".$timeSince_C1;
							
							$sql_C1T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
							$result_C1T = $connection -> query($sql_C1T);	
							
							$sql_C1L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
							$result_C1L = $connection -> query($sql_C1L);
							
							$sql_C1U = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1'";
							$result_C1U = $connection -> query($sql_C1U);
							
							$sql_C1TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='1'";
							$result_C1TI = $connection -> query($sql_C1TI);
							//echo"DoneC1";
						}
						else{
							$sql_C1T = "UPDATE timers SET remaining ='$reserved_C1' WHERE user='1'";
							$result_C1T = $connection -> query($sql_C1T);
							echo "*R".$row2["locker_id"];//return locker number
							echo "\r\n";
						}
					}
					else if($row2["locker_id"]=="2"){
			
						$now_reserved2 = time();
						$timeSince_C2 = $now_reserved2-$time_reserved2_now;	
						
						$fin_res2 = strtotime(date("00:10:00"));
						
						$minus2 = $fin_res2-$timeSince_C2;
					
						$reserved_C2 = gmdate("i:s",$minus2);
						
						
						if($timeSince_C2 >=600){
							echo "*R7-C2:".$timeSince_C2;
							
							$sql_C2T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
							$result_C2T = $connection -> query($sql_C2T);	
									
							$sql_C2L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
							$result_C2L = $connection -> query($sql_C2L);
									
							$sql_C2U = "UPDATE users SET active ='no', locker_id='0' WHERE locker_id='2'";
							$result_C2U = $connection -> query($sql_C2U);
							
							$sql_C2TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='2'";
							$result_C2TI = $connection -> query($sql_C2TI);
							echo"DoneC2";
						}
						else{
							$sql_C2T = "UPDATE timers SET remaining ='$reserved_C2' WHERE user='2'";
							$result_C2T = $connection -> query($sql_C2T);
							echo "*R".$row2["locker_id"];//return locker number
							echo "\r\n";
						}
						break;
					}
					else if($row2["locker_id"]=="3"){
						$now_reserved3 = time();
						$timeSince_C3 = $now_reserved3-$time_reserved3_now;
						
						$fin_res3 = strtotime(date("00:10:00"));
						
						$minus3 = $fin_res3-$timeSince_C3;
					
						$reserved_C3 = gmdate("i:s",$minus3);
						
						
						if($timeSince_C3 >=600){
							echo "*R7-C3:".$timeSince_C3;
							
							$sql_C3T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
							$result_C3T = $connection -> query($sql_C3T);	
										
							$sql_C3L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
							$result_C3L = $connection -> query($sql_C3L);
										
							$sql_C3U = "UPDATE users SET active ='no', locker_id='0' WHERE locker_id='3'";
							$result_C3U = $connection -> query($sql_C3U);
								
							$sql_C3TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='3'";
							$result_C3TI = $connection -> query($sql_C3TI);
							echo"DoneC3";
						}
						else{
							$sql_C3T = "UPDATE timers SET remaining ='$reserved_C3' WHERE user='3'";
							$result_C3T = $connection -> query($sql_C3T);
							echo "*R".$row2["locker_id"];//return locker number
							echo "\r\n";
							}
						break;
					}
					else if($row2["locker_id"]=="4"){
						$now_reserved4 = time();
						$timeSince_C4 = $now_reserved4-$time_reserved4_now;
						
						$fin_res4 = strtotime(date("00:10:00"));
						
						$minus4 = $fin_res4-$timeSince_C4;
					
						$reserved_C4 = gmdate("i:s",$minus4);
						
						
						if($timeSince_C4 >=600){
							echo "*R7-C4:".$timeSince_C4;	
						
							$sql_C4T = "UPDATE transactions SET status ='expired' WHERE UID='$fieldToGet' AND status='reserved'";
							$result_C4T = $connection -> query($sql_C4T);	
										
							$sql_C4L = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
							$result_C4L = $connection -> query($sql_C4L);
										
							$sql_C4U = "UPDATE users SET active ='no', locker_id='0' WHERE locker_id='4'";
							$result_C4U = $connection -> query($sql_C4U);
								
							$sql_C4TI = "UPDATE timers SET reserved ='0', remaining = '00:00' WHERE user='4'";
							$result_C4TI = $connection -> query($sql_C4TI);
							echo"DoneC4";
						}
						else{
							$sql_C4T = "UPDATE timers SET remaining ='$reserved_C4' WHERE user='4'";
							$result_C4T = $connection -> query($sql_C4T);
							echo "*R".$row2["locker_id"];//return locker number
							echo "\r\n";
						}
						break;
					}	
				break;
			}
			else if($fieldToGet == $row2["UID"] && $row2["status"] == "ongoing" && $row2["occurence"] == "1"){//counter//logout without penalty
				$date_in = $row2["date_in"];

				$sql_countdown = "UPDATE transactions SET occurence = '2' WHERE UID='$fieldToGet' AND status='ongoing'";
				$result_coundown = $connection -> query($sql_countdown);	
					
				//if($row2["locker_id"] == "1" && $row2["penalty_count"]=="0"){
				if($row2["locker_id"] == "1" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){//_______________________Weekday1
					$time_logout1_now = time();
						
						$sql_logout1 = "UPDATE timers SET logout='$time_logout1_now' WHERE user='1'";
						$result_logout1 = $connection -> query($sql_logout1);
						
						echo "*U2D1";
						break;
				}
				//else if($row2["locker_id"]=="2" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "2" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){
					$time_logout2_now = time();
						
						$sql_logout2 = "UPDATE timers SET logout='$time_logout2_now' WHERE user='2'";
						$result_logout2 = $connection -> query($sql_logout2);
						
						echo "*U2D2";
						break;
				
				}
				//else if($row2["locker_id"]=="3" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "3" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){
					$time_logout3_now = time();
						
						$sql_logout3 = "UPDATE timers SET logout='$time_logout3_now' WHERE user='3'";
						$result_logout3 = $connection -> query($sql_logout3);
						
						echo "*U2D3";
						break;
				}
				//else if($row2["locker_id"]=="4" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "4" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){	
					$time_logout4_now = time();
						
						$sql_logout4 = "UPDATE timers SET logout='$time_logout4_now' WHERE user='4'";
						$result_logout4 = $connection -> query($sql_logout4);
						
						echo "*U2D4";
						break;
				}
				else{}
				//_________________________________________________________________________________________________________________________________WEEKEND1
				if($row2["locker_id"] == "1" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){//_______________________
					$time_logout1_now = time();
						
						$sql_logout1 = "UPDATE timers SET logout='$time_logout1_now' WHERE user='1'";
						$result_logout1 = $connection -> query($sql_logout1);
						
						echo "*U2D1";
						break;
				}
				//else if($row2["locker_id"]=="2" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "2" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){
					$time_logout2_now = time();
						
						$sql_logout2 = "UPDATE timers SET logout='$time_logout2_now' WHERE user='2'";
						$result_logout2 = $connection -> query($sql_logout2);
						
						echo "*U2D2";
						break;
				
				}
				//else if($row2["locker_id"]=="3" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "3" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){
					$time_logout3_now = time();
						
						$sql_logout3 = "UPDATE timers SET logout='$time_logout3_now' WHERE user='3'";
						$result_logout3 = $connection -> query($sql_logout3);
						
						echo "*U2D3";
						break;
				}
				//else if($row2["locker_id"]=="4" && $row2["penalty_count"]=="0"){
				else if($row2["locker_id"] == "4" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") < date("$date_in-23:59:00")) ){	
					$time_logout4_now = time();
						
						$sql_logout4 = "UPDATE timers SET logout='$time_logout4_now' WHERE user='4'";
						$result_logout4 = $connection -> query($sql_logout4);
						
						echo "*U2D4";
						break;
				}
				else{}
				//_____________________________________________________________________________________________
				//_____________________________________________________________________________________________//logout with penalty
	
					//if($row2["locker_id"] == "1" && $row2["penalty_count"]!="0"){
					if($row2["locker_id"] == "1" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){//_______________________WEEKDAY
						
						
						if($row2["day"]=="wd"){
							$start_penalty1=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty1=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
							
						$now1 = time();
						$start_penalty1_hr = $now1 - $start_penalty1;
						
						$final = gmdate("z:H:i:s",$start_penalty1_hr);
						
						$minutes = $start_penalty1_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty1 = gmdate("z:H:i:s",$seconds_done);	
							
						$sql_penalty_count1 = "UPDATE transactions SET penalty_count ='$start_penalty1' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count1 = $connection -> query($sql_penalty_count1);	
							
						$sql_penalty1 = "SELECT * FROM `users`";
						$result_penalty1 = $connection -> query($sql_penalty1);
							
						
						$sql_penalty11 = "UPDATE users SET fin_penalty='$start_penalty1_hr', run_penalty='$now1',
										penalty='$penalty1', active='no', locker_id='0', start_penalty='$start_penalty1',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty11 = $connection -> query($sql_penalty11);
						
		
						$sql_finished1 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished1 = $connection -> query($sql_finished1);	
						
						$sql_locker1 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
						$result_locker1 = $connection -> query($sql_locker1);
			
						
						$sql_timer1 = "UPDATE timers SET logout ='0' WHERE user='1'";
						$result_timer1 = $connection -> query($sql_timer1);
						echo"*UY1";	
						break;
						
					}
					//else if($row2["locker_id"] == "2" && $row2["penalty_count"]!="0"){
					else if($row2["locker_id"] == "2" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						
						if($row2["day"]=="wd"){
							$start_penalty2=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty2=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
							
						$now2 = time();
						$start_penalty2_hr = $now2 - $start_penalty2;
									
						$final = gmdate("z:H:i:s",$start_penalty2_hr);
						
						$minutes = $start_penalty2_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty2 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count2= "UPDATE transactions SET penalty_count ='$start_penalty2' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
							
						$sql_penalty2 = "SELECT * FROM `users`";
						$result_penalty2 = $connection -> query($sql_penalty2);
							
						
						$sql_penalty21 = "UPDATE users SET fin_penalty='$start_penalty2_hr', run_penalty='$now2',
										penalty='$penalty2', active='no', locker_id='0', start_penalty='$start_penalty2',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty21 = $connection -> query($sql_penalty21);
						
		
						$sql_finished2 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished2 = $connection -> query($sql_finished2);	
						
						$sql_locker2 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
						$result_locker2 = $connection -> query($sql_locker2);
			
						
						$sql_timer2 = "UPDATE timers SET logout ='0' WHERE user='2'";
						$result_timer2 = $connection -> query($sql_timer2);
						echo"*UY2";	
						break;
						
					}
					//else if($row2["locker_id"] == "3" && $row2["penalty_count"]!="0"){
					else if($row2["locker_id"] == "3" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						
						if($row2["day"]=="wd"){
							$start_penalty3=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty3=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
							
						$now3 = time();
						$start_penalty3_hr = $now3 - $start_penalty3;
									
						$final = gmdate("z:H:i:s",$start_penalty3_hr);
						
						$minutes = $start_penalty3_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty3 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count3 = "UPDATE transactions SET penalty_count ='$start_penalty3' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count3 = $connection -> query($sql_penalty_count3);	
							
						$sql_penalty3 = "SELECT * FROM `users`";
						$result_penalty3 = $connection -> query($sql_penalty3);
							
						
						$sql_penalty31 = "UPDATE users SET fin_penalty='$start_penalty3_hr', run_penalty='$now3',
										penalty='$penalty3', active='no', locker_id='0', start_penalty='$start_penalty3',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty31 = $connection -> query($sql_penalty31);
						
		
						$sql_finished3 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished3 = $connection -> query($sql_finished3);	
						
						$sql_locker3 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
						$result_locker3 = $connection -> query($sql_locker3);
			
						
						$sql_timer3 = "UPDATE timers SET logout ='0' WHERE user='3'";
						$result_timer3 = $connection -> query($sql_timer3);
						echo"*UY3";	
						break;
						
					}
					else if($row2["locker_id"] == "4" && (date("l") != "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						
						if($row2["day"]=="wd"){
							$start_penalty4=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty4=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
							
						$now4 = time();
						$start_penalty4_hr = $now4 - $start_penalty4;
									
						$final = gmdate("z:H:i:s",$start_penalty4_hr);
						
						$minutes = $start_penalty4_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty4 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count4= "UPDATE transactions SET penalty_count ='$start_penalty4' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count4 = $connection -> query($sql_penalty_count4);	
							
						$sql_penalty4 = "SELECT * FROM `users`";
						$result_penalty4 = $connection -> query($sql_penalty4);
							
						
						$sql_penalty41 = "UPDATE users SET fin_penalty='$start_penalty4_hr', run_penalty='$now4',
										penalty='$penalty4', active='no', locker_id='0', start_penalty='$start_penalty4',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty41 = $connection -> query($sql_penalty41);
						
		
						$sql_finished4 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished4 = $connection -> query($sql_finished4);	
						
						$sql_locker4 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
						$result_locker4 = $connection -> query($sql_locker4);
			
						
						$sql_timer4 = "UPDATE timers SET logout ='0' WHERE user='4'";
						$result_timer4 = $connection -> query($sql_timer4);
						echo"*UY4";
						break;
						
					}
					else{}
					//______________________________________________________________________________________________________________________________________WEEKEND
					if($row2["locker_id"] == "1" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						/* if(date("l") == "Saturday" && $row2["penalty_count"] != "0"){
							$start_penalty1=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty1=strtotime(date("$date_in 23:59:00"));
						} */
						 
						if($row2["day"]=="wd"){
							$start_penalty1=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty1=strtotime(date("$date_in 23:59:00"));//or weekday value
							
						}
							
						$now1 = time();
						$start_penalty1_hr = $now1 - $start_penalty1;
						
						$final = gmdate("z:H:i:s",$start_penalty1_hr);
						
						$minutes = $start_penalty1_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty1 = gmdate("z:H:i:s",$seconds_done);	
							
						$sql_penalty_count1 = "UPDATE transactions SET penalty_count ='$start_penalty1' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count1 = $connection -> query($sql_penalty_count1);	
							
						$sql_penalty1 = "SELECT * FROM `users`";
						$result_penalty1 = $connection -> query($sql_penalty1);
							
						
						$sql_penalty11 = "UPDATE users SET fin_penalty='$start_penalty1_hr', run_penalty='$now1',
										penalty='$penalty1', active='no', locker_id='0', start_penalty='$start_penalty1',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty11 = $connection -> query($sql_penalty11);
						
		
						$sql_finished1 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished1 = $connection -> query($sql_finished1);	
						
						$sql_locker1 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
						$result_locker1 = $connection -> query($sql_locker1);
			
						
						$sql_timer1 = "UPDATE timers SET logout ='0' WHERE user='1'";
						$result_timer1 = $connection -> query($sql_timer1);
						echo"*UY1";	
						break;
						
					}
					//else if($row2["locker_id"] == "2" && $row2["penalty_count"]!="0"){
					else if($row2["locker_id"] == "2" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						if($row2["day"]=="wd"){
							$start_penalty2=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty2=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						
							
						$now2 = time();
						$start_penalty2_hr = $now2 - $start_penalty2;
									
						$final = gmdate("z:H:i:s",$start_penalty2_hr);
						
						$minutes = $start_penalty2_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty2 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count2= "UPDATE transactions SET penalty_count ='$start_penalty2' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count2 = $connection -> query($sql_penalty_count2);	
							
						$sql_penalty2 = "SELECT * FROM `users`";
						$result_penalty2 = $connection -> query($sql_penalty2);
							
						
						$sql_penalty21 = "UPDATE users SET fin_penalty='$start_penalty2_hr', run_penalty='$now2',
										penalty='$penalty2', active='no', locker_id='0', start_penalty='$start_penalty2',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty21 = $connection -> query($sql_penalty21);
						
		
						$sql_finished2 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished2 = $connection -> query($sql_finished2);	
						
						$sql_locker2 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
						$result_locker2 = $connection -> query($sql_locker2);
			
						
						$sql_timer2 = "UPDATE timers SET logout ='0' WHERE user='2'";
						$result_timer2 = $connection -> query($sql_timer2);
						echo"*UY2";	
						break;
						
					}
					//else if($row2["locker_id"] == "3" && $row2["penalty_count"]!="0"){
					else if($row2["locker_id"] == "3" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						
						if($row2["day"]=="wd"){
							$start_penalty3=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty3=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						
						$now3 = time();
						$start_penalty3_hr = $now3 - $start_penalty3;
									
						$final = gmdate("z:H:i:s",$start_penalty3_hr);
						
						$minutes = $start_penalty3_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty3 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count3 = "UPDATE transactions SET penalty_count ='$start_penalty3' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count3 = $connection -> query($sql_penalty_count3);	
							
						$sql_penalty3 = "SELECT * FROM `users`";
						$result_penalty3 = $connection -> query($sql_penalty3);
							
						
						$sql_penalty31 = "UPDATE users SET fin_penalty='$start_penalty3_hr', run_penalty='$now3',
										penalty='$penalty3', active='no', locker_id='0', start_penalty='$start_penalty3',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty31 = $connection -> query($sql_penalty31);
						
		
						$sql_finished3 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished3 = $connection -> query($sql_finished3);	
						
						$sql_locker3 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
						$result_locker3 = $connection -> query($sql_locker3);
			
						
						$sql_timer3 = "UPDATE timers SET logout ='0' WHERE user='3'";
						$result_timer3 = $connection -> query($sql_timer3);
						echo"*UY3";	
						break;
						
					}
					else if($row2["locker_id"] == "4" && (date("l") == "Saturday") && (date("Y-m-d-H:i:s") >= date("$date_in-23:59:00")) ){
						
						
						if($row2["day"]=="wd"){
							$start_penalty4=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
						else{
							$start_penalty4=strtotime(date("$date_in 23:59:00"));//or weekday value
						}
							
						$now4 = time();
						$start_penalty4_hr = $now4 - $start_penalty4;
									
						$final = gmdate("z:H:i:s",$start_penalty4_hr);
						
						$minutes = $start_penalty4_hr / 60;
						$hour = $minutes / 60;
						$total_penalty = $hour * 24;//1 hour = day
						$minutes_done = $total_penalty * 60;
						$seconds_done = $minutes_done * 60;
						
						$penalty4 = gmdate("z:H:i:s",$seconds_done);
							
							
						$sql_penalty_count4= "UPDATE transactions SET penalty_count ='$start_penalty4' WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_penalty_count4 = $connection -> query($sql_penalty_count4);	
							
						$sql_penalty4 = "SELECT * FROM `users`";
						$result_penalty4 = $connection -> query($sql_penalty4);
							
						
						$sql_penalty41 = "UPDATE users SET fin_penalty='$start_penalty4_hr', run_penalty='$now4',
										penalty='$penalty4', active='no', locker_id='0', start_penalty='$start_penalty4',
										passcode='0', clear_penalty='1',final='$final', calculatedPenalty_seconds='$seconds_done' WHERE UID='$fieldToGet'";
						$result_penalty41 = $connection -> query($sql_penalty41);
						
		
						$sql_finished4 = "UPDATE transactions SET status ='finished', 
										  date_out='$currdate', time_out='$currtime', sms_warning='0'
										  WHERE UID='$fieldToGet' AND status='ongoing'";
						$result_finished4 = $connection -> query($sql_finished4);	
						
						$sql_locker4 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
						$result_locker4 = $connection -> query($sql_locker4);
			
						
						$sql_timer4 = "UPDATE timers SET logout ='0' WHERE user='4'";
						$result_timer4 = $connection -> query($sql_timer4);
						echo"*UY4";
						break;
						
					}
					else{}
				
				break;		
			}	
			else if($fieldToGet == $row2["UID"] && $row2["status"] == "ongoing" && $row2["occurence"] == "2"){//extend
					
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

				
				if($row2["locker_id"] == 1){
					$now_logout1 = time();
					$timeSince_E1 = $now_logout1-$time_logout1_now;
					
						if($timeSince_E1 >=30){
						echo"*X51:".$timeSince_E1;	
							$sql_locker1 = "UPDATE transactions SET status ='finished',
											date_out='$currdate', time_out='$currtime', sms_warning='0'
											WHERE UID='$fieldToGet' AND status = 'ongoing'";
							$result_locker1 = $connection -> query($sql_locker1);	
							
							$sql_Lextend1 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='1'";
							$result_Lextend1 = $connection -> query($sql_Lextend1);
							
							$sql_user1 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='1'";
							$result_user1 = $connection -> query($sql_user1);
							
							$sql_timer1 = "UPDATE timers SET logout ='0' WHERE user='1'";
							$result_timer1 = $connection -> query($sql_timer1);
							echo"D1";
						}
						else{
							echo"*X1";
							
							$sql_extend1 = "UPDATE transactions SET occurence = '1' WHERE UID='$fieldToGet' AND status='ongoing'";
							$result_extend1 = $connection -> query($sql_extend1);
							
							$sql_timer1 = "UPDATE timers SET logout ='0' WHERE user='1'";
							$result_timer1 = $connection -> query($sql_timer1);
						}
					break;
				}
				//____________________________________________________________________________________________________________
				else if($row2["locker_id"] == 2){
					
					$now_logout2 = time();
					$timeSince_E2 = $now_logout2-$time_logout2_now;
					
						if($timeSince_E2 >=30){
						echo"*X52:".$timeSince_E2;	
							
							$sql_locker2 = "UPDATE transactions SET status ='finished',
											date_out='$currdate', time_out='$currtime', sms_warning='0'
											WHERE UID='$fieldToGet' AND status = 'ongoing'";
							$result_locker2 = $connection -> query($sql_locker2);	
							
								
							$sql_Lextend2 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='2'";
							$result_Lextend2 = $connection -> query($sql_Lextend2);
							
							$sql_user2 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='2'";
							$result_user2 = $connection -> query($sql_user2);
							
							$sql_timer2 = "UPDATE timers SET logout ='0' WHERE user='2'";
							$result_timer2 = $connection -> query($sql_timer2);
							echo"D2";
						}
						else{
							echo"*X2";
							
							$sql_extend2 = "UPDATE transactions SET occurence = '1' WHERE UID='$fieldToGet' AND status='ongoing'";
							$result_extend2 = $connection -> query($sql_extend2);
						
							$sql_timer2 = "UPDATE timers SET logout ='0' WHERE user='2'";
							$result_timer2 = $connection -> query($sql_timer2);
						}
					break;
				}
				//________________________________________________________________________________________________________________
				else if($row2["locker_id"] == 3){
					
					$now_logout3 = time();
					$timeSince_E3 = $now_logout3-$time_logout3_now;
					
						if($timeSince_E3 >=30){
						echo"*X53:".$timeSince_E3;	
							$sql_locker3 = "UPDATE transactions SET status ='finished', 
											date_out='$currdate', time_out='$currtime', sms_warning='0'
											WHERE UID='$fieldToGet' AND status = 'ongoing'";
							$result_locker3 = $connection -> query($sql_locker3);	
								
							$sql_Lextend3 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='3'";
							$result_Lextend3 = $connection -> query($sql_Lextend3);
							
							$sql_user3 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='3'";
							$result_user3 = $connection -> query($sql_user3);
							
							$sql_timer3 = "UPDATE timers SET logout ='0' WHERE user='3'";
							$result_timer3 = $connection -> query($sql_timer3);
							echo"D3";
						}
						else{
							echo"*X3";
							
							$sql_extend3 = "UPDATE transactions SET occurence = '1' WHERE UID='$fieldToGet' AND status='ongoing'";
							$result_extend3 = $connection -> query($sql_extend3);
						
							$sql_timer3 = "UPDATE timers SET logout ='0' WHERE user='3'";
							$result_timer3 = $connection -> query($sql_timer3);
						}
					break;
				}
				//__________________________________________________________________________________________________________
				else if($row2["locker_id"] == 4){
					
					$now_logout4 = time();
					$timeSince_E4 = $now_logout4-$time_logout4_now;
					
						if($timeSince_E4 >=30){
						echo"*X54:".$timeSince_E4;	
							$sql_locker4 = "UPDATE transactions SET status ='finished',
											date_out='$currdate', time_out='$currtime', sms_warning='0'
											WHERE UID='$fieldToGet' AND status = 'ongoing'";
							$result_locker4 = $connection -> query($sql_locker4);	
								
							$sql_Lextend4 = "UPDATE lockers SET status ='available', id_number='0' WHERE locker_id='4'";
							$result_Lextend4 = $connection -> query($sql_Lextend4);
							
							$sql_user4 = "UPDATE users SET active ='no', locker_id='0', passcode='0' WHERE locker_id='4'";
							$result_user4 = $connection -> query($sql_user4);
							
							$sql_timer4 = "UPDATE timers SET logout ='0' WHERE user='4'";
							$result_timer4 = $connection -> query($sql_timer4);
							echo"D4";
						}
						else{
							echo"*X4";
							
							$sql_extend4 = "UPDATE transactions SET occurence = '1' WHERE UID='$fieldToGet' AND status='ongoing'";
							$result_extend4 = $connection -> query($sql_extend4);
						
							$sql_timer4 = "UPDATE timers SET logout ='0' WHERE user='4'";
							$result_timer4 = $connection -> query($sql_timer4);
						}
					break;
				}
				break;
			}	
		}
		break;
	}
	
	
	
	
	
	
		 
}//end while
	


 
  ?>

