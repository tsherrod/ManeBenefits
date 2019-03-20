use mysql;
create database cardDB;
use cardDB;

CREATE TABLE cardReg (
  FirstName varchar(64),
  LastName 	varchar(64),
  Email 	varchar(64),
  Phone 	int(12),
  City 		varchar(12),
  resState 	varchar(12),
  PRIMARY KEY(Email)
);

/* TEMPORARY PROCEDURE: TESTING PURPOSES */
CREATE PROCEDURE cardDB.populateCard
AS
BEGIN
	INSERT INTO cardDB.cardReg(FirstName, LastName, Email, Phone, City, resState)
	VALUES('Milton', 'Bain', 'mbain@una.edu', 5551234567, 'Florence', 'Alabama');

END cardDB.populateCard;

/* TEMPORARY PROCEDURE: TESTING PURPOSES */
CREATE PROCEDURE cardDB.nukeCard
AS
BEGIN
	DELETE FROM cardReg
END;

/* TEMPORARY PROCEDURE: TESTING PURPOSES */
CREATE PROCEDURE cardDB.displayCard
AS
BEGIN
	SELECT * FROM cardReg
END;



CREATE PROCEDURE cardDB.registerCard
  @pCardNum int(12),
  @pFirstName varchar(64),
  @pLastName varchar(64),
  @pEmail varchar(64),
  @pPhone int(12),
  @pCity varchar(12),
  @presState varchar(12),
  @responseMessage VARCHAR(250) OUTPUT
AS
BEGIN
  SET NOCOUNT ON 
  
  BEGIN TRY
  
    INSERT INTO cardDB.cardReg (FirstName, LastName, Email, Phone, City, resState)
	VALUES(@pFirstName, @pLastName, @pEmail, @pPhone, @pCity, @presState)
	
	SET @responseMessage='Success'
	
  END TRY
  
  BEGIN CATCH
    SET @responseMessage="Something went wrong. Please try again."
  END CATCH
  
END;