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
//$msg = new Messages();
//$msg->setContent("test123");
//$msg->setTime($date);
//$msg->save();





// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AIzaSyCJZyKv7k9rzzmfQxz_N_6Xog822-fmIHA' );
$registrationIds = array( 'caHVxSK5oUc:APA91bHlwRDvOYsZHIMR3QgTmi7Uv1Kcj3jvRjCevdsIfj3YK-9W8mDfZFztnk_X2UMSX3w9zbhjl0XxfirdnG0FphJNC26Z_GBQrQAox_BpSdxPikL2ImhFAkJVwBnTwLalMhNUFjBf' );
// prep the bundle
$msg = array
(
    'message' 	=> 'This is a new message',
    'title'		=> 'Health App',
    'subtitle'	=> 'This is a subtitle. subtitle',
    'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
    'vibrate'	=> 1,
    'sound'		=> 1,
    'largeIcon'	=> 'large_icon',
    'smallIcon'	=> 'small_icon'
);
$fields = array
(
    'registration_ids' 	=> $registrationIds,
    'data'			=> $msg,

);

$headers = array
(
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;
