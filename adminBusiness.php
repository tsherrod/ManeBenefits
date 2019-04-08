<?php
session_start();

  if ($_SESSION['admin'] == FALSE) {
    header('Location: home.php');
	exit();
  }
  
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbName = "businessDB";
	  
	$connection = new mysqli($host, $username, $password, $dbName); /* xammp: username: root no pass  business DATABASE */ 
	if(!$connection) {
	  die('Could not connect: ' . mysqli_connect_error());
	} 
	
    if($_POST['business'] == "Populatebusiness") {

		$sql = "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(1,'Rice Box','1529 N Wood Ave, Florence, AL 35630','Restaurants','15% off your entire purchase ** excludes alcohol','https://www.facebook.com/RiceBox256/','','');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(2,'Homeside','Homeside Restaurant, 3922 Cloverdale Rd, 35633 Florence','Restaurants','10% off your entire purchase.','https://www.facebook.com/homesiderestaurant/','','');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(3,'Soul Wingery & Records','Soul: Wingery and Records, 105 S. Poplar Street, 35630 Florence','Restaurants','10% off your entire purchase.','https://www.facebook.com/SoulWingsandRecords/','','');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(4,'Marco\'s Pizza','3250 Florence Blvd, Florence, AL 35634','Restaurants','25% off carry out and dine in *cannot be combined with any other offers','https://www.facebook.com/MarcosPizzaFlorenceBlvdAL/','','https://www.marcos.com/locations/');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(5,'306 BBQ','','Restaurants','10% off your entire purchase ** excludes alcohol','https://www.facebook.com/306BBQ.Florence/?fref=ts','https://www.instagram.com/306bbq.florence/?hl=en','http://306bbq.com/florence/');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(6,'Season\'s','1420 Huntsville Rd, Florence, AL 35630','Restaurants','10% off your purchase','https://www.facebook.com/Seasons1420/','https://www.instagram.com/seasonsfood1420/?hl=en','');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(7,'Rattlesnake Saloon','Rattlesnake Saloon, 1292 Mount Mills Rd, 35674 Tuscumbia','Restaurants','15% off your purchase *excludes alcohol','https://www.facebook.com/Rattlesnake-Saloon-144201392286795/','','https://www.rattlesnakesaloon.net/');";
		$sql .= "INSERT INTO businessDB.businesses(ID,name,address,category,discount,facebook,instagram,website) VALUES(8,'FloBama','','Restaurants','15% off your entire purchase before 5pm ** dine in only ** excludes alcohol','https://www.facebook.com/flobamamusic/?fref=ts','','')";
		
		$connection->multi_query($sql);
		
		$connection->close();
		header('Location: home.php');
		exit();
	}
	
	elseif($_POST['business'] == "Displaybusiness") {
	  	$sql = "SELECT * FROM businessDB.businesses";
		$result = $connection->query($sql);
		
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row['ID'] . " " . $row['name'] . " " . $row['address'] . " " . 
					$row['category'] . " " .  $row['discount'] . " " . $row['facebook'] . 
					" " . $row['instagram'] . " " .  $row['website'] . "<br>";
			}
		}
		$connection->close();
		echo "<br><br>";
		echo "<form action=\"home.php\" method=\"get\"> <input type=\"submit\" value=\"Return Home\" name=\"Home\" id=\"Home\"> </form>";
	}
	
	elseif($_POST['business'] == "Nukebusiness") {
		$sql = "DELETE FROM businessDB.businesses";
		$connection->query($sql);
		
		$connection->close();
		header('Location: home.php');
		exit();
	}
?>