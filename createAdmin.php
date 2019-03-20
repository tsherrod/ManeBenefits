<?php
session_start();

    if($_SESSION['admin'] == FALSE) {
	    header('Location: home.php')
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
	
      $connection = mysql_connect('localhost','root','');
	  
	  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
	  
	  mysql_query($connection, 'EXEC adminDB.createAdmin($username,$password,$username,$hashed_password)' or die("Something went wrong: " . mysql_error()));
	
	}
?>