<?php
/**
 * Created by PhpStorm.
 * User: pushparajparab
 * Date: 11/13/17
 * Time: 6:06 PM
 */

// setup the autoloading
require_once '../../vendor/autoload.php';

// setup Propel
require_once '../generated-conf/config.php';
//$date = new DateTime();
//
$msg = new Messages();
$msg->setContent("test123");
$msg->setTime($date);
$msg->save();





//// API access key from Google API's Console
//define( 'API_ACCESS_KEY', 'AIzaSyDBrPwDcNTwIHgl0PFAKLHXMcnCj9_k-s8' );
//$registrationIds = array( 'ee3oY2eq-Jk:APA91bGgsdB4OplI8UZRUsgLHRMHWhb_P30LSgoVcqvon5jvPvE1deTE_0AzJGSqmomOQBQrc_Rb6U9QNcyhVYon2kJ8H3ktX96Sk9OvsHwje07z37zAzU2_bJuj5Kyo4RPWilfe_FTL' );
//// prep the bundle
//$msg = array
//(
//    'message' 	=> 'This is a new message',
//    'title'		=> 'Health App',
//    'subtitle'	=> 'This is a subtitle. subtitle',
//    'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
//    'vibrate'	=> 1,
//    'sound'		=> 1,
//    'largeIcon'	=> 'large_icon',
//    'smallIcon'	=> 'small_icon'
//);
//$fields = array
//(
//    'registration_ids' 	=> $registrationIds,
//    'data'			=> $msg,
//
//);
//
//$headers = array
//(
//    'Authorization: key=' . API_ACCESS_KEY,
//    'Content-Type: application/json'
//);
//
//$ch = curl_init();
//curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
//curl_setopt( $ch,CURLOPT_POST, true );
//curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
//curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
//curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
//curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
//$result = curl_exec($ch );
//curl_close( $ch );
//echo $result;
