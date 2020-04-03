SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema e_commerce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `e_commerce` DEFAULT CHARACTER SET latin1 ;
USE `e_commerce` ;

-- -----------------------------------------------------
-- Table `e_commerce`.`competitor-2017`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fuelClient`.`competitor-2017` (
  `ID_Competitor` INT(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `CompetitorName` VARCHAR(15) NOT NULL,
  `January` DECIMAL(4,3) UNSIGNED NOT NULL,
  `February` DECIMAL(4,3) UNSIGNED NOT NULL,
  `March` DECIMAL(4,3) UNSIGNED NOT NULL,
  `April` DECIMAL(4,3) UNSIGNED NOT NULL,
  `May` DECIMAL(4,3) UNSIGNED NOT NULL,
  `June` DECIMAL(4,3) UNSIGNED NOT NULL,
  `July` DECIMAL(4,3) UNSIGNED NOT NULL,
  `August` DECIMAL(4,3) UNSIGNED NOT NULL,
  `September` DECIMAL(4,3) UNSIGNED NOT NULL,
  `October` DECIMAL(4,3) UNSIGNED NOT NULL,
  `November` DECIMAL(4,3) UNSIGNED NOT NULL,
  `Decemeber` DECIMAL(4,3) UNSIGNED NOT NULL,
  PRIMARY KEY (`ID_Competitor`),
  UNIQUE INDEX `ID_Competitor_UNIQUE` (`ID_Competitor` ASC),
  UNIQUE INDEX `CompetitorName_UNIQUE` (`CompetitorName` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1001
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `e_commerce`.`profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e_commerce`.`profile` (
  `ID_Profile` INT(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(30) NOT NULL,
  `FName` VARCHAR(20) NOT NULL,
  `LName` VARCHAR(20) NOT NULL,
  `Address` VARCHAR(45) NOT NULL,
  `City` VARCHAR(20) NOT NULL,
  `State` tinyint(4) NOT NULL,
  `Zipcode` INT(5) NOT NULL,
  PRIMARY KEY (`ID_Profile`),
  KEY `profile_ibfk_1` (`State`),
  UNIQUE INDEX `ID_Profile_UNIQUE` (`ID_Profile` ASC) ,
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC) ) 
  
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`State`) REFERENCES `states` (`StateID`);

-- -----------------------------------------------------
-- Table `e_commerce`.`credentials`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `e_commerce`.`credentials` (
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
CREATE TABLE IF NOT EXISTS `e_commerce`.`payment` (
  `ID_Payment` INT(6) UNSIGNED ZEROFILL NOT NULL,
  `P_FName` VARCHAR(20) NOT NULL,
  `P_MInit` VARCHAR(1) NULL,
  `P_LName` VARCHAR(20) NOT NULL,
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

DROP TABLE IF EXISTS `card_type`;
CREATE TABLE IF NOT EXISTS `card_type` (
  `ID_CType` INT(1) NOT NULL AUTO_INCREMENT,
  `CTypeN` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`ID_CType`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card_type`
--

INSERT INTO `status` (`Code`, `Status`) VALUES
(1, 'MasterCard'),
(2, 'Visa'),
(3, 'American Express'),
(4, 'Discover Card'),
(5, 'Diners Club'),

-- -----------------------------------------------------
-- Table `e_commerce`.`fuelquote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `e_commerce`.`fuelquote` (
  `ID_FuelQuote` INT(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `ID_Profile` INT(6) UNSIGNED ZEROFILL NOT NULL,
  `GallonsRequested` INT(3) NOT NULL,
  `DeliveryDate` DATE NOT NULL,
  `DeliveryAddress` VARCHAR(45) NOT NULL,
  `DeliveryCity` VARCHAR(20) NOT NULL,
  `DeliveryState` INT(2) NOT NULL,
  `DeliveryZipCode` INT(5) NOT NULL,
  `FuelRate` DECIMAL(4,0) UNSIGNED NOT NULL,
  `TotalAmount` DECIMAL(6,0) UNSIGNED NOT NULL,
  PRIMARY KEY (`ID_FuelQuote`),
  UNIQUE INDEX `ID_FuelQuote_UNIQUE` (`ID_FuelQuote` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COMMENT = '	';


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

INSERT INTO `state` (`StateID`, `StateAbbreviation`, `StateName`) VALUES
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



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;