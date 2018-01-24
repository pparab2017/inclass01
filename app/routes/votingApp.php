<?php
/**
 * Created by PhpStorm.
 * User: Pushparaj P. Parab
 * Date: 23rd January 2018
 * Time: 1:38 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Utils\Utils;
use Respect\Validation\Validator as v;
use Firebase\JWT\JWT;
use Tuupola\Base62;
use Propel\Runtime\Propel;

$app->post('/voting_app/vote', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    $_id = $this->jwt->user;
try {
    $getFruit =  VotingOptionQuery::create()
        ->findOneByName($params['name']);

    $userVote = new VotingUserOption();
    $userVote->setVoteId($getFruit->getId());
    $userVote->setUserId($_id);
    $userVote->save();

    $user = VotingUserQuery::create()
        ->leftJoinVotingUserOption()
        ->filterById($_id, VotingUserQuery::EQUAL)
        ->findOne();

    if (count($user->getVotingUserOptions()) > 0) {
        $vote = VotingOptionQuery::create()
            ->findOneById($user->getVotingUserOptions()[0]->getVoteId());
        $data["vote"] = $vote->getName();
    } else {
        $data["vote"] = "";
    }
    $data["userId"] = $user->getId();
    $data["userId"] = $user->getId();
    $data["userEmail"] = $user->getEmail();
    $data["userFname"] = $user->getFname();
    $data["userLname"] = $user->getLname();
    $data["gender"] = $user->getGender();
    $group = VotingOptionQuery::create()
        ->leftJoinVotingUserOption()
        ->groupById()
        ->withColumn('count(VotingUserOption.VoteId)', 'val')
        ->withColumn("VotingOption.Name", "name")
        ->select(array("VotingOption.color" => "color"))
        ->find();
    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode(["status" => "ok", "user" => $data, "voting" => $group->toArray()], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
}
catch (Exception $ex){
    $data["status"] = "error";
    $data["message"] = $ex->getPrevious()->getMessage();
    return $response->withStatus(401)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
}


})->setName('voting_app.vote');

$app->get('/voting_app/getVotes', function ($request, $response, $args) {

    $_id = $this->jwt->user;

    $user = VotingUserQuery::create()
        ->leftJoinVotingUserOption()
        ->filterById($_id,VotingUserQuery::EQUAL)
        ->findOne();


   // $data["vote"] = $user->getVotingUserOptions()[0]->getVotingOption()->getName();
   // else
    if(count( $user->getVotingUserOptions()) > 0)
    {
        $vote = VotingOptionQuery::create()
            ->findOneById($user->getVotingUserOptions()[0]->getVoteId());
        $data["vote"] =$vote->getName();
    }

    else{
        $data["vote"] ="";
    }
    $data["userId"] = $user->getId();
    $data["userId"] = $user->getId();
    $data["userEmail"] = $user->getEmail();
    $data["userFname"] = $user->getFname();
    $data["userLname"] = $user->getLname();
    $data["gender"] = $user->getGender();
    $group = VotingOptionQuery::create()
        ->leftJoinVotingUserOption()
        ->groupById()
        ->withColumn('count(VotingUserOption.VoteId)', 'val')
        ->withColumn("VotingOption.Name", "name")
        ->select(array("VotingOption.color" => "color"))
        ->find();
    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode(["status" => "ok", "user" => $data, "voting" =>$group->toArray()], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));



})->setName('voting_app.getVotes');

$app->get('/voting_app/ugetVotes', function ($request, $response, $args) {


    $group = VotingOptionQuery::create()
        ->leftJoinVotingUserOption()
        ->groupById()
        ->withColumn('count(VotingUserOption.VoteId)', 'val')
        ->withColumn("VotingOption.Name", "name")
        ->select(array("VotingOption.color" => "color"))
        ->find();
    return $response->withStatus(201)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode(["status" => "ok", "voting" =>$group->toArray()], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));



})->setName('voting_app.getVotes');



$app->post('/voting_app/register', function ($request, $response, $args) {
    $params = $request->getParsedBody();
    if(Utils::checkIfNotEmpty($params['email'])
        && Utils::checkIfNotEmpty($params['password'])
        && Utils::checkIfNotEmpty($params['fname'])
        && Utils::checkIfNotEmpty($params['lname'])
        && Utils::checkIfNotEmpty($params['gender'])
    ){
        try {
            $voting_user = new VotingUser();
            $voting_user->setEmail($params['email']);
            $voting_user->setFname($params['fname']);
            $voting_user->setLname($params['lname']);
            $voting_user->setHash(Utils::generateHash($params['password']));
            $voting_user->setGender($params['gender']);
            $voting_user->save();
            $data["status"] = "ok";
            return $response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
        catch (Exception $e){
            $data["status"] = "error";
            $data["message"] = $e->getPrevious()->getMessage();
            return $response->withStatus(401)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }

    }
    $data["status"] = "error";
    $data["message"] = "Enter all the fields";
    return $response->withStatus(401)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));


})->setName('voting_app.register');


$app->post('/voting_app/login', function ($request, $response, $args) {


    $params = $request->getParsedBody();
    if(Utils::checkIfNotEmpty($params['email']) && Utils::checkIfNotEmpty($params['password'])){
        $user = VotingUserQuery::create()
            ->leftJoinVotingUserOption()
            ->filterByEmail($params['email'],VotingUserQuery::EQUAL)
            ->findOne();

        $group = VotingOptionQuery::create()
            ->leftJoinVotingUserOption()
            ->groupById()
            ->withColumn('count(VotingUserOption.VoteId)', 'val')
            ->withColumn("VotingOption.Name", "name")
            ->select(array("VotingOption.color" => "color"))
            ->find();





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
            //$data["status"] = "ok";
            $data["token"] = $token;

            if(count( $user->getVotingUserOptions()) > 0)
            {
                $vote = VotingOptionQuery::create()
                    ->findOneById($user->getVotingUserOptions()[0]->getVoteId());
                $data["vote"] =$vote->getName();
            }

            else{
                $data["vote"] ="";
            }

            $data["userId"] = $user->getId();
            $data["userId"] = $user->getId();
            $data["userEmail"] = $user->getEmail();
            $data["userFname"] = $user->getFname();
            $data["userLname"] = $user->getLname();
            $data["gender"] = $user->getGender();
            return $response->withStatus(201)
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode(["status" => "ok","user" => $data, "voting" =>$group->toArray()], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        }
    }

    $data["status"] = "error";
    $data["message"] = "Incorrect email and/or password";

    return $response->withStatus(401)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
})->setName('voting_app.login');
