create database adminDB;
use adminDB;

CREATE TABLE admins (
  ID int(11) NOT NULL auto_increment,
  FirstName varchar(64),
  LastName varchar(64),
  Username varchar(64),
  PasswordHash binary(255),
  PRIMARY KEY (ID)
);

INSERT INTO adminDB.admins(FirstName,LastName,Username,PasswordHash) VALUES('FirstAdmin','FirstAdmin','admin','$2y$10$drJuYm4cCxpsHipJGjq8S.I62cEh2tTQD8hWt/wwZAfT/.Msm2nqm');