<?php
session_start();

	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "adminDB";
	$connection = new mysqli($host, $user, $pass, $dbname);
	
	if(!$connection) {
	  die('Could not connect: ' . mysqli_connect_error());
	} 

	$sql = "SELECT PasswordHash FROM admins WHERE Username = '$username'";
	
	$databasePassword = $connection->query($sql);
	$row = $databasePassword->fetch_assoc();
	$hash = $row['PasswordHash'];
	//echo $hash;
	
	if($databasePassword->num_rows == 0) {
		$_SESSION['admin'] = FALSE;
		$message = "INVALID USERNAME";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: login.html');
		exit();
	}
	
	if (!password_verify($password, /*$hash*/'$2y$10$drJuYm4cCxpsHipJGjq8S.I62cEh2tTQD8hWt/wwZAfT/.Msm2nqm')) {
		$_SESSION['admin'] = FALSE;
		$message = "INVALID PASSWORD";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header('Location: login.html');
		exit();
	} else {
		$_SESSION['admin'] = TRUE;
		header('Location: home.php');
	}
?>