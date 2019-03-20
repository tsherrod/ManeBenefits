<?php
session_start();

  if ($_SESSION['admin'] == FALSE) {
    header('Location: home.php')
	exit();
  }
  
  if (isset($_POST['PopulateBuiesness'] || isset($_POST['DisplayBuisness']) || isset($_POST['NukeBuisness']))) {
	$connection = mysql_connect('localhost','root',''); /* xammp: username: root no pass  BUISNESS DATABASE */ 
	if(!$connection) {
	  die('Could not connect: ' . mysql_error());
	} 
	
    if(isset($_POST['PopulateBuiesness']) {
	  mysql_query($connection, 'EXEC buisnessDB.populateDB()' or die("Something went wrong: " . mysql_error()));
	}
	
	elseif(isset($_POST['DisplayBuisness']) {
	  $result = ($connection, 'EXEC buisnessDB.displayDB()' or die("Something went wrong: " . mysql_error()));
	  echo $result
	}
	
	elseif(isset($_POST['NukeBuisness']) {
	  mysql_query($connection, 'EXEC buisnessDB.nukeDB()' or die("Something went wrong: " . mysql_error()));	
	}
	
  }
  
  if (isset($_POST['PopulateCard']) || isset($_POST['DisplayCard']) || isset($_POST['NukeCard'])) {
	  $connection = mysql_connect('localhost','root',''); /* xammp: username: root no pass  CARD DATABASE */ 
	  if(!$connection) {
	    die('Could not connect: ' . mysql_error());
	  } 
	 
	  if(isset($_POST['PopulateCard']) {
	    mysql_query($connection, 'EXEC cardDB.populateCard()' or die("Something went wrong: " . mysql_error()));
	  }

	  elseif(isset($_POST['DisplayCard']) {
		$result = mysql_query($connection, 'EXEC cardDB.displayCard()' or die("Something went wrong: " . mysql_error()));
		echo result 
	  }
	
	  elseif(isset($_POST['NukeCard']) {
		mysql_query($connection, 'EXEC cardDB.nukeCard()' or die("Something went wrong: " . mysql_error()));		
      }
  }
  
?>  