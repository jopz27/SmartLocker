<!DOCTYPE html>
<?php
    session_start();
    //define this page as restricted
    define( 'RESTRICTED', true );
    //require header for redirection for restrictions
    require_once("header.php");
    //require database details
	require_once "db_config.php";
    
    $selectTableQuery = "SELECT * FROM lockers";
    $selectTableQueryResult = $connection -> query($selectTableQuery);
	if(!$selectTableQueryResult) die($connection -> error);
	
	$selectTableQueryResult -> data_seek($rowNumber);
	$thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
    $numberOfLockers = $selectTableQueryResult -> num_rows;
    for($rowNumber = 0; $rowNumber < $numberOfLockers; ++$rowNumber){
        	    $selectTableQueryResult -> data_seek($rowNumber);
        	    $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);
        	    if($rowNumber == 0)
        	    {
        	        $Locker1UserIdNumber = $thisRow['id_number'];
        	        $Locker1Status = $thisRow['status'];
        	        if($Locker1Status == 'available') $Locker1Color = '#00b300';
        	        else if($Locker1Status == 'reserved') $Locker1Color = '#ffcc00';
        	        else if($Locker1Status == 'occupied') $Locker1Color = '#ff3333';
        	    }
        	    else if ($rowNumber == 1)
        	    {
        	        $Locker2UserIdNumber = $thisRow['id_number'];
        	        $Locker2Status = $thisRow['status'];
        	        if($Locker2Status == 'available') $Locker2Color = '#00b300';
        	        else if($Locker2Status == 'reserved') $Locker2Color = '#ffcc00';
        	        else if($Locker2Status == 'occupied') $Locker2Color = '#ff3333';
        	    }
        	    else if ($rowNumber == 2)
        	    {
        	        $Locker3UserIdNumber = $thisRow['id_number'];
        	        $Locker3Status = $thisRow['status'];
        	        if($Locker3Status == 'available') $Locker3Color = '#00b300';
        	        else if($Locker3Status == 'reserved') $Locker3Color = '#ffcc00';
        	        else if($Locker3Status == 'occupied') $Locker3Color = '#ff3333';
        	    }
        	    else if ($rowNumber == 3)
        	    {
        	        $Locker4UserIdNumber = $thisRow['id_number'];
        	        $Locker4Status = $thisRow['status'];
        	        if($Locker4Status == 'available') $Locker4Color = '#00b300';
        	        else if($Locker4Status == 'reserved') $Locker4Color = '#ffcc00';
        	        else if($Locker4Status == 'occupied') $Locker4Color = '#ff3333';
        	    }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="css/ModalPopup.css">
        <title>View Lockers</title>
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
		.lockerup{
			width:200px;
			height:200px;
			font-size: 16px;
			margin-left:500px;
		}
		.lockerdown{
			width:200px;
			height:200px;
			font-size: 16px;
		}
		.legend1{
		background-color: #00b300;
		border: none;
		color: white;
		width: 30px;
		height: 30px;
		padding: 5px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin-left:500px;
		cursor: pointer;
		}
		.legend2{
		background-color: #ffcc00;
		border: none;
		color: white;
		width: 30px;
		height: 30px;
		padding: 5px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin-left:500px;
		cursor: pointer;
		}
		.legend3{
		background-color: #ff3333;
		border: none;
		color: white;
		width: 30px;
		height: 30px;
		padding: 5px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin-left:500px;
		cursor: pointer;
		}
		
		</style>
    </head>
    <body>
			<a href="logout.php" class="logout">Logout</a></br>
            <a href="admin.php" class="logout">Home</a></br>
        <button type="button" class="lockerup" onclick="selectionFunction(<?php echo $Locker1UserIdNumber?>)" style="background: <?php echo $Locker1Color; ?>";>Locker 1</button>
        <button type="button" class="lockerdown" onclick="selectionFunction(<?php echo $Locker2UserIdNumber?>)" style="background: <?php echo $Locker2Color; ?>";>Locker 2</button>
		</br>
		<button type="button" class="lockerup" onclick="selectionFunction(<?php echo $Locker3UserIdNumber?>)" style="background: <?php echo $Locker3Color; ?>";>Locker 3</button>
        <button type="button" class="lockerdown" onclick="selectionFunction(<?php echo $Locker4UserIdNumber?>)" style="background: <?php echo $Locker4Color; ?>";>Locker 4</button>
        </br></br>
		<h2><button type="button" class="legend1"></button><small>  Available</small></h2>
		<h2><button type="button" class="legend2"></button><small>  Reserved</small></h2>
		<h2><button type="button" class="legend3"></button><small>  Occupied</small></h2>
		
		<div id="myModal" class="modal">
        <!-- Modal content -->
            <div id="userDetailsResult" style="width:300px" class="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');
        
        // Get the button that opens the modal
        //var btnLocker1 = document.getElementById("BtnLocker1");
        //var btnLocker2 = document.getElementById("BtnLocker2");
        //var btnLocker3 = document.getElementById("BtnLocker3");
        //var btnLocker4 = document.getElementById("BtnLocker4");
        
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        
        function selectionFunction(idNumber) {
            modal.style.display = "block";
            
            modal.style.display = "block";
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("userDetailsResult").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "getuserdetails.php?idNumber="+idNumber, true);
            xhttp.send();
        }
        
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    </body>
</html>