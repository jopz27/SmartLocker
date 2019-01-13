<!DOCTYPE html>
<?php
    $dateFrom = $_REQUEST["dateFrom"];
    $dateTo = $_REQUEST["dateTo"];
    $idNumber = $_REQUEST["idNumber"];
    
	//require database details
	require_once "db_config.php";
	
	$selectTableQuery = "SELECT * FROM transactions";
	$selectTableQueryResult = $connection -> query($selectTableQuery);
	if(!$selectTableQueryResult) die($connection -> error);
	
	$numberOfUsersRow = $selectTableQueryResult -> num_rows;
?>
<html>
    <body>
        <div>
            <table>
                <tr>
                <th>Transaction ID</th>
                <th>ID number</th>
                <th>Name</th>
                <th>Locker</th>
                <th>Reserved Date/Time</th>
                <th>Date/Time in</th>
                <th>Date/Time out</th>
                <th>Status</th>
                <th>Way</th>
                </tr>
                <tr>
            <?php
                for($rowNumber = 0; $rowNumber < $numberOfUsersRow; ++$rowNumber){
            	    $selectTableQueryResult -> data_seek($rowNumber);
            	    $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
            	    //Selected a name only
                    if($idNumber == $thisRow['id_number'] && $dateFrom == "" && $dateTo == ""){
            ?>
                        <td><?php echo $thisRow['transaction_id'];?></td>
                        <td><?php echo $thisRow['id_number']; ?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['locker_id']; ?></td>
                        <td><?php echo $thisRow['reserved_date']."/".$thisRow['reserved_time']; ?></td>
                        <td><?php echo $thisRow['date_in']."/".$thisRow['time_in']; ?></td>
                        <td><?php echo $thisRow['date_out']."/".$thisRow['time_out']; ?></td>
                        <td><?php echo $thisRow['status']; ?></td>
                        <td><?php echo $thisRow['way'];?></td>
                        </tr>
            <?php	
                    }else;
                    //Selected name and date from
                    if ($idNumber == $thisRow['id_number'] && $dateFrom == $thisRow['reserved_date'] && $dateTo == "") {
            ?>
                        <td><?php echo $thisRow['transaction_id'];?></td>
                        <td><?php echo $thisRow['id_number']; ?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['locker_id']; ?></td>
                        <td><?php echo $thisRow['reserved_date']."/".$thisRow['reserved_time']; ?></td>
                        <td><?php echo $thisRow['date_in']."/".$thisRow['time_in']; ?></td>
                        <td><?php echo $thisRow['date_out']."/".$thisRow['time_out']; ?></td>
                        <td><?php echo $thisRow['status']; ?></td>
                        <td><?php echo $thisRow['way'];?></td>
                        </tr>
            <?php
                    }else;
                    //selected a date from
                    if ($idNumber == "" && $dateFrom == $thisRow['reserved_date'] && $dateTo == "") {
            ?>
                        <td><?php echo $thisRow['transaction_id'];?></td>
                        <td><?php echo $thisRow['id_number']; ?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['locker_id']; ?></td>
                        <td><?php echo $thisRow['reserved_date']."/".$thisRow['reserved_time']; ?></td>
                        <td><?php echo $thisRow['date_in']."/".$thisRow['time_in']; ?></td>
                        <td><?php echo $thisRow['date_out']."/".$thisRow['time_out']; ?></td>
                        <td><?php echo $thisRow['status']; ?></td>
                        <td><?php echo $thisRow['way'];?></td>
                        </tr>
            <?php
                    }else;
                    //selected a date from and date to
                    if ($idNumber == "" && $thisRow['reserved_date'] >= $dateFrom && $thisRow['reserved_date'] <=$dateTo) {
            ?>
                        <td><?php echo $thisRow['transaction_id'];?></td>
                        <td><?php echo $thisRow['id_number']; ?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['locker_id']; ?></td>
                        <td><?php echo $thisRow['reserved_date']."/".$thisRow['reserved_time']; ?></td>
                        <td><?php echo $thisRow['date_in']."/".$thisRow['time_in']; ?></td>
                        <td><?php echo $thisRow['date_out']."/".$thisRow['time_out']; ?></td>
                        <td><?php echo $thisRow['status']; ?></td>
                        <td><?php echo $thisRow['way'];?></td>
                        </tr>
            <?php
                    }else;
                    //selected a name, a date from and date to
                    if ($idNumber == $thisRow['id_number'] && $thisRow['reserved_date'] >= $dateFrom && $thisRow['reserved_date'] <=$dateTo) {
            ?>
                        <td><?php echo $thisRow['transaction_id'];?></td>
                        <td><?php echo $thisRow['id_number']; ?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['locker_id']; ?></td>
                        <td><?php echo $thisRow['reserved_date']."/".$thisRow['reserved_time']; ?></td>
                        <td><?php echo $thisRow['date_in']."/".$thisRow['time_in']; ?></td>
                        <td><?php echo $thisRow['date_out']."/".$thisRow['time_out']; ?></td>
                        <td><?php echo $thisRow['status']; ?></td>
                        <td><?php echo $thisRow['way'];?></td>
                        </tr>
            <?php
                    }else;
                }//end for
            ?>
            </table>
        </div>
    </body>
</html>