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


$user = new User();
$user->setEmail("u1@test.com");
$user->setHash(Utils::generateHash("test"));
$user->setFname("Bob");
$user->setLname("Smith");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();



$user = new User();
$user->setEmail("agibson");
$user->setHash(Utils::generateHash("test1"));
$user->setFname("Austin");
$user->setLname("Gibson");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();



$user = new User();
$user->setEmail("ssharp");
$user->setHash(Utils::generateHash("test2"));
$user->setFname("Sally");
$user->setLname("Sally");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();



$user = new User();
$user->setEmail("preese");
$user->setHash(Utils::generateHash("test3"));
$user->setFname("Phill");
$user->setLname("Reese");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();



$user = new User();
$user->setEmail("tclark");
$user->setHash(Utils::generateHash("test4"));
$user->setFname("Tracy");
$user->setLname("Clark");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();



$user = new User();
$user->setEmail("rinc");
$user->setHash(Utils::generateHash("test5"));
$user->setFname("Rebbeca");
$user->setLname("Ince");
$user->setGender("MALE");
$user->setWeight("160");
$user->setAge("23");
$user->setAddress("224 Barton creek dr, Charlotte, NC, 28262");
$user->save();


$msg = new Messages();
$msg->setFromid(1);
$msg->setToid(2);
$msg->setTime("2017-08-28 00:07:24");
$msg->setRegion("Woodward333F");
$msg->setContent("Hello This is the first msg");
$msg->save();

$msg = new Messages();
$msg->setFromid(2);
$msg->setToid(3);
$msg->setTime("2017-08-28 00:08:24");
$msg->setRegion("Woodward333F");
$msg->setContent("Hello This is the second msg");
$msg->save();

$msg = new Messages();
$msg->setFromid(3);
$msg->setToid(4);
$msg->setTime("2017-08-28 00:09:24");
$msg->setRegion("BooksStand");
$msg->setContent("Hello This is the third msg");
$msg->save();

$msg = new Messages();
$msg->setFromid(4);
$msg->setToid(5);
$msg->setTime("2017-08-28 00:10:24");
$msg->setRegion("Woodward332");
$msg->setContent("Hello This is the fourth msg");
$msg->save();

$msg = new Messages();
$msg->setFromid(5);
$msg->setToid(1);
$msg->setTime("2017-08-28 00:11:24");
$msg->setRegion("Woodward332");
$msg->setContent("Hello This is the fifth msg");
$msg->save();



$admin = new Admin();
$admin->setEmail("admin@test.com");
$admin->setHash(Utils::generateHash("test"));
$admin->setFname("Admin");
$admin->setLname("Smith");
$admin->save();
echo "" . date_default_timezone_get() . PHP_EOL;

/*
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->format('Y-m-d H:i:s') . PHP_EOL;
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getName() . PHP_EOL;

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getLocation());

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone());
*/

echo "\nDone Creating Adming and Test Users\n";