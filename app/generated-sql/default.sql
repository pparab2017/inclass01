
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Admin
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `hash` VARCHAR(255) NOT NULL,
    `fname` VARCHAR(255),
    `lname` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Messages`;

CREATE TABLE `Messages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `fromID` INTEGER,
    `toID` INTEGER,
    `time` DATETIME,
    `region` VARCHAR(300),
    `Content` VARCHAR(3000),
    `msgRead` enum('READ','NEW') DEFAULT 'NEW',
    `msgLock` enum('LOCK','UNLOCK') DEFAULT 'LOCK',
    PRIMARY KEY (`id`),
    INDEX `fk_from_Id_idx` (`fromID`),
    INDEX `fk_to_id_idx` (`toID`),
    CONSTRAINT `fk_from_Id`
        FOREIGN KEY (`fromID`)
        REFERENCES `User` (`id`),
    CONSTRAINT `fk_to_id`
        FOREIGN KEY (`toID`)
        REFERENCES `User` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Results
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Results`;

CREATE TABLE `Results`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `discount` INTEGER,
    `name` VARCHAR(300),
    `photo` VARCHAR(300),
    `price` DECIMAL(10,2),
    `region` VARCHAR(300),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- User
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `hash` VARCHAR(255) NOT NULL,
    `fname` VARCHAR(255),
    `lname` VARCHAR(255),
    `gender` enum('FEMALE','MALE'),
    `age` INTEGER NOT NULL,
    `weight` INTEGER NOT NULL,
    `address` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
