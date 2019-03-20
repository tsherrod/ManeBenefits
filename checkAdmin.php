<?php
session_start();

	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	$connection = mysql_connect('localhost','root',''); /* xammp: username: root no pass*/
	if(!$connection) {
	  die('Could not connect: ' . mysql_error());
	}

	$databasePassword = mysql_query($connection, 'SELECT PasswordHash FROM adminDB.admins WHERE $username = Username' or die("Something went wrong: " . mysql_error()));
	
	$verifyPassword = password_verify($password, $databasePassword);
	$result = mysql_query($connection, 'EXEC adminDB.adminLogin($username,$verifyPassword)' or die("Something went wrong: " . mysql_error()));
	
	if ($result == FALSE) {
		$_SESSION['admin'] = FALSE;
		header('Location: login.html');
		exit();
	}
	
    if ($result == TRUE) {
		$_SESSION['admin'] = TRUE;
		header('Location: home.php');
		exit();
	}
?>