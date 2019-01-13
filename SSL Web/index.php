<!DOCTYPE html>
<?php
    session_start();
    define( 'SEND_TO_HOME', true );
    require_once("header.php");
	
	//require database details
	require_once "db_config.php";
	
	//select table admins
	$query = "SELECT * FROM admins";
	$result = $connection -> query($query);
	
	if(!$result) die ($connection -> error);
	
	//stores the idnumber and password entered
	$idNumber = $password = "";
	$login_error = "";
    $login_flag = false;
    
    //if login button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $idNumber = $_POST["idNumber"];
        $password = $_POST["password"];
        
        $selectTableQuery = "SELECT * FROM admins";
        $selectTableQueryResult = $connection->query($selectTableQuery);
        if (!$selectTableQueryResult) die($connection->error);
        
        $number_of_admin_row = $selectTableQueryResult->num_rows;
        
        for ($row_number = 0 ; $row_number < $number_of_admin_row ; ++$row_number){
            
            $selectTableQueryResult->data_seek($row_number);
            $this_row = $selectTableQueryResult->fetch_array(MYSQLI_ASSOC);
            
            if ($this_row['id_number'] == $idNumber && $this_row['password'] == $password) {
                $login_flag = true;
            }else;
        }

        if($login_flag == true){
            $_SESSION["idNumber"] = $idNumber;
            $_SESSION["login_flag"] = $login_flag;
            page_header();
        }else {
            $login_error = "invalid IDnumber or password";
        }
        $selectTableQueryResult->close();
    }else{ }
    $result->close();
    $connection->close();
?>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
      <link rel="stylesheet" href="css/login_style.css">
</head>

<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <img src="/image/logo.png" alt="smart locker logo">
            <?php echo "<div style= 'color:red;' align='center'>".$login_error."</div>"; ?>
            <input type="text" placeholder="ID Number" name="idNumber"/>
            <input type="password" placeholder="Password" name="password"/>
            <button name="login">login</button>
        </form>
    </div>
</div>
<script  src="js/index.js"></script>

</body>
</html>
