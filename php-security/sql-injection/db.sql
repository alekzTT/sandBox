CREATE DATABASE sql_injection;

CREATE TABLE `sql_injection`.`comments` ( `comment` VARCHAR(234) NOT NULL , `email` VARCHAR(234) NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `sql_injection`.`users` ( `uname` VARCHAR(234) NOT NULL , `upass` VARCHAR(234) NOT NULL ) ENGINE = InnoDB;


ALTER TABLE `comments` CHANGE `comment` `comment` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
