
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
-- NewUser
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `NewUser`;

CREATE TABLE `NewUser`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `hash` VARCHAR(255) NOT NULL,
    `fname` VARCHAR(255),
    `lname` VARCHAR(255),
    `gender` enum('FEMALE','MALE'),
    `role` enum('ADMIN','PATIENT') DEFAULT 'PATIENT',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Patient
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Patient`;

CREATE TABLE `Patient`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fkkuserid_participant_idx` (`user_id`),
    CONSTRAINT `fkkuserid_participant`
        FOREIGN KEY (`user_id`)
        REFERENCES `NewUser` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
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
-- SurveyLog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `SurveyLog`;

CREATE TABLE `SurveyLog`
(
    `id` INTEGER(5) NOT NULL AUTO_INCREMENT,
    `patient_id` INTEGER NOT NULL,
    `Q1` VARCHAR(255),
    `Q2` VARCHAR(255),
    `Q3` VARCHAR(255),
    `Q4` VARCHAR(255),
    `Q5` VARCHAR(255),
    `Q6` VARCHAR(255),
    `Q7` VARCHAR(255),
    `Q8` VARCHAR(255),
    `Q9` VARCHAR(255),
    `Q10` VARCHAR(255),
    `Q11` VARCHAR(255),
    `Q12` VARCHAR(255),
    `Q13` VARCHAR(255),
    `Q14` VARCHAR(255),
    `Q15` VARCHAR(255),
    `Q16` VARCHAR(255),
    `Q17` VARCHAR(255),
    `Q18` VARCHAR(255),
    `Q19` VARCHAR(255),
    `Q20` VARCHAR(255),
    `Q21` VARCHAR(255),
    `Q22` VARCHAR(255),
    `Q23` VARCHAR(255),
    `Q24` VARCHAR(255),
    `Q25` VARCHAR(255),
    `Q26` VARCHAR(255),
    `Q27` VARCHAR(255),
    `Q28` VARCHAR(255),
    `Q29` VARCHAR(255),
    `Q30` VARCHAR(255),
    `Q31` VARCHAR(255),
    `Q32` VARCHAR(255),
    `Q33` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `fkkpatientidd_idx` (`patient_id`),
    CONSTRAINT `fk_User`
        FOREIGN KEY (`patient_id`)
        REFERENCES `NewUser` (`id`)
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
