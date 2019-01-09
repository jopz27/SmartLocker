<?php
	$db_hostname = '50.62.209.7';
	$db_database = 'smart_locker';
	$db_username = 'jopz';
	$db_password = '12345';
	
	$connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	
	if ($connection -> connect_error) die($connection -> connect_error);
?>