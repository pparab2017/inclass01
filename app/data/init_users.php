<?php
/**
 * Created by PhpStorm.
 * User: rlews
 * Date: 3/17/16
 * Time: 7:09 PM
 */

// setup the autoloading
require_once '../../vendor/autoload.php';

// setup Propel
require_once '../generated-conf/config.php';

use Utils\Utils;

echo "\nCreating Admin and Test Users\n";




$admin = new Admin();
$admin->setEmail("admin@test.com");
$admin->setHash(Utils::generateHash("test"));
$admin->setFname("Admin");
$admin->setLname("Smith");
$admin->save();


$user = new Newuser();
$user->setFname("Bob");
$user->setLname("Vonderhied");
$user->setHash(Utils::generateHash("test"));
$user->setEmail("u1@test.com");
$user->setGender("MALE");
$user->setRole("PATIENT");
$user->save();


$user = new Newuser();
$user->setFname("Alice");
$user->setLname("Robert");
$user->setHash(Utils::generateHash("test"));
$user->setEmail("u2@test.com");
$user->setGender("FEMALE");
$user->setRole("PATIENT");
$user->save();

$study = new Study();
$study->setName("One");
$study->setDescription("Test only one type of study");
$study->save();


//project init();

//1) create study

$study01 = new ProjectStudy();
$study01->setStudyName("Math");
$study01->setStudyDescription("Simple Math for day today work.");
$study01->save();



$study02 = new ProjectStudy();
$study02->setStudyName("English");
$study02->setStudyDescription("Simple English for day today work.");
$study02->save();


$user = new ProjectUser();
$user->setFname("Bob");
$user->setLname("Vonderhied");
$user->setHash(Utils::generateHash("test"));
$user->setEmail("u1@test.com");
$user->setGender("MALE");
$user->setRole("STUDENT");
$user->setStudyId($study01->getId());
$user->save();


$user = new ProjectUser();
$user->setFname("ALice");
$user->setLname("Vonderhied");
$user->setHash(Utils::generateHash("test"));
$user->setEmail("u2@test.com");
$user->setGender("FEMALE");
$user->setRole("STUDENT");
$user->setStudyId($study02->getId());
$user->save();

$datetime = new DateTime();

$message = new ProjectMessages();
$message->setStudyId($study01->getId());
$message->setReminderType("H");
$message->setType("QUESTION");
$message->setText('{"message_type":"QUESTION","message":"How are you toady?","number_of_choices":4,"choices":"Vary Good|Good|Bad|Vary Bad","response":"","survey":""}
');
$message->setLastsent($datetime);
$message->save();


$message = new ProjectMessages();
$message->setStudyId($study01->getId());
$message->setReminderType("H");
$message->setType("MESSAGE");
$message->setText('{"message_type":"MESSAGE","message":"Please read about intro to math from the inclass01.","number_of_choices":0,"choices":"","response":"","survey":""}
');
$message->setLastsent($datetime);
$message->save();


$message = new ProjectMessages();
$message->setStudyId($study02->getId());
$message->setReminderType("H");
$message->setType("QUESTION");
$message->setText('{"message_type":"QUESTION","message":"How are you?","number_of_choices":4,"choices":"Vary Good|Good|Bad|Vary Bad","response":"","survey":""}
');
$message->setLastsent($datetime);
$message->save();


$message = new ProjectMessages();
$message->setStudyId($study01->getId());
$message->setReminderType("O");
$message->setType("SURVEY");
$message->setText('{"message_type":"SURVEY","message":"Starter survey","number_of_choices":0,"choices":"","response":"","survey":{"survey_title":"Starter survey","survey_desc":"This is a starter survey","survey_instruction":"This has only 4 questions.","number_of_questions":4,"questions":[{"question_type":"TEXT","question_text":"Write your name below.","number_of_choices":0,"question_choices":"","response":""},{"question_type":"TEXT","question_text":"How good are you in Math?","number_of_choices":0,"question_choices":"","response":""},{"question_type":"MCQ","question_text":"How will you rate your self from in math?","number_of_choices":5,"question_choices":"1|2|3|4|5","response":""},{"question_type":"MCQ","question_text":"How will you rate your self from in logic?","number_of_choices":4,"question_choices":"Vary good|Good|Bad|Vary Bad","response":""}]}}');
$message->setLastsent($datetime);
$message->save();


$message = new ProjectMessages();
$message->setStudyId($study02->getId());
$message->setReminderType("O");
$message->setType("SURVEY");
$message->setText('{"message_type":"SURVEY","message":"Starter survey","number_of_choices":0,"choices":"","response":"","survey":{"survey_title":"Starter survey","survey_desc":"This is a starter survey","survey_instruction":"This has only 4 questions.","number_of_questions":4,"questions":[{"question_type":"TEXT","question_text":"Write your name below.","number_of_choices":0,"question_choices":"","response":""},{"question_type":"TEXT","question_text":"How good are you in Math?","number_of_choices":0,"question_choices":"","response":""},{"question_type":"MCQ","question_text":"How will you rate your self from in math?","number_of_choices":5,"question_choices":"1|2|3|4|5","response":""},{"question_type":"MCQ","question_text":"How will you rate your self from in logic?","number_of_choices":4,"question_choices":"Vary good|Good|Bad|Vary Bad","response":""}]}}');
$message->setLastsent($datetime);
$message->save();

//$text = $message->getText();
//
//$obj = (json_decode($text,true));
//var_dump($obj["survey_title"]);

//{"question_text":"How are you toady?","choises":"Vary Good,Good,Bad,Vary Bad","response":""}


$notification = new ProjectNotification();
$notification->setUserId(1);
$notification->setStudyId(1);
$notification->setTime("2017-12-02 16:32:22");
$notification->setMessageId(1);
$notification->save();


$notification = new ProjectNotification();
$notification->setUserId(1);
$notification->setStudyId(1);
$notification->setTime("2017-12-02 16:32:22");
$notification->setMessageId(2);
$notification->save();

$notification = new ProjectNotification();
$notification->setUserId(1);
$notification->setStudyId(1);
$notification->setTime("2017-12-02 16:32:22");
$notification->setMessageId(4);
$notification->save();

echo "" . date_default_timezone_get() .  date('Y-m-d H:i:s') .  PHP_EOL;

/*
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->format('Y-m-d H:i:s') . PHP_EOL;
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getName() . PHP_EOL;

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getLocation());

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone());
*/

echo "\nDone Creating Adming and Test Users\n";