<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<?php
 //require database details
	require_once "db_config.php";
	
	//storage
	$usersList[][] = "";
	
	$selectTableQuery = "SELECT * FROM users";
	$selectTableQueryResult = $connection -> query($selectTableQuery);
	if(!$selectTableQueryResult) die($connection -> error);
	
	$numberOfUsersRow = $selectTableQueryResult -> num_rows;

echo "<table>
<tr>
<th>ID number</th>
<th>Name</th>
<th>Mobile Number</th>
<th>Action</th>
</tr>";

for($rowNumber = 0; $rowNumber < $numberOfUsersRow; ++$rowNumber){
$selectTableQueryResult -> data_seek($rowNumber);
$thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
    echo "<tr>";
    echo "<td>" . $thisRow['id_number'] . "</td>";
    echo "<td>" . $thisRow['name'] . "</td>";
    echo "<td>" . $thisRow['mobile_number'] . "</td>";?>
    <td><button type="button" onclick="removeAccount(<?php echo $thisRow['id_number'];?>)">Remove</button></td></br>
    <?php echo "</tr>";
}
echo "</table>";
mysqli_close($connection);
?>
    <script>
        function removeAccount(id_number) {
            alert("fuck off");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("demo").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "removeAccount.php?q="+id_number, true);
            xhttp.send();
        }
    </script>
</body>
</html>