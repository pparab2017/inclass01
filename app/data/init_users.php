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
$user->setGender("PATIENT");
$user->save();


$user = new Newuser();
$user->setFname("Alice");
$user->setLname("Robert");
$user->setHash(Utils::generateHash("test"));
$user->setEmail("u2@test.com");
$user->setGender("FEMALE");
$user->setGender("PATIENT");
$user->save();

echo "" . date_default_timezone_get() . PHP_EOL;

/*
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->format('Y-m-d H:i:s') . PHP_EOL;
echo \Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getName() . PHP_EOL;

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone()->getLocation());

var_dump(\Propel\Runtime\Util\PropelDateTime::createHighPrecision()->getTimezone());
*/

echo "\nDone Creating Adming and Test Users\n";