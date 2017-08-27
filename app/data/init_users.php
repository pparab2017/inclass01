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