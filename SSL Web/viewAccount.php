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
	<link rel="stylesheet" href="css/ModalPopup.css">
    <meta charset="UTF-8">
    <title>View Account</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 5px;
			text-align: center;
        }
        th {
			text-align: center;
			
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
		 .remove{
		background-color: #42DAE7;
		border: none;
		color: white;
		width: 100px;
		height: 25px;
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
        <div class="admin-page">
            
            <a href="logout.php" class="logout">Logout</a></br>
            <a href="admin.php" class="logout">Home</a>
            <div>
                <table>
					</br>
                    <tr>
                    <th>ID number</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Action</th>
                    </tr>
                    <tr>
                <?php
                    for($rowNumber = 0; $rowNumber < $numberOfUsersRow; ++$rowNumber){
                	    $selectTableQueryResult -> data_seek($rowNumber);
                	    $thisRow = $selectTableQueryResult -> fetch_array(MYSQLI_ASSOC);?>
                        
                        <td><?php echo $thisRow['id_number'];?></td>
                        <td><?php echo $thisRow['name']; ?></td>
                        <td><?php echo $thisRow['mobile_number']; ?></td>
                        <td>
							<button type="button" class="remove" onclick="removeAccount(<?php echo $thisRow['id_number'];?>)">Remove</button>
							<button type="button" class="remove" onclick="selectionFunction(<?php echo $thisRow['id_number'];?>)">view penalty</button>
						</td>
                        </tr>
                <?php	}?>
                </table>
            </div>
        </div>
		
		<div id="myModal" class="modal">
        <!-- Modal content -->
            <div id="userDetailsResult" style="width:300px" class="modal-content">
                <span class="close">&times;</span>
            </div>
        </div>
    <script>
	
	function removeAccount(id_number) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        };
        xhttp.open("GET", "removeAccount.php?q="+id_number, true);
        xhttp.send();
    }
	
	// Get the modal
	var modal = document.getElementById('myModal');
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
		xhttp.open("GET", "getuserpenalty.php?idNumber="+idNumber, true);
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