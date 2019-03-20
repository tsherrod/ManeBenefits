<?php session_start(); 
	$_SESSION['admin'] = FALSE
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	
	  <form action="register.html" method="get">
	    <input type="submit" value="Register Card" name="register" id="register">
	  </form>
	  <br>
	  <form action="login.html" method="get">
		<input type="submit" value="Admin Login" name="admin" id="admin">
	  </form>
	  <br><br>
	  <?php 
	    if ($_SESSION['admin'] == TRUE) {
	  ?>
	  
	    <form action="admin.php" method="post">
	      <input type="radio" name="PopulateBuisness" value="PopulateBuisness">Populate Buisness Database <br>
	      <input type="radio" name="DisplayBuisness" value="DisplayBuisness">Display Buisness Database <br>
	      <input type="radio" name="NukeBuisness" value="NukeBuisness">Clear Buisness Database <br>
		  <br>
		  <input type="radio" name="PopulateCard" value="PopulateCard">Populate Card Database <br>
		  <input type="radio" name="DisplayCard" value="DisplayCard">Display Card Database <br>
		  <input type="radio" name="NukeCard" value="NukeCard">Clear Card Database <br>
		  <br>
		  <input type="radio" name="CreateAdmin" value="CreateAdmin">Create Admin Login <br>
		  <br><br>
	    </form>
		
		<form action="createAdmin.php" method="post">
		  <label for="first_name">First Name: </label>
		  <input type="text" id="first_name" name="first_name" maxlength="12" pattern="^\w[a-zA-Z]{1,12}$" required autocomplete="off">
		  <br>
		
		  <label for="last_name">Last Name: </label>
		  <input type="text" id="last_name" name="last_name" maxlength="12" pattern="^\w[a-zA-Z]{1,12}$" required autocomplete="off">
		  <br>
		 
		  <label for="Username">Username: </label>
		  <input type="text" id="Username" name="Username" maxlength="12" pattern="^\w[a-zA-Z0-9]{1,12}$" required autocomplete="off">
		  <br>
		  
		  <label for="Password">Password: </label>
		  <input type="password" id="Password" name="Password" maxlength="12" required autocomplete="off">
		  <br>
		  
		  <button type="submit" class="submit"> Submit </button> <br>
	    </form>
	  <?php } ?>
	</body>
</html>