<?php
session_start();

    $first_name = strip_tags($_POST['first_name']);
	$last_name = strip_tags($_POST['last_name']);
	$email = strip_tags($_POST['email']);
	$phone = strip_tags($_POST['phone']);
	
	$first_name = stripslashes($first_name);
	$last_name = stripslashes($last_name);
	$email = stripslashes($email);
	$phone = stripslashes($phone);

	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "cardDB";
	$connection = new mysqli($host, $user, $pass, $dbname);
	
	if(!$connection) {
		die('Could not connect: ' . mysqli_connect_error());
	} 
	
	$sql = "INSERT INTO cardDB.cardReg(FirstName,LastName,Email,Phone) VALUES ('$first_name','$last_name','$email','$phone')";
	$result = $connection->query($sql);
	
	if($result) {
		echo "Success!";
		
		$connection->close();
		echo "<br><br>";
		echo "<form action=\"home.php\" method=\"get\"> <input type=\"submit\" value=\"Return Home\" name=\"Home\" id=\"Home\"> </form>";
	}
	else {
		echo "Something went wrong!";
		$connection->close();
		echo "<br><br>";
		echo "<form action=\"home.php\" method=\"get\"> <input type=\"submit\" value=\"Return Home\" name=\"Home\" id=\"Home\"> </form>";
	}
	
?>