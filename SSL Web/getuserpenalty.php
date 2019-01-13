<!DOCTYPE html>
<?php
    $idNumber = $_REQUEST["idNumber"];
    
	//require database details
	require_once "db_config.php";
	
	$selectTableQuery = "SELECT * FROM users Where id_number='$idNumber'";
	$selectTableQueryResult = $connection -> query($selectTableQuery);
	if(!$selectTableQueryResult) die($connection -> error);
	
	$numberOfUsersRow = $selectTableQueryResult -> num_rows;
	
	$selectTableQueryResult -> data_seek(0);
    $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
?>
<html>
    <body>
        <div>
            <h2>User Detail</h2>
            <h4>Id Number : <?php echo $thisRow['id_number'];?></h4>
            <h4>Name : <?php echo $thisRow['name'];?></h4>
            <h4>Mobile no.: <?php echo $thisRow['mobile_number'];?></h4>
			<h4>Penalty <?php echo $thisRow['penalty'];?></h4>
        </div>
    </body>
</html>