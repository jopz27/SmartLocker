<?php
    $q = $_REQUEST["q"];
    
    echo $q;
   
    //require database details
	require_once "db_config.php";
	
	//select tables users
	$query = "DELETE FROM users WHERE id_number=$q";
	$result = $connection -> query($query);
	if(!$result) die($connection -> error);
?>