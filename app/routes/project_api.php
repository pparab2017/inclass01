<?php
/**
 * Created by PhpStorm.
 * User: Pushparaj P. Parab
 * Date: 2nd December 2017
 * Time: 12:38 AM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Utils\Utils;
use Respect\Validation\Validator as v;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use Propel\Runtime\Propel;



$app->post('/project_api/logout', function ($request, $response, $args){
    $userId = $this->jwt->user;
    $params = $request->getParsedBody();
    $device = ProjectDeviceTokenQuery::create()
        ->filterByToken($params["token"])
        ->filterByUserId($userId)
        ->findOne();

    $device->delete();
    return $response
        ->withJson(['status'=>'ok']);

})->setName("project_api.logout");

$app->post('/project_api/login', function ($request, $response, $args) {


    $params = $request->getParsedBody();
    if(Utils::checkIfNotEmpty($params['email']) && Utils::checkIfNotEmpty($params['password'])){
        $user = ProjectUserQuery::create()
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
            $data["gender"] = $user->getGender();
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
})->setName('project_api.login');

$app->post ('/project_api/register_device', function ($request, $response, $args){

    $params = $request->getParsedBody();
    $patient_id = $this->jwt->user;
    if(Utils::checkIfNotEmpty($patient_id)) {
        $p = ProjectUserQuery::create()->filterById($patient_id,ProjectUserQuery::EQUAL)->findOne();
        if($p != NULL) {

            $reg = new ProjectDeviceToken();
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

})->setName('project_api.deviceRegister');

$app->post('/project_api/get_my_messages', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {

        $count = ProjectNotificationQuery::create()
            ->findByUserId($userId)
            ->count();

        $sql = "SELECT m.id, m.text, m.type,m.Study_Id, n.id AS response_id, n.response_text, n.opened_at
                FROM project_messages m 
                JOIN project_study s on s.id  = m.Study_Id
                JOIN project_notification n on n.message_id = m.id
                JOIN project_user u on u.study_id = s.id
                WHERE u.id = {USER_ID}
                ORDER BY m.time DESC
                LIMIT {_SIZE} OFFSET {_FROM};";
        $sql = str_replace("{USER_ID}",$userId,$sql);
        $sql = str_replace("{_SIZE}",$params["size"],$sql);
        $sql = str_replace("{_FROM}",$params["from"],$sql);
        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($Msgs); $i++){
            //question
            $temp = $Msgs[$i]["text"];
            $php_obj = json_decode($temp,true);
            $Msgs[$i]["text"] = $php_obj;

            //response
            $tempResponse = $Msgs[$i]["response_text"];
            $php_obj_response = json_decode($tempResponse,true);
            $Msgs[$i]["response_text"] = $php_obj_response;

        }

        if($Msgs != null)
        {
            return $response->withJson(['status'=>'ok','count' => $count, 'Messages'=>$Msgs]);
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('project_api.getMyMessages');

$app->post('/project_api/submit_question', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $user_id = $this->jwt->user;

    if(Utils::checkIfNotEmpty($user_id)) {
        $p = ProjectUserQuery::create()->filterById($user_id,ProjectUserQuery::EQUAL)->findOne();
        if($p != NULL) {
            $id  = $params["responseID"];
            if(Utils::checkIfNotEmpty($id)){

                $responseMessage = ProjectNotificationQuery::create()
                    ->filterById($id, ProjectUserQuery::EQUAL)
                    ->findOne();

                if($responseMessage != NULL){

                    $responseMessage->setResponseText($params["responseText"]);
                    $responseMessage->save();

                    return $response->withJson(['status'=>'ok']);
                }
                return $response
                    ->withStatus(400)
                    ->withJson(['status'=>'error', "message"=>"Invalid notification ID"]);

            }  return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', "message"=>"Invalid notification ID"]);

        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('project_api.submitQuestion');

$app->get('/project_api/open_question/{id}', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $user_id = $this->jwt->user;
    $now = new DateTime();
    if(Utils::checkIfNotEmpty($user_id)) {
        $p = ProjectUserQuery::create()->filterById($user_id,ProjectUserQuery::EQUAL)->findOne();
        if($p != NULL) {
            $id  = $args['id'];
            if(Utils::checkIfNotEmpty($id)){

                $responseMessage = ProjectNotificationQuery::create()
                    ->filterById($id, ProjectUserQuery::EQUAL)
                    ->findOne();

                if($responseMessage != NULL){

                    $responseMessage->setOpenedAt($now);
                    $responseMessage->save();

                    return $response->withJson(['status'=>'ok']);
                }
                return $response
                    ->withStatus(400)
                    ->withJson(['status'=>'error', "message"=>"Invalid notification ID"]);

            }  return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', "message"=>"Invalid notification ID"]);

        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('project_api.openQuestion');

$app->get('/project_api/get_my_surveys', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {

        $sql = "SELECT m.id, m.text, m.type,m.Study_Id, n.id AS response_id, n.response_text, n.opened_at
                FROM project_messages m 
                JOIN project_study s on s.id  = m.Study_Id
                JOIN project_notification n on n.message_id = m.id
                JOIN project_user u on u.study_id = s.id
                WHERE u.id = {USER_ID} AND m.type ='SURVEY'
                ORDER BY m.time DESC";

        $sql = str_replace("{USER_ID}",$userId,$sql);
        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($Msgs); $i++){
            //question
            $temp = $Msgs[$i]["text"];
            $php_obj = json_decode($temp,true);
            $Msgs[$i]["text"] = $php_obj;

            //response
            $tempResponse = $Msgs[$i]["response_text"];
            $php_obj_response = json_decode($tempResponse,true);
            $Msgs[$i]["response_text"] = $php_obj_response;

        }

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


})->setName('project_api.getMySurveys');

// number of surveys answered or not
// number of messages answered or not
$app->get('/project_api/account_dashboard', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {


        $user = ProjectUserQuery::create()
            ->findOneById($userId);

        $data["userId"] = $user->getId();
        $data["userEmail"] = $user->getEmail();
        $data["userFname"] = $user->getFname();
        $data["userLname"] = $user->getLname();
        $data["gender"] = $user->getGender();

        $sql = "SELECT SUM(CASE 
                            WHEN t.response_text IS NULL and m.type = 'SURVEY'  THEN 1
                            ELSE 0
                            END) AS SURVEY_PENDING,
                SUM(CASE 
                            WHEN t.response_text IS NOT NULL and m.type = 'SURVEY' THEN 1
                            ELSE 0
                            END) AS SURVEY_ANSWRED,
                SUM(CASE 
                            WHEN t.response_text IS NULL and m.type = 'QUESTION' THEN 1
                            ELSE 0
                            END) AS QUESTION_PENDING,
                SUM(CASE 
                            WHEN t.response_text IS NOT NULL and m.type = 'QUESTION' THEN 1
                            ELSE 0
                            END) AS QUESTION_ANSWRED   
                FROM project_notification t
                join project_messages m on m.id = t.message_id
                WHERE t.user_id = {USER_ID};";
        $sql = str_replace("{USER_ID}",$userId,$sql);
        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetch(PDO::FETCH_ASSOC);



        if($Msgs != null)
        {
            return $response->withJson(['status'=>'ok', 'dashboard'=>$Msgs,'user' => $data] );
        }
        return $response
            ->withStatus(400)
            ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('project_api.account_dashboard');

?>