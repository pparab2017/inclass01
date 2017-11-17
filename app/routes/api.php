<?php
/**
 * Created by PhpStorm.
 * User: rlews
 * Date: 3/6/16
 * Time: 12:38 AM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Utils\Utils;
use Respect\Validation\Validator as v;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use Propel\Runtime\Propel;




//Authentication "/api/signup", "/api/login", "/api/forgotPassword" exempted from token requirements
$app->post('/api/signup', function ($request, $response, $args) {
    //email – email ID of the user
    //password – password for the account
    //fname – Name of the user account.
    //lname

    $params = $request->getParsedBody();
    $error = '';

    if(!v::key('email')->validate($params) || !v::email()->validate($params['email'])){
        $error = 'Invalid Email';
    } else if(!v::key('fname')->validate($params) || !v::stringType()->length(1, null)->validate($params['fname'])){
        $error = 'First name is empty';
    } else if(!v::key('lname')->validate($params) || !v::stringType()->length(1, null)->validate($params['lname'])){
        $error = 'Last name is empty';
    } else if(!v::key('password')->validate($params) || !v::stringType()->length(6, null)->validate($params['password'])){
        $error = 'Password has to be 6 characters or more';
    }
    else if(!v::key('gender')->validate($params) || !v::stringType()->length(1, null)->validate($params['gender'])){
        $error = 'gender is empty';
    }
    else if(!v::key('age')->validate($params) || !v::stringType()->length(1, null)->validate($params['age'])){
        $error = 'age is empty';
    }
    else if(!v::key('weight')->validate($params) || !v::stringType()->length(1, null)->validate($params['weight'])){
        $error = 'weight is empty';
    }
    else if(!v::key('address')->validate($params) || !v::stringType()->length(1, null)->validate($params['address'])){
        $error = 'address is empty';
    }


    if($error == '' && UserQuery::create()->filterByEmail($params['email'])->findOne() != NULL){
        $error = $params['email'] . ' email is not available, choose another email.';
    } else if($error == ''){
        $user = new User();
        $user->setFname($params['fname']);
        $user->setLname($params['lname']);
        $user->setEmail($params['email']);
        $user->setHash(Utils::generateHash($params['password']));
        $user->setGender($params['gender']);
        $user->setWeight($params['weight']);
        $user->setAge($params['age']);
        $user->setAddress($params['address']);

        try{
            $user->save();
            $now = new DateTime();
            $future = new DateTime("now +1 years");

            $jti = Base62::encode(random_bytes(16));
            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "jti" => $jti,
                "user" => $user->getId()
            ];
            $secret = getenv("JWT_SECRET");
            $token = JWT::encode($payload, $secret, "HS256");
            $data["status"] = "ok";
            $data["token"] = $token;
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            $data["age"] = $user->getAge();
            $data["weight"] = $user->getWeight();
            $data["gender"] = $user->getGender();
            $data["address"] = $user->getAddress();
            return $response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        } catch (PDOException $pe) {
            $error = 'Error creating user';
        } catch (Exception $pe) {
            $error = 'Error creating user';
        }
    }

    $data["status"] = "error";
    $data["message"] = $error;
    return $response->withStatus(400)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
})->setName('api.signup');

$app->post('/api/login', function ($request, $response, $args) {
    //email – email ID of the user
    //password – password for the account

    $params = $request->getParsedBody();
    if(Utils::checkIfNotEmpty($params['email']) && Utils::checkIfNotEmpty($params['password'])){
        $user = UserQuery::create()
            ->filterByEmail($params['email'],UserQuery::EQUAL)
            ->findOne();

        if($user == NULL || !Utils::verifyPassword($params['password'], $user->getHash()) ){
            //error
        } else{
            $now = new DateTime();
            $future = new DateTime("now +1 years");
            $jti = Base62::encode(random_bytes(16));
            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "jti" => $jti,
                "user" => $user->getId()
            ];
            $secret = getenv("JWT_SECRET");
            $token = JWT::encode($payload, $secret, "HS256");
            $data["status"] = "ok";
            $data["token"] = $token;
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            $data["age"] = $user->getAge();
            $data["weight"] = $user->getWeight();
            $data["gender"] = $user->getGender();
            $data["address"] = $user->getAddress();
            return $response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
    }

    $data["status"] = "error";
    $data["message"] = "Incorrect email and/or password";
    return $response->withStatus(401)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
})->setName('api.login');

$app->post('/api/update/myInfo', function ($request, $response, $args){

    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(!v::key('fname')->validate($params) || !v::stringType()->length(1, null)->validate($params['fname'])){
        $error = 'First name is empty';
    } else if(!v::key('lname')->validate($params) || !v::stringType()->length(1, null)->validate($params['lname'])){
        $error = 'Last name is empty';
    } else if(!v::key('gender')->validate($params) || !v::stringType()->length(1, null)->validate($params['gender'])){
        $error = 'Gender is empty';
    } else if(!v::key('age')->validate($params) || !v::stringType()->length(1, null)->validate($params['age'])){
        $error = 'Age is empty';
    } else if(!v::key('weight')->validate($params) || !v::stringType()->length(1, null)->validate($params['weight'])){
        $error = 'Weight is empty';
    } else if(!v::key('address')->validate($params) || !v::stringType()->length(1, null)->validate($params['address'])){
        $error = 'Address is empty';
    }

    if(Utils::checkIfNotEmpty($userId))
    {
        $user =  UserQuery::create()->filterById($userId,UserQuery::EQUAL)->findOne();
        if($user != null)
        {
            $user->setFname($params['fname']);
            $user->setLname($params['lname']);
            $user->setGender($params['gender']);
            $user->setWeight($params['weight']);
            $user->setAge($params['age']);
            $user->setAddress($params['address']);
            $user->save();

            $data["status"] = "ok";
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            $data["age"] = $user->getAge();
            $data["weight"] = $user->getWeight();
            $data["gender"] = $user->getGender();
            $data["address"] = $user->getAddress();

            return $response->withJson($data);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('api.update.myInfo');

$app->post('/api/myInfo', function ($request, $response, $args){

    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {
        $user =  UserQuery::create()->filterById($userId,UserQuery::EQUAL)->findOne();
        if($user != null)
        {
            $data["status"] = "ok";
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            $data["age"] = $user->getAge();
            $data["weight"] = $user->getWeight();
            $data["gender"] = $user->getGender();
            $data["address"] = $user->getAddress();

            //$data = array("user"=>$user->toArray(), "status"=>"ok");
            return $response->withJson($data);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('api.update.myInfo');



$app->get('/api/getProductsByType/{type}', function ($request, $response, $args) {
// No token required ..
    if(isset($args['type']) && Utils::checkIfNotEmpty($args['type'])) {




        $results = ResultsQuery::create()
            ->filterByRegion($args['type'], ResultsQuery::EQUAL)
            ->find();

        for ($i = 0; $i < $results->count(); $i++) {
            if (Utils::checkIfNotEmpty($results[$i]->getPhoto()))
                $results[$i]->setPhoto("/imgs/products/" . $results[$i]->getPhoto());
        }

        if($results != NULL){
            $data = array("results"=>$results->toArray(), "status"=>"ok");
            return $response->withJson($data);
        }
    }


    $data = array("status"=>"error", "message" =>"Unable to retrieve participant information.");
    return $response->withJson($data);
})->setName('api.getProductsByType');







$app->get('/api/getMessagesByRegion/{region}', function ($request, $response, $args) {
    if(isset($args['region']) && Utils::checkIfNotEmpty($args['region'])) {


        $params = $request->getParsedBody();
        $userId = $this->jwt->user;


        if (Utils::checkIfNotEmpty($userId)) {
            //$user =  UserQuery::create()->filterById($userId,UserQuery::EQUAL)->findOne();
//            $Msgs = MessagesQuery::create()
//                ->filterByToid($userId, MessagesQuery::EQUAL)
//                ->filterByRegion( $args['region'], MessagesQuery::EQUAL)
//                ->find();


            $sql = "SELECT 
                M.Id, M.Time, M.Region, M.Content, M.MsgLock, M.MsgRead,
                M.fromID, M.toID,
                CONCAT(F.fname,' ',F.lname) AS FromName,
                CONCAT(T.fname,' ',T.lname) AS ToName
                 FROM Messages M
                JOIN User F on M.fromID = F.id
                JOIN User T on M.toID = T.id
                WHERE M.toID = {_ID} AND  M.region = '{_REGION}'
                 ORDER BY  M.MsgRead DESC, M.Time DESC";

            $sql = str_replace("{_ID}",$userId,$sql);
            $sql = str_replace("{_REGION}",$args['region'],$sql);
            $conn = Propel::getConnection();
            $reader = $conn->prepare($sql);
            $reader->execute();
            $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

            if ($Msgs != null) {
                return $response->withJson(['status' => 'ok', 'Messages' => $Msgs]);
            }
            return $response
                ->withStatus(400)
                ->withJson(['status' => 'error', "message" => "Invalid user ID"]);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status' => 'error', "message" => "Invalid user ID"]);
    }

    $data = array("status"=>"error", "message" =>"Unable to retrieve participant information.");
    return $response->withJson($data);


})->setName('api.getMessagesByRegion');


$app->get('/api/getAllUsers', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;

    if(Utils::checkIfNotEmpty($userId)) {

            $users = UserQuery::create()
                ->filterById($userId, UserQuery::NOT_EQUAL)
                ->find();


        if($users != null)
        {
            return $response->withJson(['status'=>'ok', 'Users'=>$users->toArray()]);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('api.getAllUsers');


$app->post('/api/submitResponse', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $userId = $this->jwt->user;
    if(Utils::checkIfNotEmpty($userId)) {
        $p = NewuserQuery::create()->filterById($userId,NewuserQuery::EQUAL)->findOne();
        if($p != NULL) {

            $res = StudyresponseQuery::create()
                ->findOneById($params["ResponseID"]);

            if($res != null){
                $res->setResponse($params["Response"]);
                $res->save();
                return $response->withJson(['status'=>'ok']);
            }
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName("submitResponse");


$app->get('/api/logout', function ($request, $response, $args){
    $userId = $this->jwt->user;
    $device = DevicetokensQuery::create()
        ->findOneByUserId($userId);
    $device->delete();
    return json_encode("okay");
})->setName("api.logout");


$app->post('/api/subscribe', function ($request, $response, $args){
    $userId = $this->jwt->user;
    $params = $request->getParsedBody();
    $user = NewuserQuery::create()
        ->findOneById($userId);

    $user->setSubscribed($params["val"]);
    $user->save();

    return json_encode($user->getSubscribed());
})->setName("api.subscribe");



$app->get('/api/getSubscrition', function ($request, $response, $args){


    $userId = $this->jwt->user;

    $user = NewuserQuery::create()
        ->findOneById($userId);

    return json_encode($user->getSubscribed());
})->setName("api.getSubscrition");


$app->get('/api/getAllMessages', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {

//        $Msgs = MessagesQuery::create()
//
//            ->joinWithUserRelatedByFromid()
//            ->select(array('Id','Content','Fromid','Toid','Region','Content','Msgread','Msglock','User.Fname','User.Lname'))
//            ->filterByToid($userId, MessagesQuery::EQUAL)
//            ->find();
        $sql = "SELECT 
                M.Id, M.Time, M.Region, M.Content, M.MsgLock, M.MsgRead,
                M.fromID, M.toID,
                CONCAT(F.fname,' ',F.lname) AS FromName,
                CONCAT(T.fname,' ',T.lname) AS ToName
                 FROM Messages M
                JOIN User F on M.fromID = F.id
                JOIN User T on M.toID = T.id
                WHERE M.toID = {_ID} ORDER BY  M.MsgRead DESC, M.Time DESC";

        $sql = str_replace("{_ID}",$userId,$sql);
        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);


        if($Msgs != null)
        {
            return $response->withJson(['status'=>'ok', 'Messages'=>$Msgs]);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('api.getAllMessages');





$app->post('/api/createNewMessage', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(!v::key('from')->validate($params) || !v::stringType()->length(1, null)->validate($params['from'])){
        $error = 'From is Empty';
    } else if(!v::key('to')->validate($params) || !v::stringType()->length(1, null)->validate($params['to'])){
        $error = 'To is empty';
    } else if(!v::key('region')->validate($params) || !v::stringType()->length(1, null)->validate($params['region'])){
        $error = 'Region is empty';
    } else if(!v::key('content')->validate($params) || !v::stringType()->length(1, null)->validate($params['content'])){
        $error = 'Message content is empty';
    }

    if(Utils::checkIfNotEmpty($userId))
    {

        $date = new DateTime("now");
        $msg = new Messages();
        $msg->setToid(intval($params['to']));
        $msg->setFromid(intval($params['from']));
        $msg->setRegion(($params['region']));
        $msg->setContent(($params['content']));
        $msg->setTime($date);
        $msg->save();

        //$user =  UserQuery::create()->filterById($userId,UserQuery::EQUAL)->findOne();
        $Msgs = MessagesQuery::create()
            ->filterByToid($userId, MessagesQuery::EQUAL)
            ->find();

        if($Msgs != null)
        {
            return $response->withJson(['status'=>'ok', 'Messages'=>$Msgs->toArray()]);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('api.getAllMessages');




$app->get('/api/deleteMessage/{id}', function ($request, $response, $args) {
// No token required ..
    if(isset($args['id']) && Utils::checkIfNotEmpty($args['id'])) {


        $msg = MessagesQuery::create()
            ->filterById($args['id'], ResultsQuery::EQUAL)
            ->findOne();


        if($msg!= null)
        {
            $msg->delete();
            return $response->withJson(['status'=>'ok']);
        }

    }


    $data = array("status"=>"error", "message" =>"Unable to delete message.");
    return $response->withJson($data);
})->setName('api.deleteMessage');




$app->get('/api/setMessageAsUnlock/{id}', function ($request, $response, $args) {
// No token required ..
    if(isset($args['id']) && Utils::checkIfNotEmpty($args['id'])) {


        $msg = MessagesQuery::create()
            ->filterById($args['id'], ResultsQuery::EQUAL)
            ->findOne();


        if($msg!= null)
        {
            $msg->setMsglock("UNLOCK");
            $msg->save();
            return $response->withJson(['status'=>'ok']);
        }

    }


    $data = array("status"=>"error", "message" =>"Unable to Change Status.");
    return $response->withJson($data);
})->setName('api.setMessageAsUnlock');




$app->get('/api/setMessageAsRead/{id}', function ($request, $response, $args) {
// No token required ..
    if(isset($args['id']) && Utils::checkIfNotEmpty($args['id'])) {


        $msg = MessagesQuery::create()
            ->filterById($args['id'], ResultsQuery::EQUAL)
            ->findOne();


        if($msg!= null)
        {
            $msg->setMsgread("READ");
            $msg->save();
            return $response->withJson(['status'=>'ok']);
        }

    }


    $data = array("status"=>"error", "message" =>"Unable to Change Status.");
    return $response->withJson($data);
})->setName('api.setMessageAsRead');





$app->get ('/api/getUserInfo', function ($request, $response, $args) {

    // wirte this api to display the user info on the main page

})->setName('api.getUserInfo');






$app->get('/api/getAllProducts', function ($request, $response, $args) {
// No token required ..
       $results = ResultsQuery::create()
           ->find();

       for($i =0;$i<$results->count();$i++)
       {
           if(Utils::checkIfNotEmpty ($results[$i]->getPhoto()))
           $results[$i]->setPhoto("/imgs/products/" . $results[$i]->getPhoto());
       }

        if($results != NULL){
            $data = array("results"=>$results->toArray(), "status"=>"ok");
            return $response->withJson($data);
        }

    $data = array("status"=>"error", "message" =>"Unable to retrieve participant information.");
    return $response->withJson($data);
})->setName('api.getAllProducts');


$app->get ('/api/getMyMessages', function ($request, $response, $args) {

    $patient_id = $this->jwt->user;
    if(Utils::checkIfNotEmpty($patient_id)) {

        $p = NewuserQuery::create()->filterById($patient_id,NewuserQuery::EQUAL)->findOne();
        if($p != NULL) {
            $sql = "select R.id As ResponseId, R.Response,
Q.id As questionID, Text, choises, type, time, Q.user_id 
from StudyResponse R join Questions Q
on R.Question_id = Q.id
WHERE Q.User_id = {USER_ID}
ORDER BY R.id DESC";

            $sql = str_replace("{USER_ID}", $patient_id, $sql);
            $conn = Propel::getConnection();
            $reader = $conn->prepare($sql);
            $reader->execute();
            $results = $reader->fetchAll(PDO::FETCH_ASSOC);



            if($results != NULL){
                $data = array("results"=>$results, "status"=>"ok");
                return $response->withJson($data);
            }
            //json_encode($_GET['recordsTotal']); this is how we access the server side params, if in case
            //return json_encode($results);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);

})->setName('api.getMyMessages');


// New App API  --- >  SurveyAPP APIS

$app->post ('/api/deviceRegister', function ($request, $response, $args){

    $params = $request->getParsedBody();
    $patient_id = $this->jwt->user;
    if(Utils::checkIfNotEmpty($patient_id)) {
        $p = NewuserQuery::create()->filterById($patient_id,NewuserQuery::EQUAL)->findOne();
        if($p != NULL) {

            $reg = new Devicetokens();
                $reg->setUserId($patient_id);
                $reg->setToken($params["token"]);
                $reg->save();
            return $response->withJson(['status'=>'ok']);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);

})->setName('api.deviceRegister');


$app->post('/api/SurveyAppLogin', function ($request, $response, $args) {
    //email – email ID of the user
    //password – password for the account

    $params = $request->getParsedBody();
    if(Utils::checkIfNotEmpty($params['email']) && Utils::checkIfNotEmpty($params['password'])){
        $user = NewuserQuery::create()
            ->filterByEmail($params['email'],NewuserQuery::EQUAL)
            ->findOne();

        if($user == NULL || !Utils::verifyPassword($params['password'], $user->getHash()) ){
            //error
        } else{
            $now = new DateTime();
            $future = new DateTime("now +1 years");
            $jti = Base62::encode(random_bytes(16));
            $payload = [
                "iat" => $now->getTimeStamp(),
                "exp" => $future->getTimeStamp(),
                "jti" => $jti,
                "user" => $user->getId()
            ];
            $secret = getenv("JWT_SECRET");
            $token = JWT::encode($payload, $secret, "HS256");
            $data["status"] = "ok";
            $data["token"] = $token;
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            return $response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
    }

    $data["status"] = "error";
    $data["message"] = "Incorrect email and/or password";
    return $response->withStatus(401)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
})->setName('api.SurveyApp.login');





//activity logs
$app->post('/api/survey/submit', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $patient_id = $this->jwt->user;

    if(Utils::checkIfNotEmpty($patient_id)){
        $p = NewuserQuery::create()->filterById($patient_id,NewuserQuery::EQUAL)->findOne();
        if($p != NULL) {
            $survey = new Surveylog();
            $survey->setPatientId($patient_id);
            $datetime = new DateTime();
            $result = $datetime->format('Y-m-d H:i:s');
            $survey->setQ1($result);
            for($i=2; $i<=33; $i++){
                $qid = "Q".$i;
                $foo = "set".$qid;
                if(isset($params[$qid]) && Utils::checkIfNotEmpty($params[$qid])){
                    $survey->$foo(trim($params[$qid]));
                }
            }


            $survey->save();

            return $response->withJson(['status'=>'ok']);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);
    }

    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid Patient ID"]);
})->setName('api.survey.submit');




/// creating a message
///
///
//require _DIR_ . '/twilio-php-master/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;
use Twilio\Twiml;

$app->post('/api/respondSMS', function ($request, $response, $args) {
    $params = $request->getParsedBody();

    $response = new Twiml();
    $last = SmsMessagesQuery::create()
        ->joinSmsUser()
        ->orderById("DESC")
        ->filterByUserNumber($params["From"])
        ->findOne();

    $sms_user = new SmsUser();
    if( trim(strtoupper($params["Body"])) != 'START'){
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);
        if($sms_user == null){
            $message = $response->message();
            $message->body('You have not registered yet, please message START to register!');
            echo $response;
            return 0;
        }


    }


    if( trim(strtoupper($params["Body"])) == 'START'){

        try {

            $sms_user->setNumber($params["From"]);
            $sms_user->save();


            $message = $response->message();
            $message->body('Welcome to the Study!');
            $question = "Please indicate your symptom (1)Headache, (2)Dizziness, (3)Nausea, (4)Fatigue, (5)Sadness, (0)None";
            $choices = "1,2,3,4,5,0";
            startSurveyFirst($sms_user->getNumber(), "Q1", $question, $choices,"","",false);

        }catch (exception $e){

            $message = $response->message();
            $message->body('You have already registered!');
        }

    }else if( $last->getPrevQuestion() == "Q1"){

        $default = false;
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);

           $message = $response->message();

           $question = "";
           $choices = "0,1,2,3,4";
           $topic ="";
           $responseAns="";

        switch (trim(strtoupper($params["Body"]))) {
            case "0":
                $question = "Thank you and see you soon";
                $choices = "0";
                $message->body($question);
                $topic ="None";
                $responseAns = "0";


                startSurveyFirst($sms_user->getNumber(), "", $question, $choices,"","",false);
                return 0;


                break;
            case "1":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Headache in the last 24 hours?";
                $message->body($question);
                $topic ="Headache";
                $responseAns = "1";
                break;
            case "2":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Dizziness in the last 24 hours?";
                $message->body($question);
                $topic ="Dizziness";
                $responseAns = "2";

                break;
            case "3":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Nausea in the last 24 hours?";
                $message->body($question);
                $topic ="Nausea";
                $responseAns = "3";

                break;
            case "4":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Fatigue in the last 24 hours?";
                $message->body($question);
                $topic ="Fatigue";
                $responseAns = "4";

                break;
            case "5":
                $question = 'On a scale from 0 (none) to 4 (severe), how would you rate your Sadness in the last 24 hours?';
                $message->body($question);
                $topic ="Sadness";
                $responseAns = "5";

                break;
            default:
                $default = true;
                $question = 'Please enter a number from 0 to 5';
                $message->body($question);

                break;
        }
        $last->setTopicSelected($topic);
        $last->setResponse($responseAns);
        $last->save();

        startSurveyFirst($sms_user->getNumber(), "Q2", $question, $choices,$topic,"",$default);
        }
    else if($last->getPrevQuestion() == "Q2"){
        $default = false;
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);
        $message = $response->message();

        $question = "";
        $choices = "0,1,2,3,4";
        $responseAns = "";

        switch (trim(strtoupper($params["Body"]))) {
            case "0":
                $question = "You do not have a " .$last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "0";

                break;
            case "1":
                $question = "You have a mild ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "1";

                break;
            case "2":
                $question = "You have a mild " . $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "2";

                break;
            case "3":
                $question = "You have a moderate ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "3";
                break;
            case "4":
                $question = "You have a severe ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "4";
                break;
            default:
                $question = 'Please enter a number from 0 to 4';
                $message->body($question);
                $default = true;
                break;
        }

        $last->setTopicSelected($last->getTopicSelected());
        $last->setResponse($responseAns);
        $last->save();
        startSurveyFirst($sms_user->getNumber(), "Q3", $question, $choices,$last->getTopicSelected(), "",$default);


        if(!$default){
        $count = intval($sms_user->getCount());
        $sms_user->setCount($count + 1);
        $sms_user->save();

        if(intval($count + 1) == 3){
            $question = "Thank you and see you soon";
            $choices = "0";
            startSurveyFirst($sms_user->getNumber(), "", $question, $choices,"","",false);

        }else{
            $question = "Please indicate your symptom (1)Headache, (2)Dizziness, (3)Nausea, (4)Fatigue, (5)Sadness, (0)None";
            $choices = "1,2,3,4,5,0";
            startSurveyFirst($sms_user->getNumber(), "Q1", $question, $choices,"","",false);

        }
        }


    }


    echo $response;


})->setName('api.respondSMS');

$app->post('/api/MyrespondSMS', function ($request, $response, $args) {
    $params = $request->getParsedBody();

    $response = new Twiml();
    $last = SmsMessagesQuery::create()
        ->joinSmsUser()
        ->orderById("DESC")
        ->filterByUserNumber($params["From"])
        ->findOne();

    $sms_user = new SmsUser();
    if( trim(strtoupper($params["Body"])) != 'START'){
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);
        if($sms_user == null){
            $message = $response->message();
            $message->body('You have not registered yet, please message START to register!');
            echo $response;
            return 0;
        }


    }


    if( trim(strtoupper($params["Body"])) == 'START'){

        try {

            $sms_user->setNumber($params["From"]);
            $sms_user->save();


            $message = $response->message();
            $message->body('Welcome to the Study!');
            echo $response;

            $question = "Please indicate your symptom (1)Headache, (2)Dizziness, (3)Nausea, (4)Fatigue, (5)Sadness, (0)None";
            $choices = "1,2,3,4,5,0";
            startSurveyFirstMY($sms_user->getNumber(), "Q1", $question, $choices,"","",false);

        }catch (exception $e){

            $message = $response->message();
            $message->body('You have already registered!');
            echo $response;
        }

    }else if( $last->getPrevQuestion() == "Q1"){

        $default = false;
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);

        $message = $response->message();

        $question = "";
        $choices = "0,1,2,3,4";
        $topic ="";
        $responseAns="";

        switch (trim(strtoupper($params["Body"]))) {
            case "0":
                $question = "Thank you and see you soon";
                $choices = "0";
                $message->body($question);
                $topic ="None";
                $responseAns = "0";


                startSurveyFirstMY($sms_user->getNumber(), "", $question, $choices,"","",false);
                return 0;


                break;
            case "1":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Headache in the last 24 hours?";
                $message->body($question);
                $topic ="Headache";
                $responseAns = "1";
                break;
            case "2":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Dizziness in the last 24 hours?";
                $message->body($question);
                $topic ="Dizziness";
                $responseAns = "2";

                break;
            case "3":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Nausea in the last 24 hours?";
                $message->body($question);
                $topic ="Nausea";
                $responseAns = "3";

                break;
            case "4":
                $question = "On a scale from 0 (none) to 4 (severe), how would you rate your Fatigue in the last 24 hours?";
                $message->body($question);
                $topic ="Fatigue";
                $responseAns = "4";

                break;
            case "5":
                $question = 'On a scale from 0 (none) to 4 (severe), how would you rate your Sadness in the last 24 hours?';
                $message->body($question);
                $topic ="Sadness";
                $responseAns = "5";

                break;
            default:
                $default = true;
                $question = 'Please enter a number from 0 to 5';
                $message->body($question);

                break;
        }
        $last->setTopicSelected($topic);
        $last->setResponse($responseAns);
        $last->save();

        startSurveyFirstMY($sms_user->getNumber(), "Q2", $question, $choices,$topic,"",$default);
    }
    else if($last->getPrevQuestion() == "Q2"){
        $default = false;
        $sms_user = SmsUserQuery::create()
            ->findOneByNumber($params["From"]);
        $message = $response->message();

        $question = "";
        $choices = "0,1,2,3,4";
        $responseAns = "";

        switch (trim(strtoupper($params["Body"]))) {
            case "0":
                $question = "You do not have a " .$last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "0";

                break;
            case "1":
                $question = "You have a mild ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "1";

                break;
            case "2":
                $question = "You have a mild " . $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "2";

                break;
            case "3":
                $question = "You have a moderate ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "3";
                break;
            case "4":
                $question = "You have a severe ". $last->getTopicSelected() ;
                $message->body($question);
                $responseAns= "4";
                break;
            default:
                $question = 'Please enter a number from 0 to 4';
                $message->body($question);
                $default = true;
                break;
        }

        $last->setTopicSelected($last->getTopicSelected());
        $last->setResponse($responseAns);
        $last->save();
        startSurveyFirstMY($sms_user->getNumber(), "Q3", $question, $choices,$last->getTopicSelected(), "",$default);


        if(!$default){
            $count = intval($sms_user->getCount());
            $sms_user->setCount($count + 1);
            $sms_user->save();

            if(intval($count + 1) == 3){
                $question = "Thank you and see you soon";
                $choices = "0";
                startSurveyFirstMY($sms_user->getNumber(), "", $question, $choices,"","",false);

            }else{
                $question = "Please indicate your symptom (1)Headache, (2)Dizziness, (3)Nausea, (4)Fatigue, (5)Sadness, (0)None";
                $choices = "1,2,3,4,5,0";
                startSurveyFirstMY($sms_user->getNumber(), "Q1", $question, $choices,"","",false);

            }
        }


    }





})->setName('api.MyrespondSMS');





function startSurveyFirstMY($user_id, $prev_response, $qText, $cText, $topic, $response,$msgOnly){

    $sid = 'AC4e733e7be2b0a9068cbd1e18f091e6f9';
    $token = '4703a69a7bf68552def8d6dbee51443b';
    $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
    $client->messages->create(
// the number you'd like to send the message to
        '+19802671801',
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '+14434291169',
            // the body of the text message you'd like to send
            'body' => $qText
        )
    );

    if(!$msgOnly) {
        $new_sms = new SmsMessages();
        $new_sms->setUserNumber($user_id);
        $new_sms->setPrevQuestion($prev_response);
        $new_sms->setQuestion($qText);
        $new_sms->setChoises($cText);
        $new_sms->setTopicSelected($topic);
        $new_sms->setResponse($response);
        $new_sms->save();
    }

}


function startSurveyFirst($user_id, $prev_response, $qText, $cText, $topic, $response,$msgOnly){

    $sid = 'ACf0c5f9827e815f452d35137890e48237';
    $token = 'fb1241ed5b01b7da0f333cb296b1971d';
    $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
    $client->messages->create(
// the number you'd like to send the message to
        '+17047568896',
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '+17044904061',
            // the body of the text message you'd like to send
            'body' => $qText
        )
    );

if(!$msgOnly) {
    $new_sms = new SmsMessages();
    $new_sms->setUserNumber($user_id);
    $new_sms->setPrevQuestion($prev_response);
    $new_sms->setQuestion($qText);
    $new_sms->setChoises($cText);
    $new_sms->setTopicSelected($topic);
    $new_sms->setResponse($response);
    $new_sms->save();
}

}


$app->get('/api/createSMS', function ($request, $response, $args) {
// No token required ..
// Your Account SID and Auth Token from twilio.com/console
    $sid = 'AC4e733e7be2b0a9068cbd1e18f091e6f9';
    $token = '4703a69a7bf68552def8d6dbee51443b';
    $client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
    $client->messages->create(
// the number you'd like to send the message to
        '+19802671801',
        array(
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '+14434291169',
            // the body of the text message you'd like to send
            'body' => "Hey Jenny! Good luck on the bar exam!"
        )
    );

})->setName('api.createSMS');


