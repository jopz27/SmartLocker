<!DOCTYPE html>
<?php
    session_start();
    //define this page as restricted
    define( 'RESTRICTED', true );
    //require header for redirection for restrictions
    require_once("header.php");
?>
<html>
    <head>
	<style>    
	.button {
		background-color: #42DAE7;
		border: none;
		color: black;
		width: 1000px;
		height: 40px;
		padding-top: 15px;
		text-align: center;
		text-decoration: none;
		display: block;
		font-size: 16px;
		margin: 2px 300px;
		cursor: pointer;
	}
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
		margin: 4px 1190px;
		cursor: pointer;
		
	}
	</style>
		<meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" href="css/admin_style.css">
	</head>
    
    <body>
        <div>
            <a href="logout.php" class="logout">Logout</a></br></br>
            <div>
                    <a href="add_account.php" class="button">Add Account</a></br>
                    <a href="viewAccount.php" class="button">View Account</a></br>
                    <a href="viewLocker.php"  class="button">View Locker Status</a></br>
                    <a href="viewTransactions.php" class="button">View transactions</a></br>
            </div>
        </div>
        
    </body>
</html>