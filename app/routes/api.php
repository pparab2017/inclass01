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
