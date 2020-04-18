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
    REFERENCES `states` (`ID_State`),
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
  `URolesN` VARCHAR(25) DEFAULT NULL,
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
  `Pa_MInit` VARCHAR(1),
  `Pa_LName` VARCHAR(20) NOT NULL,
  `CardType` INT(1) NOT NULL,
  `CardNum` INT(12) NOT NULL,
  `ExpMonth` INT(2) NOT NULL,
  `ExpYear` INT(2) NOT NULL,
  `CVV` INT(3) NOT NULL,
  PRIMARY KEY (`ID_Payment`),
  CONSTRAINT `FK_CardType`
    FOREIGN KEY (`CardType`)
    REFERENCES `e_commerce`.`card_type` (`ID_CType`),
  CONSTRAINT `FK_ID_Payment`
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
  `CTypeN` VARCHAR(20) NOT NULL,
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
DROP TABLE IF EXISTS `states`;
CREATE TABLE IF NOT EXISTS `states` (
  `ID_State` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `StateAbbreviation` CHAR(2) NOT NULL,
  `StateName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`ID_State`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`ID_State`, `StateAbbreviation`, `StateName`) VALUES
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
-- Table `e_commerce`.`products`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID_Product` INT(7) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `PrName` VARCHAR(50) NOT NULL,
  `PrDesc` VARCHAR(120) NOT NULL,
  `Price` DECIMAL(8,2) NOT NULL,
  `ImageName` VARCHAR(25),
  `Category` INT(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`ID_Product`),
  CONSTRAINT `FK_Category`
    FOREIGN KEY (`Category`)
    REFERENCES `e_commerce`.`categories` (`ID_Category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PrName`, `PrDesc`, `Price`, `ImageName`, `Category`) VALUES
('Sofa', 'A long, comfy chair that seats multiple people.', 800.00, 'Sofa', 1),
('Dining Chair', 'A chair intented to matched with a dining table. It will be comfortable with the included cushion.', 250.00, 'Dining_Chair', 1),
('Vase', 'A ceramic container that can hold liquids. Intended for flowers, but you do you.', 50.00, 'Vase', 1),
('Frame', 'A hangable holder for pictures and other small memorable items. I guess maybe pressed flowers as well.', 10.00, 'Frame', 1),
('Small Jar', 'A container that can hold items such as candy, mints, chocolates, candy...do you see where I am going with this?', 800.00, 'Small_Jar', 1);

-- -----------------------------------------------------
-- Table `e_commerce`.`categories`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID_Category` INT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Category_Name` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `categories` (`ID_Category`, `Category_Name`) VALUES
(1, 'Furniture'),
(2, 'Appliances'),
(3, 'Electronics');

-- -----------------------------------------------------
-- Table `e_commerce`.`cart`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `ID_Cart` INT(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `ID_Cust` INT(6) UNSIGNED ZEROFILL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `CStatus` INT(1) DEFAULT 1,
  `Total` decimal(8,2),
  PRIMARY KEY (`ID_Cart`),
  CONSTRAINT `FK_Cust_ID`
    FOREIGN KEY (`ID_Cust`)
    REFERENCES `e_commerce`.`profile` (`ID_Profile`),
  CONSTRAINT `FK_CStatus`
    FOREIGN KEY (`CStatus`)
    REFERENCES `e_commerce`.`status_cart` (`ID_CStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


-- -----------------------------------------------------
-- Table `e_commerce`.`status_cart`
-- -----------------------------------------------------

DROP TABLE IF EXISTS `status_cart`;
CREATE TABLE IF NOT EXISTS `status_cart` (
  `ID_CStatus` INT(1) NOT NULL AUTO_INCREMENT,
  `StatusName` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`ID_CStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_cart`
--

INSERT INTO `status_cart` (`ID_CStatus`, `StatusName`) VALUES
(1, 'Shopping'),
(2, 'Complete');



DROP TABLE IF EXISTS `cartItems`;
CREATE TABLE IF NOT EXISTS `cartItems` (
  `ID_CartItem` INT(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `CartID` INT(8) UNSIGNED NOT NULL,
  `ProductID` INT(7) UNSIGNED NOT NULL,
  `Quantity` INT(2) DEFAULT 1,
  `Price` decimal(8,2) ,
  PRIMARY KEY (`ID_CartItem`),
  CONSTRAINT `FK_CartID`
    FOREIGN KEY (`CartID`)
    REFERENCES `e_commerce`.`cart` (`ID_Cart`),
  CONSTRAINT `FK_ProductID`
    FOREIGN KEY (`ProductID`)
    REFERENCES `e_commerce`.`products` (`ID_Product`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;