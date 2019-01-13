<!DOCTYPE html>
<?php
    session_start();
    //define this page as restricted
    define( 'RESTRICTED', true );
    //require header for redirection for restrictions
    require_once("header.php");
    
    //require database details
	require_once "db_config.php";
	
	//storage
	//$usersList[][] = "";
	
	$selectTableQuery = "SELECT * FROM users";
	$selectTableQueryResult = $connection -> query($selectTableQuery);
	if(!$selectTableQueryResult) die($connection -> error);
	
	$numberOfUsersRow = $selectTableQueryResult -> num_rows;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Transactions</title>
        <link rel="stylesheet" href="css/admin_style.css">
        <style>
            table,th,td {
                border : 1px solid black;
                border-collapse: collapse;
				margin-left:300px;
            }
                th,td {
                padding: 5px;
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
		margin: 4px 0px;
		cursor: pointer;
		}
        </style>
    </head>
    
    <body>
		
        <div>
			<a href="logout.php" class="logout">Logout</a></br>
            <a href="admin.php" class="logout">Home</a></br></br>
            <a>From:</a>
            <input onchange = "selectionFunction()" type="date" id="dateSelectedFrom" min="2010-01-01">
            <a>  To:</a>
            <input onchange = "selectionFunction()" type="date" id="dateSelectedTo" min="2010-01-01">
            <br><br>
            <a>Id number:</a>
            <select id="idNumberSelected" onchange="selectionFunction()">
                <option style = "display:none"></option>
                <?php
                    for($rowNumber = 0; $rowNumber < $numberOfUsersRow; ++$rowNumber){
                	    $selectTableQueryResult -> data_seek($rowNumber);
                	    $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);?>
                
                <option value="<?php echo $thisRow['id_number']; ?>"><?php echo $thisRow['id_number']; ?></option>
                
                <?php	}?>
            </select>
            <br><br>
            <div id="result">Result...</div>
        </div>
    <script>
        function selectionFunction() {
            var dateFrom = document.getElementById("dateSelectedFrom").value;
            var dateTo = document.getElementById("dateSelectedTo").value;
            var idNumber = document.getElementById("idNumberSelected").value;
            
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "gettransactions.php?dateFrom="+dateFrom+"&dateTo="+dateTo+"&idNumber="+idNumber, true);
            xhttp.send();
        }
    </script>
    </body>
</html>