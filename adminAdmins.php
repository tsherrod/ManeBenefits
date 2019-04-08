<?php
session_start();

  if ($_SESSION['admin'] == FALSE) {
    header('Location: home.php');
	exit();
  }
  
    $host = "localhost";
    $username = "root";
    $password = "";
	$dbName = "adminDB";  
	  
	$connection = new mysqli($host, $username, $password, $dbName); /* xammp: username: root no pass  business DATABASE */ 
	if(!$connection) {
	  die('Could not connect: ' . mysqli_connect_error());
	} 
	
	$sql = "SELECT * FROM admins";
	$result = $connection->query($sql);
	
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo $row['FirstName'] . " " . $row['LastName'] . " " . $row['Username'] . " " . 
				 $row['PasswordHash'] . "<br>"; 
		}
	}
	
	$connection->close();
	echo "<br><br>";
	echo "<form action=\"home.php\" method=\"get\"> <input type=\"submit\" value=\"Return Home\" name=\"Home\" id=\"Home\"> </form>";
?>