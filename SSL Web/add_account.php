<!DOCTYPE html>
<?php
    session_start();
    //define this page as restricted
    define( 'RESTRICTED', true );
    //require header for redirection for restrictions
    require_once("header.php");
    
    //require database details
	require_once "db_config.php";
	
	//select tables users
	$query = "SELECT * FROM users";
	$result = $connection -> query($query);
	if(!$result) die($connection -> error);
	
	//store
	$idNumber = $mobileNumber = 0; 
	$UID = $name = $password = $confirmPassword = "";
	$UIDerror = $idNumberError = $nameError = $passwordError = $confirmPasswordError = $mobileNumberError = "";
    $errorFlag = false;	
    $success = "";
	//if submit is clicked
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	    
	    //store inputs
	    $UID = $_POST["add_UID"];
	    $idNumber = $_POST["add_idNumber"];
	    $name = $_POST["add_name"];
	    $password = $_POST["add_password"];
	    $confirmPassword = $_POST["confirm_add_password"];
	    $mobileNumber = $_POST["add_mobile_number"];
	    
	    //select from users table
	    $selectTableQuery = "SELECT * FROM users";
	    $selectTableQueryResult = $connection -> query($selectTableQuery);
	    if(!$selectTableQueryResult) die($connection -> error);
	    
	    $numberOfUsersRow = $selectTableQueryResult -> num_rows;
		//trim white spaces
		if(trim($UID, " ") == ""){
			$UIDerror = "*UID is required";
			$errorFlag = true;
		}else;
		if(trim($idNumber, " ") == ""){
			$idNumberError = "*ID number is required";
			$errorFlag = true;
		}else;
		if(trim($name, " ") == ""){
			$nameError = "*Name is required";
			$errorFlag = true;
		}else;
		if(trim($password," ") == ""){
			$passwordError = "*password is required";
			$errorFlag = true;
		}else;
		if(trim($confirmPassword, " ") == ""){
			$confirmPasswordError = "*Please confirm password";
			$errorFlag = true;
		}else;
		
	    //check every row of table for some duplicates
	    for($rowNumber = 0; $rowNumber < $numberOfUsersRow; ++$rowNumber){
	        $selectTableQueryResult -> data_seek($rowNumber);
	        $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
			
	        if($thisRow['UID'] == $UID){
	            $UIDerror = "UID: $UID already used";
	            $errorFlag = true;
	        }else;
	        if($thisRow['id_number'] == $idNumber){
	            $idNumberError = "The ID number: $idNumber already exist";
	            $errorFlag = true;
	        }else;
	        if($thisRow['mobile_number'] == $mobileNumber){
	            $mobileNumberError = "The mobile number: $mobileNumber is already used by another account";
	            $errorFlag = true;
	        }else;
	    }

	    //check password confirmation is correct
	    if($password != $confirmPassword){ 
	        $passwordError = "Password does not match";
	        $errorFlag = true;
	    }else;
	    
	    //proceed without error
	    if(!$errorFlag){
	    	$addQuery = "INSERT INTO users (UID, id_number, name, mobile_number, password, active, locker_id, penalty, passcode,start_penalty, run_penalty,fin_penalty,calculatedPenalty_seconds,final,clear_penalty) 
	    				 VALUES ('$UID', $idNumber, '$name', $mobileNumber, '$password','no',0,'00:00:00:00',0,0,0,0,0,0,0)";
			$addQueryResult = $connection -> query($addQuery);
			if(!$addQueryResult) die($connection->error);
			$success = "Account Added!";
			
			$_POST["add_UID"] = "";
		    $_POST["add_idNumber"] = "";
		    $_POST["add_name"] = "";
		    $_POST["add_password"] = "";
		    $_POST["confirm_add_password"] = "";
		    $_POST["add_mobile_number"] = "";
	    }
    	$connection->close();
	}
?>
<html>
    <head>
	<style>
      .logout{
		background-color: #42DAE7;
		border: none;
		color: white;
		width: 100px;
		height: 20px;
		padding: 5px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 0px;
		cursor: pointer;
	}
	input[type=text], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 400px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	}
	input[type=password], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 400px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	}
	input[type=submit] {
    width: 50%;
    background-color: #42DAE7;
    color: white;
    padding: 14px 20px;
    margin: 8px 400px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
	}
	
	</style>
		<meta charset="UTF-8">
		<title>Add Account</title>
    </head>
    
    <body>
        <div class="admin-page">
           <a href="admin.php" class="logout">Home</a> </br>
		   <a href="logout.php" class="logout">Logout</a>
            
            <div class="form">
                
                <form class="login-form" method="post">
                	<?php echo $success;?></br>
					
                	<input type="text" placeholder="UID" name="add_UID"/><?php echo "<div style='color:red;' align='center'>".$UIDerror."</div>"; ?></br>
                    <input type="text" placeholder="ID number" name="add_idNumber"/><?php echo "<div style='color:red;' align='center'>".$idNumberError."</div>"; ?></br>
                    <input type="text" placeholder="Name" name="add_name"/><?php echo "<div style='color:red;' align='center'>".$nameError."</div>"; ?></br>
                    <input type="password" placeholder="Password" name="add_password"/><?php echo "<div style='color:red;' align='center'>".$passwordError."</div>"; ?></br>
                    <input type="password" placeholder="Confirm Password" name="confirm_add_password"/><?php echo "<div style='color:red;' align='center'>".$confirmPasswordError."</div>"; ?></br>
                    <input type="text" placeholder="mobile number" name="add_mobile_number"/><?php echo "<div style='color:red;' align='center'>".$mobileNumberError."</div>"; ?></br>
                    <input name="submit" type="submit">
                </form>
            </div>
        </div>
    </body>
</html>