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
        $p = ProjectUserQuery::create()->filterById($patient_id,NewuserQuery::EQUAL)->findOne();
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

$app->get('/project_api/get_my_messages', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $userId = $this->jwt->user;


    if(Utils::checkIfNotEmpty($userId))
    {
        $sql = "SELECT m.id, m.text, m.type,m.Study_Id, n.id AS response_id, n.response_text
                FROM project_messages m 
                JOIN project_study s on s.id  = m.Study_Id
                JOIN project_notification n on n.message_id = m.id
                JOIN project_user u on u.study_id = s.id
                WHERE u.id = {USER_ID}
                ORDER BY m.time DESC;";
        $sql = str_replace("{USER_ID}",$userId,$sql);
        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($Msgs); $i++){
            $temp = $Msgs[$i]["text"];
            $php_obj = json_decode($temp,true);
            $Msgs[$i]["text"] = $php_obj;
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


})->setName('project_api.getMyMessages');





?>