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
use Propel\Runtime\Propel;
use Utils\Utils;
//$date = new DateTime();
//
//$msg = new Messages();
//$msg->setContent("test123");
//$msg->setTime($date);
//$msg->save();
//
$sql = "select 
q.id as questionId,
q.Text,
q.Choises,
q.Type,
q.Time,
q.User_id,
q.LastSent,
u.Subscribed,
d.token
 from Questions q JOIN
NewUser u on u.id = q.user_id 
join DeviceTokens d on u.id = d.user_id;";

//$sql = str_replace("{DOCTOR_ID}",$doctor->getId(),$sql);
$conn = Propel::getConnection();
$reader = $conn->prepare($sql);
$reader->execute();
$results = $reader->fetchAll(PDO::FETCH_ASSOC);

//print_r ($results);

for($i =0 ; $i < sizeof($results); $i++ ){
    //echo $results[$i]["Text"];
    $timeString = explode(",",  $results[$i]["Time"]);
    //print_r ($time);
    //echo "UTC:".time();
    echo date('H:i:s') .PHP_EOL ;
//    echo PHP_EOL ;
//    $string =  date('H:i:s') ;
//
//    echo $results[$i]["LastSent"] . PHP_EOL;
//
//    echo PHP_EOL ;
//    $time = explode(':', $timeString[1]);
//    echo ($time[0]*60) + ($time[1]) + ($time[2]/60) . PHP_EOL;
//
//
//    $date = new DateTime("2017-11-16 10:07:24");
//    echo $date->getTimestamp() . PHP_EOL;;
//
//    $dateNow = new DateTime("2017-11-16 10:25:24");
//    echo $dateNow->getTimestamp() . PHP_EOL;;
//
//    echo ($dateNow->getTimestamp() - $date->getTimestamp() )/3600 . PHP_EOL;


    //$time2 = explode(',', "00:07:24");

    //print_r ($time2);

    $lastSend = new DateTime("2017-11-17 10:25:24");
    $dateNow = new DateTime();
    //echo date($dateNow->format("Y-m-d")) < date($lastSend->format("Y-m-d"));

    if($results[$i]["Subscribed"] == "YES") {

        if ($results[$i]["Type"] == "H") {

            echo "sEnd Hourly" . PHP_EOL;
            echo $results[$i]["LastSent"] . PHP_EOL;
            if ($results[$i]["LastSent"] != null || $results[$i]["LastSent"] != "") {
                $lastSend = new DateTime($results[$i]["LastSent"]);
                $dateNow = new DateTime();

                $diff = ($dateNow->getTimestamp() - $lastSend->getTimestamp()) / 3600;
                echo $diff;
                if ($diff >= 1) {
                    // send a messages
                    //update last sent
                    sendMsg($results[$i]);
                    echo "sEnd Hourly";
                }
            } else {
                // send message
                sendMsg($results[$i]);
                echo "sEnd Hourly first";
            }
        } else if ($results[$i]["Type"] == "O") {
            if ($results[$i]["LastSent"] != null || $results[$i]["LastSent"] != "") {

                $lastSend = new DateTime($results[$i]["LastSent"]);
                $dateNow = new DateTime();

                if (date($lastSend->format("Y-m-d")) < date($dateNow->format("Y-m-d"))) {
                    $time_01 = explode(':', $timeString[0]);
                    $timeNow_01 = explode(':', date('H:i:s'));
                    $FirstTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                    $FirstTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                    echo $FirstTimeToCheck . "   -- " . $FirstTimeToSend;

                    if ($FirstTimeToCheck - $FirstTimeToSend >= 0) {
                        //send message
                        sendMsg($results[$i]);
                        echo "sEnd once day";
                    }

                }


            } else {
                $time_01 = explode(':', $timeString[0]);
                $timeNow_01 = explode(':', date('H:i:s'));
                $FirstTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                $FirstTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                echo $FirstTimeToCheck . "   -- " . $FirstTimeToSend;

                if ($FirstTimeToCheck - $FirstTimeToSend >= 0) {
                    //send message
                    sendMsg($results[$i]);
                    echo "sEnd once day first";
                }
            }
        } else {
            if ($results[$i]["LastSent"] != null || $results[$i]["LastSent"] != "") {
                $lastSend = new DateTime($results[$i]["LastSent"]);
                $dateNow = new DateTime();


                if (date($lastSend->format("Y-m-d")) < date($dateNow->format("Y-m-d"))) {
                    $time_01 = explode(':', $timeString[0]);
                    $timeNow_01 = explode(':', date('H:i:s'));
                    $FirstTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                    $FirstTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                    if ($FirstTimeToCheck - $FirstTimeToSend >= 0) {
                        //send message
                        sendMsg($results[$i]);
                        echo "sEnd 2wise day 1st";
                    }

                } else if (date($lastSend->format("Y-m-d")) == date($dateNow->format("Y-m-d"))) {
                    $time_02 = explode(':', $timeString[1]);
                    $timeNow_02 = explode(':', date('H:i:s'));
                    $SecondTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                    $SecondTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                    if ($SecondTimeToCheck - $SecondTimeToSend >= 0) {
                        //send message
                        sendMsg($results[$i]);
                        echo "sEnd 2wise day 2nd";
                    }
                }


            } else {
                $lastSend = new DateTime($results[$i]["LastSent"]);
                $dateNow = new DateTime();


                if (date($lastSend->format("Y-m-d")) < date($dateNow->format("Y-m-d"))) {
                    $time_01 = explode(':', $timeString[0]);
                    $timeNow_01 = explode(':', date('H:i:s'));
                    $FirstTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                    $FirstTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                    if ($FirstTimeToCheck - $FirstTimeToSend >= 0) {
                        //send message
                        echo "sEnd 2wise day 1st";
                        sendMsg($results[$i]);
                    }

                } else if (date($lastSend->format("Y-m-d")) == date($dateNow->format("Y-m-d"))) {
                    $time_02 = explode(':', $timeString[1]);
                    $timeNow_02 = explode(':', date('H:i:s'));
                    $SecondTimeToSend = ($time_01[0] * 60) + ($time_01[1]) + ($time_01[2] / 60);
                    $SecondTimeToCheck = ($timeNow_01[0] * 60) + ($timeNow_01[1]) + ($timeNow_01[2] / 60);
                    if ($SecondTimeToCheck - $SecondTimeToSend >= 0) {
                        //send message
                        sendMsg($results[$i]);
                        echo "sEnd 2wise day 2nd";
                    }
                }
            }
        }
    }

}

//
//
// API access key from Google API's Console
function sendMsg($arrObj)
{
    $con = Propel::getWriteConnection('default');// get the data base name connection
    try {
        $newMsg = new Studyresponse();
        $newMsg->setUserId($arrObj["User_id"]);
        $newMsg->setQuestionId($arrObj["questionId"]);
        $newMsg->setLastsenttime(New DateTime());

        $con->beginTransaction();
        $newMsg->save();

        $question = QuestionsQuery::create()
            ->findOneById($arrObj["questionId"]);
        $question->setLastsent(New DateTime());
        $question->save();
    }
    catch (Exception $e)
    {
        $con->rollBack();
    }
    finally {
        $con->commit();
        sendpush($arrObj["token"],$arrObj["Text"],"Cloud Messaging",$newMsg->getId(),
            $question->getId(),$question->getText(),$question->getChoises());
    }

}

function sendpush($token, $message, $title, $rID,$qID,$text,$ch)
{

    $registrationIds = array($token);
// prep the bundle
    $msg = array
    (
        'responseID' => $rID,
        'questionID' => $qID,
        'Text' => $text,
        'choises' => $ch,
        'message' => $message,
        'title' => $title,
        'subtitle' => 'Click to open in app!',
        'tickerText' => 'Ticker text',
        'vibrate' => 1,
        'sound' => 1,
        'largeIcon' => 'large_icon',
        'smallIcon' => 'small_icon'
    );
    $fields = array
    (
        'registration_ids' => $registrationIds,
        'data' => $msg,

    );

    $headers = array
    (
        'Authorization: key=' . 'AIzaSyCJZyKv7k9rzzmfQxz_N_6Xog822-fmIHA',
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
}