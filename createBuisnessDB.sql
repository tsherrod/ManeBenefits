use mysql;
create database buisnessDB;
use buisnessDB;

CREATE TABLE buisnesses (
  ID int(11) NOT NULL auto_increment,
  name varchar(32) default NOT NULL,
  address varchar(80) default NULL,
  category varchar(11) default NOT NULL,
  discount varchar(80) default NOT NULL,
  facebook varchar(80) default NULL,
  instagram varchar(80) default NULL,
  website varchar(64) default NULL
  PRIMARY KEY (ID)
)

/* TEMP PROCEDURE: FOR TESTING PURPOSES */
CREATE PROCEDURE buisnessDB.populateDB
AS
BEGIN
  INSERT INTO buisnesses VALUES(1,"Rice Box","1529 N Wood Ave, Florence, AL 35630","Restaurants","15% off your entire purchase ** excludes alcohol","https://www.facebook.com/RiceBox256/","","");
  INSERT INTO buisnesses VALUES(2,"Homeside","Homeside Restaurant, 3922 Cloverdale Rd, 35633 Florence","Restaurants","10% off your entire purchase.","https://www.facebook.com/homesiderestaurant/","","");
  INSERT INTO buisnesses VALUES(3,"Soul Wingery & Records","Soul: Wingery and Records, 105 S. Poplar Street, 35630 Florence","Restaurants","10% off your entire purchase.","https://www.facebook.com/SoulWingsandRecords/","","");
  INSERT INTO buisnesses VALUES(4,"Marco's Pizza","3250 Florence Blvd, Florence, AL 35634","Restaurants","25% off carry out and dine in *cannot be combined with any other offers","https://www.facebook.com/MarcosPizzaFlorenceBlvdAL/","","https://www.marcos.com/locations/");
  INSERT INTO buisnesses VALUES(5,"306 BBQ","","Restaurants","10% off your entire purchase ** excludes alcohol","https://www.facebook.com/306BBQ.Florence/?fref=ts","https://www.instagram.com/306bbq.florence/?hl=en","http://306bbq.com/florence/");
  INSERT INTO buisnesses VALUES(6,"Season's","1420 Huntsville Rd, Florence, AL 35630","Restaurants","10% off your purchase","https://www.facebook.com/Seasons1420/","https://www.instagram.com/seasonsfood1420/?hl=en","");
  INSERT INTO buisnesses VALUES(7,"Rattlesnake Saloon","Rattlesnake Saloon, 1292 Mount Mills Rd, 35674 Tuscumbia","Restaurants","15% off your purchase *excludes alcohol","https://www.facebook.com/Rattlesnake-Saloon-144201392286795/","","https://www.rattlesnakesaloon.net/");
  INSERT INTO buisnesses VALUES(8,"FloBama","","Restaurants","15% off your entire purchase before 5pm ** dine in only ** excludes alcohol","https://www.facebook.com/flobamamusic/?fref=ts","","");
END

/* TEMP PROCEDURE: FOR TESTING PURPOSES */
CREATE PROCEDURE buisnessDB.nukeDB
AS
BEGIN
  DELETE FROM buisnesses
END

/* TEMPORARY PROCEDURE: TESTING PURPOSES */
CREATE PROCEDURE buisnessDB.displayDB
AS
BEGIN
	SELECT * FROM buisnesses
END



CREATE PROCEDURE buisnessDB.addBuisness
  @pName varchar(32),
  @pAddress varchar(80),
  @pCategory varchar(11),
  @pDiscount varchar(80),
  @pFacebook varchar(80),
  @pInstagram varchar(80),
  @pWebsite varchar(64),
  @responseMessage VARCHAR(250) OUTPUT
AS
BEGIN

  SET NOCOUNT ON
  
  BEGIN TRY 
  
    INSERT INTO buisnessDB.buisnesses (name, address, category, discount, facebook, instagram, website)
	VALUES (@pName, @pAddress, @pCategory, @pDiscount, @pFacebook, @pInstagram, @pWebsite)
	
	SET @responseMessage='Success'
	
  END TRY
  
  BEGIN CATCH 
    SET @responseMessage=ERROR_MESSAGE()
  END CATCH
END



CREATE PROCEDURE buisnessDB.removeBuisness
  @pName
  @responseMessage VARCHAR(250) OUTPUT
AS
BEGIN

  SET NOCOUNT ON
  
  BEGIN TRY
  
    DELETE FROM buisnessDB.buisnesses WHERE buisnesses.name = @pName
	SET @responseMessage='Success'
	
  END TRY
  
  BEGIN CATCH
    SET @responseMessage=ERROR_MESSAGE()
  END CATCH
END