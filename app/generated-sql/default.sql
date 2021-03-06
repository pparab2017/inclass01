
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
-- DeviceTokens
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `DeviceTokens`;

CREATE TABLE `DeviceTokens`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `token` VARCHAR(1000),
    PRIMARY KEY (`id`),
    INDEX `fk_token_user_idx` (`user_id`),
    CONSTRAINT `fk_token_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `NewUser` (`id`)
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
    `Subscribed` enum('YES','NO') DEFAULT 'YES',
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
-- Questions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Questions`;

CREATE TABLE `Questions`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `Text` VARCHAR(500),
    `Choises` VARCHAR(45),
    `Type` enum('H','O','T') DEFAULT 'H',
    `Time` VARCHAR(45),
    `Study_Id` INTEGER NOT NULL,
    `User_id` INTEGER,
    `LastSent` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `fk_userId_idx` (`User_id`),
    INDEX `fk_q_userId_idx` (`User_id`),
    INDEX `fk_q_studyId_idx` (`Study_Id`),
    CONSTRAINT `fk_q_studyId`
        FOREIGN KEY (`Study_Id`)
        REFERENCES `Study` (`id`),
    CONSTRAINT `fk_q_userId`
        FOREIGN KEY (`User_id`)
        REFERENCES `NewUser` (`id`)
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
-- Study
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Study`;

CREATE TABLE `Study`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(45),
    `Description` VARCHAR(200),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- StudyResponse
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `StudyResponse`;

CREATE TABLE `StudyResponse`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `User_id` INTEGER,
    `Question_id` INTEGER,
    `Response` VARCHAR(45),
    `LastSentTime` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fk_userId_idx` (`User_id`),
    INDEX `fk_questionId_idx` (`Question_id`),
    CONSTRAINT `fk_questionId`
        FOREIGN KEY (`Question_id`)
        REFERENCES `Questions` (`id`),
    CONSTRAINT `fk_userId`
        FOREIGN KEY (`User_id`)
        REFERENCES `NewUser` (`id`)
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

-- ---------------------------------------------------------------------
-- inclass
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inclass`;

CREATE TABLE `inclass`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `email` VARCHAR(100),
    `gender` VARCHAR(45),
    `ip_address` VARCHAR(100),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_device_token
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_device_token`;

CREATE TABLE `project_device_token`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER,
    `token` VARCHAR(1000),
    PRIMARY KEY (`id`),
    INDEX `fk_toekn_userId_idx` (`user_id`),
    CONSTRAINT `fk_toekn_userId`
        FOREIGN KEY (`user_id`)
        REFERENCES `project_user` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_messages`;

CREATE TABLE `project_messages`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `text` TEXT,
    `reminder_type` enum('H','O','T') DEFAULT 'H',
    `type` enum('SURVEY','QUESTION','MESSAGE') DEFAULT 'QUESTION',
    `Time` VARCHAR(45),
    `Study_Id` INTEGER NOT NULL,
    `LastSent` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `fk_study_messgaes_idx` (`Study_Id`),
    CONSTRAINT `fk_study_messgaes`
        FOREIGN KEY (`Study_Id`)
        REFERENCES `project_study` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_notification
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_notification`;

CREATE TABLE `project_notification`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `study_id` INTEGER,
    `response_text` TEXT,
    `time` DATETIME,
    `user_id` INTEGER,
    `message_id` INTEGER,
    `opened_at` DATETIME,
    `answred_at` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `fk_user_notification_id_idx` (`user_id`),
    INDEX `fk_study_notification_id_idx` (`study_id`),
    INDEX `fk_message_notification_id_idx` (`message_id`),
    CONSTRAINT `fk_message_notification_id`
        FOREIGN KEY (`message_id`)
        REFERENCES `project_messages` (`id`),
    CONSTRAINT `fk_study_notification_id`
        FOREIGN KEY (`study_id`)
        REFERENCES `project_study` (`id`),
    CONSTRAINT `fk_user_notification_id`
        FOREIGN KEY (`user_id`)
        REFERENCES `project_user` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_study
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_study`;

CREATE TABLE `project_study`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `study_name` VARCHAR(45),
    `study_description` VARCHAR(300),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- project_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project_user`;

CREATE TABLE `project_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `hash` VARCHAR(255) NOT NULL,
    `fname` VARCHAR(255),
    `lname` VARCHAR(255),
    `gender` enum('FEMALE','MALE'),
    `role` enum('COORDINATOR','STUDENT') DEFAULT 'STUDENT',
    `Subscribed` enum('YES','NO') DEFAULT 'YES',
    `study_id` INTEGER,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`),
    INDEX `fk_project_study_idx` (`study_id`),
    CONSTRAINT `fk_project_study`
        FOREIGN KEY (`study_id`)
        REFERENCES `project_study` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sms_messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sms_messages`;

CREATE TABLE `sms_messages`
(
    `user_number` VARCHAR(100),
    `question` VARCHAR(500),
    `choises` VARCHAR(45),
    `prev_question` VARCHAR(45),
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `topic_Selected` VARCHAR(45),
    `response` VARCHAR(45),
    PRIMARY KEY (`id`),
    INDEX `number_idx` (`user_number`),
    CONSTRAINT `number`
        FOREIGN KEY (`user_number`)
        REFERENCES `sms_user` (`number`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sms_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sms_user`;

CREATE TABLE `sms_user`
(
    `number` VARCHAR(100) NOT NULL,
    `count` VARCHAR(45) DEFAULT '0',
    PRIMARY KEY (`number`),
    UNIQUE INDEX `number_UNIQUE` (`number`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voting_option
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voting_option`;

CREATE TABLE `voting_option`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(45),
    `more` VARCHAR(500),
    `color` VARCHAR(45),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voting_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voting_user`;

CREATE TABLE `voting_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(45) NOT NULL,
    `fname` VARCHAR(45) NOT NULL,
    `lname` VARCHAR(45) NOT NULL,
    `gender` enum('MALE','FEMALE') NOT NULL,
    `hash` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- voting_user_option
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `voting_user_option`;

CREATE TABLE `voting_user_option`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `vote_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user_id_UNIQUE` (`user_id`),
    UNIQUE INDEX `id_UNIQUE` (`id`),
    INDEX `fkk_voting_option_id_idx` (`vote_id`),
    CONSTRAINT `fkk_voting_option_id`
        FOREIGN KEY (`vote_id`)
        REFERENCES `voting_option` (`id`),
    CONSTRAINT `fkk_voting_user_id`
        FOREIGN KEY (`user_id`)
        REFERENCES `voting_user` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
