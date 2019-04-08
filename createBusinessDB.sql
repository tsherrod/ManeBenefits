create database businessDB;
use businessDB;

CREATE TABLE businesses (
  ID int(11) NOT NULL auto_increment,
  name varchar(32),
  address varchar(80),
  category varchar(11),
  discount varchar(80),
  facebook varchar(80),
  instagram varchar(80),
  website varchar(64),
  PRIMARY KEY (ID)
);