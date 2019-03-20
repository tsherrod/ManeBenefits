<?php
session_start();

    if($_SESSION['admin'] == FALSE) {
	    header('Location: home.php');
	    exit();
    }
	
    $first_name = strip_tags($_POST['first_name']);
	$last_name = strip_tags($_POST['last_name']);
  	$username = strip_tags($_POST['Username']);
	$password = strip_tags($_POST['Password']);
	
	$first_name = stripslashes($first_name);
	$last_name = stripslashes($last_name);
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	if($_SESSION['admin'] == TRUE) {
	
		$host = "localhost";
		$user = "root";
		$passw = "";
		$dbName = "adminDB";
		$connection = new mysqli($host, $user, $pass, $dbName);
	  
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	  
		$sql = "INSERT INTO adminDB.admins(FirstName, LastName, Username, PasswordHash) VALUES ('$first_name','$last_name','$username','$hashed_password');";
		$connection->query($sql);
		
		$connection->close();
		header('Location: home.php');
		exit();
	}
?>