<?php

/**
 * Created by PhpStorm.
 * User: rlews
 * Date: 2/2/16
 * Time: 7:57 PM
 */

namespace Utils;

use Respect\Validation\Validator as v;
// setup the autoloading


class Utils{
    const USER_TYPE = "USER_TYPE";
    const USER_ROLE_OBJECT = "USER_ROLE_OBJECT";
    const USER_TYPE_ADMIN = "USER_TYPE_ADMIN";
    const USER_TYPE_NURSE = "USER_TYPE_NURSE";
    const USER_TYPE_DOCTOR = "USER_TYPE_DOCTOR";
    const USER_TYPE_USER = "USER_TYPE_NORMAL";
    const USER_OBJECT = "USER_OBJECT";
    const USER_TEST = "USER_OBJECT1";

    public static function getErrorString($code)
    {
        switch ($code)
        {
            case "SQLSTATE[23000]":
                return "Action not completed, An account with this email address already exist!";
            default:
                return"Action not completed, Something went wrong: " . $code;
        }
    }

    public static function sendToSlack($message){
        $logger = new \Monolog\Logger('general');
        $slackHandler = new \Monolog\Handler\SlackHandler('xoxp-72967266627-73007810915-75862585249-9fe4a6e53b', '#smslog', 'SMSBot');
        $slackHandler->setLevel(\Monolog\Logger::INFO);
        $logger->pushHandler($slackHandler);
        $logger->info($message);
    }

    public static function isAuthenticatedAs($as){
        Utils::safeSessionStart();
        if(isset($_SESSION[Utils::USER_OBJECT])
          //  && isset($_SESSION[Utils::USER_ROLE_OBJECT])
            && isset($_SESSION[Utils::USER_TYPE])
            && $_SESSION[Utils::USER_TYPE] == $as){
            return true;
        }
        return false;
    }

    public static function isAuthenticated(){
        Utils::safeSessionStart();
        if(isset($_SESSION[Utils::USER_OBJECT])
            && isset($_SESSION[Utils::USER_TYPE])
            //&& isset($_SESSION[Utils::USER_ROLE_OBJECT])
            ){
            return true;
        }
        return false;
    }

    public static function authenticateAs($user, $role){
        Utils::safeSessionStart();
        $_SESSION[Utils::USER_OBJECT]= $user;
        $_SESSION[Utils::USER_TYPE] = $role;
       // $_SESSION[Utils::USER_ROLE_OBJECT] = $roleObj;
    }

    public static function logout(){
        Utils::safeSessionStart();
        unset($_SESSION[Utils::USER_OBJECT]);
        unset($_SESSION[Utils::USER_TYPE]);
    }



    public static function getPsqlConnection($local) {
        if($local == 1){
            return pg_connect("port=5432 dbname=arbo user=arbo");
        } else{
            return $conn = pg_connect("dbname=arbo");
        }
    }

    public static function return_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $val;
    }


    public static function max_file_upload_in_bytes() {
        //select maximum upload size
        $max_upload = Utils::return_bytes(ini_get('upload_max_filesize'));
        //select post limit
        $max_post = Utils::return_bytes(ini_get('post_max_size'));
        //select memory limit
        $memory_limit = Utils::return_bytes(ini_get('memory_limit'));
        // return the smallest of them, this defines the real limit
        return min($max_upload, $max_post, $memory_limit);
    }

    public static function getFileExtension($filename){
        $split = explode('.', $filename);
        if(count($split) > 0){
            return $split[count($split) - 1];
        }
        return '';
    }

    public static function getFilenameFromPath($path){
        $split = explode('/', $path);
        if(count($split) > 0){
            return $split[count($split) - 1];
        }
        return '';
    }


    public static function generateHash($password){
        // A higher "cost" is more secure but consumes more processing power
        $cost = 10;

        // Create a random salt
        //$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $istrue = TRUE;
        $bytes = openssl_random_pseudo_bytes(50, $istrue);
        $hex   = bin2hex($bytes);
        $salt = sha1($hex);

        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        //$salt = sprintf("$2a$%02d$", $cost) . $salt;
        $hash = crypt($password, $salt);
        return $hash;
    }

    public static function verifyPassword($password, $hash){
        return hash_equals($hash, crypt($password, $hash));
    }

    public static function cleanString($string){
        $string = str_replace(' ', '', $string);
        return preg_replace('/[^A-Za-z0-9\.]/', '', $string); // Removes special chars.
    }

    public static function checkPasswordIsInvalid($string){
        return preg_match('/[^A-Za-z0-9\.\!\@\#\$]/', $string);
    }

    public static function createUsername($fname, $lname){
        $fname = strtolower(Utils::cleanString($fname));
        $lname = strtolower(Utils::cleanString($lname));
        $fname = substr($fname, 0, 1);
        return $fname . "." . $lname;
    }

    public static function getRandomPassword(){
        $istrue = TRUE;
        $bytes = openssl_random_pseudo_bytes(10, $istrue);
        $hex   = bin2hex($bytes);
        return $hex;
    }



    public static function checkifZipcode($zip){
        if(!Utils::checkIfNotEmpty($zip)){
            return false;
        }
        $components = explode('-', $zip); //XXXX-XXXX
        foreach($components as $component){
            if(!v::intVal()->validate($component)){
                return false;
            }
        }
        return true;
    }


    public static function validateForSpecialChars($string) {
        if(empty($string)){
            return false;
        }

        if(preg_match('/[\'\/~`\!@#\$%\^&\*_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $string)){
            return false;
        }

        return true;
    }

    public static function checkAllFieldsAreNotEmpty($required){
        foreach($required as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                return false;
            }
        }
        return true;
    }

    //string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_type = STR_PAD_RIGHT ]] )

    public static function padWithZeros($original, $pad_length){
        return str_pad($original, $pad_length, "0", STR_PAD_LEFT);
    }

    public static function checkIfNotEmpty($required){
        return $required != NULL && $required != '' && trim($required) != '';
    }

    public static function checkIfNotEmptyIsNumber($required){
        return $required != NULL && $required != '' && trim($required) != '' && is_numeric($required);
    }

    public static function printOutColumnsAndMaxLength($conn, $table){
        $query = "select * from $table limit 1";
        $result = pg_query($conn, $query);
        $columns = pg_fetch_array($result, NULL, PGSQL_ASSOC);

        foreach($columns as $column=>$value){
            $query = "select ". $column . " ,char_length(" . $column . "||'') as cnt from $table where ". $column ." is not null order by cnt desc limit 1";
            $result_cnt = pg_query($conn, $query);
            $data = pg_fetch_object($result_cnt);
            echo $column . "\t" . $data->cnt . "\n";
            pg_free_result($result_cnt);
        }
        pg_free_result($result);
    }

    public static function safeSessionStart(){
        if (!isset($_SESSION)) { session_start(); }
    }

    public static function getworkingdir(){
        return getcwd();
    }

    public static function resolveDirectory(){
        $filesDirectory = getcwd() . '/../app/files';

        //Utils::sendToSlack($filesDirectory);

        if ( !file_exists($filesDirectory) ) {
            $oldmask = umask(0);  // helpful when used in linux server
            mkdir ($filesDirectory, 0744);
            //Utils::sendToSlack("Dir not found created");
        } else{
           //Utils::sendToSlack("Dir found ");
        }
    }

    public static function saveFile($file){
        //Utils::resolveDirectory();

        if(Utils::max_file_upload_in_bytes() < $file['size']){
            return ['status'=>'error', 'code'=>-1, 'message'=>'Unable to save file, max ' . ((Utils::max_file_upload_in_bytes()/1024)/1024) . ' MB'];
        }

        $filesDirectory = getcwd() . '/../app/files';
        $fileExtension = Utils::getFileExtension($file['name']);
        $originalTmpName = tempnam($filesDirectory, "s");

        //Utils::sendToSlack($originalTmpName);

        $fileNameOnly = Utils::getFilenameFromPath($originalTmpName);
        $tmpfullname = $originalTmpName . ( $fileExtension == '' ? '' : '.' . $fileExtension);

        if (move_uploaded_file($file['tmp_name'], $tmpfullname) === true) {
            unlink($originalTmpName);
            chmod($tmpfullname, 0777); //needed to allow the delete option
            return ["status"=>"ok","id"=>$fileNameOnly, "path"=>$tmpfullname, "type"=> $file['type'] ];
        }
        unlink($originalTmpName);
        return ["status"=>"error"];
    }

}

date_default_timezone_set('America/New_York');