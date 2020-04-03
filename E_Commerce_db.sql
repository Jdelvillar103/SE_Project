SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema e_commerce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `e_commerce` DEFAULT CHARACTER SET latin1 ;
USE `e_commerce` ;


-- -----------------------------------------------------
-- Table `e_commerce`.`profile`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `ID_Profile` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(30) NOT NULL,
  `FName` VARCHAR(20) NOT NULL,
  `LName` VARCHAR(20) NOT NULL,
  `Address` VARCHAR(45) NOT NULL,
  `City` VARCHAR(20) NOT NULL,
  `State` tinyint(4) NOT NULL,
  `Zipcode` INT(5) NOT NULL,
  `Role` INT(1) NOT NULL DEFAULT 2, -- Need a trigger so that when they enter a payment method, their account is upgraded
  PRIMARY KEY (`ID_Profile`),
  UNIQUE INDEX `ID_Profile_UNIQUE` (`ID_Profile` ASC) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC),
  CONSTRAINT `profile_ibfk_1` 
	FOREIGN KEY (`State`) 
    REFERENCES `states` (`StateID`),
  CONSTRAINT `profile_ibfk_2` 
	FOREIGN KEY (`Role`) 
    REFERENCES `user_roles` (`ID_URoles`)) 
  
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `e_commerce`.`user_roles`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `ID_URoles` INT(1) NOT NULL AUTO_INCREMENT,
  `URolesN` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`ID_URoles`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_type`
--

INSERT INTO `user_roles` (`ID_URoles`, `URolesN`) VALUES
(1, 'Registered w/Payment'),
(2, 'Registered w/o Payment'),
(3, 'Administrator'),
(4, 'Employee');


-- -----------------------------------------------------
-- Table `e_commerce`.`credentials`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `ID_Credentials` INT(6) UNSIGNED ZEROFILL NOT NULL,
  `Password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`ID_Credentials`),
  UNIQUE INDEX `ID_Credentials_UNIQUE` (`ID_Credentials` ASC) ,
  CONSTRAINT `FK_Profile_ID`
    FOREIGN KEY (`ID_Credentials`)
    REFERENCES `e_commerce`.`profile` (`ID_Profile`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `e_commerce`.`payment`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `ID_Payment` INT(6) UNSIGNED ZEROFILL NOT NULL,
  `Pa_FName` VARCHAR(20) NOT NULL,
  `Pa_MInit` VARCHAR(1) NULL,
  `Pa_LName` VARCHAR(20) NOT NULL,
  `CardType` INT(1) NOT NULL,
  `CardNum` INT(12) NOT NULL,
  `ExpMonth` INT(2) NOT NULL,
  `ExpYear` INT(2) NOT NULL,
  `CVV` INT(3) NOT NULL,
  PRIMARY KEY (`ID_Payment`),
  UNIQUE INDEX `ID_Payment_UNIQUE` (`ID_Payment` ASC) ,
  CONSTRAINT `FK_CardType`
    FOREIGN KEY (`CardType`)
    REFERENCES `e_commerce`.`card_type` (`ID_CType`),
  CONSTRAINT `FK_Profile_ID`
    FOREIGN KEY (`ID_Payment`)
    REFERENCES `e_commerce`.`profile` (`ID_Profile`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `e_commerce`.`card_type`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `card_type`;
CREATE TABLE IF NOT EXISTS `card_type` (
  `ID_CType` INT(1) NOT NULL AUTO_INCREMENT,
  `CTypeN` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`ID_CType`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_type`
--

INSERT INTO `card_type` (`ID_CType`, `CTypeN`) VALUES
(1, 'MasterCard'),
(2, 'Visa'),
(3, 'American Express'),
(4, 'Discover Card'),
(5, 'Diners Club');


-- -----------------------------------------------------
-- Table `e_commerce`.`states`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `states` (
  `StateID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `StateAbbreviation` char(2) NOT NULL,
  `StateName` varchar(15) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `StateAbbreviation`, `StateName`) VALUES
(1, 'AL', 'Alabama'),
(2, 'AK', 'Alaska'),
(3, 'AZ', 'Arizona'),
(4, 'AR', 'Arkansas'),
(5, 'CA', 'California'),
(6, 'CO', 'Colorado'),
(7, 'CT', 'Connecticut'),
(8, 'DE', 'Delaware'),
(9, 'FL', 'Florida'),
(10, 'GA', 'Georgia'),
(11, 'HI', 'Hawaii'),
(12, 'ID', 'Idaho'),
(13, 'IL', 'Illinois'),
(14, 'IN', 'Indiana'),
(15, 'IA', 'Iowa'),
(16, 'KS', 'Kansas'),
(17, 'KY', 'Kentucky'),
(18, 'LA', 'Louisiana'),
(19, 'ME', 'Maine'),
(20, 'MD', 'Maryland'),
(21, 'MA', 'Massachusetts'),
(22, 'MI', 'Michigan'),
(23, 'MN', 'Minnesota'),
(24, 'MS', 'Mississippi'),
(25, 'MO', 'Missouri'),
(26, 'MT', 'Montana'),
(27, 'NE', 'Nebraska'),
(28, 'NV', 'Nevada'),
(29, 'NH', 'New Hampshire'),
(30, 'NJ', 'New Jersey'),
(31, 'NM', 'New Mexico'),
(32, 'NY', 'New York'),
(33, 'NC', 'North Carolina'),
(34, 'ND', 'North Dakota'),
(35, 'OH', 'Ohio'),
(36, 'OK', 'Oklahoma'),
(37, 'OR', 'Oregon'),
(38, 'PA', 'Pennsylvania'),
(39, 'RI', 'Rhode Island'),
(40, 'SC', 'South Carolina'),
(41, 'SD', 'South Dakota'),
(42, 'TN', 'Tennessee'),
(43, 'TX', 'Texas'),
(44, 'UT', 'Utah'),
(45, 'VT', 'Vermont'),
(46, 'VA', 'Virginia'),
(47, 'WA', 'Washington'),
(48, 'WV', 'West Virginia'),
(49, 'WI', 'Wisconsin'),
(50, 'WY', 'Wyoming');


-- -----------------------------------------------------
-- Table `e_commerce`.`card_type`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID_Product` INT(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `PrName` VARCHAR(50) NOT NULL,
  `PrDesc` VARCHAR(120) NOT NULL,
  `Price` DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (`ID Product`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PrName`, `PrDesc`, `Price`) VALUES
('Sofa', 'A long, comfy chair that seats multiple people.', 800.00),
('Dining Chair', 'A chair intented to matched with a dining table. It will be comfortable with the included cushion', 250.00),
('Vase', 'A glass container that can hold liquids. Intended for flowers, but you do you.', 50.00),
('Frame', 'A hangable holder for pictures and other small memorable items. I guess maybe pressed flowers as well.', 10.00),
('Small Jar', 'A container that can hold items such as candy, mints, chocolates, candy, candy...do you see where I am going with this?', 800.00);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;