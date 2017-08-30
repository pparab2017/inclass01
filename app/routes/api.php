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





