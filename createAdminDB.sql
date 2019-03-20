use mysql;
create database adminDB;
use adminDB;

CREATE TABLE admins (
  ID int(11) NOT NULL auto_increment,
  FirstName varchar(64),
  LastName varchar(64),
  Username varchar(64),
  PasswordHash BINARY(64),
  PRIMARY KEY (ID)
);

CREATE PROCEDURE adminDB.createAdmin
  @pFirstName varchar(64),
  @pLastName varchar(64),
  @pUsername VARCHAR(64),
  @pPassword VARCHAR(64),
  @responseMessage VARCHAR(250) OUTPUT
AS
BEGIN
  SET NOCOUNT ON
  
  BEGIN TRY
  
    INSERT INTO adminDB.admins (FirstName, LastName, Username, PasswordHash)
	VALUES(@pFirstName, @pLastName, @pUsername, @pPassword)
	
	SET @responseMessage='Success'
	
  END TRY
  
  BEGIN CATCH
    SET @responseMessage=ERROR_MESSAGE()
  END CATCH 

END



CREATE PROCEDURE adminDB.adminLogin
  @pUsername VARCHAR(64),
  @pPassword VARCHAR(64),
  @responseMessage VARCHAR(250)='' OUTPUT
AS
BEGIN
  
  SET NOCOUNT ON
  
  DECLARE @userID INT
  
  IF EXISTS (SELECT TOP 1 ID FROM admindb.admins WHERE Username=@pUsername)
    BEGIN
      SET @userID=(SELECT ID FROM adminDB.admins WHERE Username=@pUsername AND @pPassword = TRUE)
	
	  IF(@userID IS NULL) 
	    SET @responseMessage = 'Invalid Login Information.'
		RETURN(FALSE)
	  
	  ELSE 
	    SET @responseMessage = 'User successfully logged in.'
		RETURN(TRUE)

    END
	
  ELSE
    SET @responseMessage = 'Invalid Login Information.'
    RETURN(FALSE)
END