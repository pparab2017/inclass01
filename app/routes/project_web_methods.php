<?php
/**
 * Created by PhpStorm.
 * User: pushparajparab
 * Date: 12/6/17
 * Time: 7:56 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Utils\Utils;
use Respect\Validation\Validator as v;
use Propel\Runtime\Propel;


//Study getAll, Add, Update, Delete
$app->get('/coordinator/allStudy', function ($request, $response, $args) {

    $projectStudy = ProjectStudyQuery::create()
        ->find();

    if($projectStudy != null)
    {
        return $response->withJson(['status'=>'ok', 'Study'=>$projectStudy->toArray()]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error']);

})->setName('coordinator.allStudy');
    //->add($checkAdminAuthMiddleware);


// Add new study
$app->post('/coordinator/study/add', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    try {
        $projectStudy = new ProjectStudy();
        $projectStudy->setStudyName($params["studyName"]);
        $projectStudy->setStudyDescription($params["studyDesc"]);


        $con->beginTransaction();
        $projectStudy->save();
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();
        return $response->withJson(['status'=>'ok', 'CreatedStudy'=>$projectStudy->toArray()]);

    }


})->setName('coordinator.study.add');

// update new study
$app->post('/coordinator/study/update', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    try {

        $projectStudy = ProjectStudyQuery::create()
            ->findOneById($params['id']);

        if($projectStudy != null) {
            $projectStudy->setStudyName($params["studyName"]);
            $projectStudy->setStudyDescription($params["studyDesc"]);


            $con->beginTransaction();
            $projectStudy->save();
        }
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();
        if($projectStudy != null)
        {  return $response->withJson(['status'=>'ok', 'UpdatedStudy'=>$projectStudy->toArray()]);}
        else{
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => "Id not found"]);}


    }


})->setName('coordinator.study.update');

//Delete a study
$app->get('/coordinator/study/delete/{id}', function ($request, $response, $args) {

    $projectStudy = ProjectStudyQuery::create()
        ->filterById($args['id'], ProjectStudyQuery::EQUAL)
        ->findOne();

    if($projectStudy != null)
    {
        $projectStudy->delete();
        return $response->withJson(['status'=>'ok']);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error']);

})->setName('coordinator.allStudy');
//->add($checkAdminAuthMiddleware);




//User Create users
// Add user
$app->post('/user/add', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    try {
        $projectUser = new ProjectUser();
        $projectUser->setEmail($params["userEmail"]);
        $projectUser->setHash(Utils::generateHash($params["password"]));
        $projectUser->setGender($params['userGender']);
        $projectUser->setFname($params['userFname']);
        $projectUser->setLname($params['userLname']);
        if(Utils::checkIfNotEmpty($params['userStudyId'])) {
            $projectUser->setStudyId($params['userStudyId']);
        }
        $projectUser->setRole($params['userRole']);
        // $user->setHash(Utils::generateHash($params['user-pass']));

        $con->beginTransaction();
        $projectUser->save();
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();
        return $response->withJson(['status'=>'ok', 'CreatedUser'=>$projectUser->toArray()]);

    }


})->setName('user.add');


// Update user
$app->post('/user/update', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    $projectUser = ProjectUserQuery::create()
        ->filterById($params['id'])
        ->findOne();
    try {


       if($projectUser!=null) {

           $projectUser->setHash(Utils::generateHash($params["password"]));
           $projectUser->setGender($params['userGender']);
           $projectUser->setFname($params['userFname']);
           $projectUser->setLname($params['userLname']);
           if(Utils::checkIfNotEmpty($params['userStudyId'])) {
               $projectUser->setStudyId($params['userStudyId']);
           }
           $projectUser->setRole($params['userRole']);
           // $user->setHash(Utils::generateHash($params['user-pass']));
           $con->beginTransaction();
           $projectUser->save();
       }
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();
        if($projectUser!=null){
            return $response->withJson(['status'=>'ok', 'UpdatedUser'=>$projectUser->toArray()]);
        }
        else{
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => "Id not found"]);}



    }


})->setName('user.update');


//delete user
$app->get('/user/delete/{id}', function ($request, $response, $args) {

    $projectUser = ProjectUserQuery::create()
        ->filterById($args['id'], ProjectStudyQuery::EQUAL)
        ->findOne();

    if($projectUser != null)
    {
        $projectUser->delete();
        return $response->withJson(['status'=>'ok']);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error']);

})->setName('user.delete');
//->add($checkAdminAuthMiddleware);



// Add message // survey// question
$app->post('/coordinator/message/add', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    try {
        $projectMessage = new ProjectMessages();
        $projectMessage->setText($params["text"]);
        $projectMessage->setReminderType($params["reminderType"]);
        $projectMessage->setType($params['type']);
        $projectMessage->setTime($params['time']);
        $projectMessage->setStudyId($params['studyId']);

        // $user->setHash(Utils::generateHash($params['user-pass']));

        $con->beginTransaction();
        $projectMessage->save();

        $projectMessage->setText($projectMessage->getText());
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();
        $sql = "SELECT `project_messages`.`id`,
                `project_messages`.`text`,
                `project_messages`.`reminder_type`,
                `project_messages`.`type`,
                `project_messages`.`Time`,
                `project_messages`.`Study_Id`,
                `project_messages`.`LastSent`,
                `project_messages`.`created_at`,
                `project_messages`.`updated_at`
            FROM `inclass01`.`project_messages` WHERE id = {_ID};";
        $sql = str_replace("{_ID}",$projectMessage->getId(),$sql);

        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

        $Msgs[0]["text"] = json_decode($Msgs[0]["text"],true);;

        return $response->withJson(['status'=>'ok', 'UpdatedMessage'=>$Msgs]);

    }


})->setName('coordinator.message.add');



// Update message // survey// question
$app->post('/coordinator/message/update', function ($request, $response, $args) {

    $params = $request->getParsedBody();
    $con = Propel::getWriteConnection('default');// get the data base name connection

    $projectMessage = ProjectMessagesQuery::create()
        ->filterById($params['id'])
        ->findOne();
    try {

if($projectMessage != null) {

    $projectMessage->setText($params["text"]);
    $projectMessage->setReminderType($params["reminderType"]);
    $projectMessage->setType($params['type']);
    $projectMessage->setTime($params['time']);
    $projectMessage->setStudyId($params['studyId']);

    // $user->setHash(Utils::generateHash($params['user-pass']));

    $con->beginTransaction();
    $projectMessage->save();


}
    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => 'Action not completed, An account with this email address already exist!']);
        }
        else
        {
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => ($e->getMessage())]);
        }
    }
    finally
    {
        $con->commit();

        if($projectMessage != null){

            $sql = "SELECT `project_messages`.`id`,
                `project_messages`.`text`,
                `project_messages`.`reminder_type`,
                `project_messages`.`type`,
                `project_messages`.`Time`,
                `project_messages`.`Study_Id`,
                `project_messages`.`LastSent`,
                `project_messages`.`created_at`,
                `project_messages`.`updated_at`
            FROM `inclass01`.`project_messages` WHERE id = {_ID};";
            $sql = str_replace("{_ID}",$projectMessage->getId(),$sql);

            $conn = Propel::getConnection();
            $reader = $conn->prepare($sql);
            $reader->execute();
            $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

            $Msgs[0]["text"] = json_decode($Msgs[0]["text"],true);;

            return $response->withJson(['status'=>'ok', 'UpdatedMessage'=>$Msgs]);

        }
        else{
            return $response
                ->withStatus(400)
                ->withJson(['status'=>'error', 'msg' => "Id not found"]);}



    }


})->setName('coordinator.message.update');


// Delete Message

$app->get('/coordinator/message/delete/{id}', function ($request, $response, $args) {

    $projectMessage = ProjectMessagesQuery::create()
        ->filterById($args['id'], ProjectStudyQuery::EQUAL)
        ->findOne();

    if($projectMessage != null)
    {
        $projectMessage->delete();
        return $response->withJson(['status'=>'ok']);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error']);

})->setName('coordinator.message.delete');
//->add($checkAdminAuthMiddleware);

// all messages by study id
$app->get('/coordinator/message/byStudy/{id}', function ($request, $response, $args) {


    $Id = $args['id'];


    if(Utils::checkIfNotEmpty($Id))
    {
        $sql = "SELECT `project_messages`.`id`,
                `project_messages`.`text`,
                `project_messages`.`reminder_type`,
                `project_messages`.`type`,
                `project_messages`.`Time`,
                `project_messages`.`Study_Id`,
                `project_messages`.`LastSent`,
                `project_messages`.`created_at`,
                `project_messages`.`updated_at`
            FROM `inclass01`.`project_messages` WHERE Study_Id = {_STUDY_ID};";
        $sql = str_replace("{_STUDY_ID}",$Id,$sql);

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
        }else{
            return $response->withJson(['status'=>'ok', 'Messages'=>$Msgs]);
        }


    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('coordinator.message.byStudy');
//->add($checkAdminAuthMiddleware);



//delete user
$app->get('/user/getbyStudyId/{id}', function ($request, $response, $args) {

    $projectUser = ProjectUserQuery::create()
        ->filterByStudyId($args['id'], ProjectUserQuery::EQUAL)
        ->find();

    if($projectUser != null)
    {
        return $response->withJson(['status'=>'ok', 'user' => $projectUser->toArray()]);
    }else{
        return $response->withJson(['status'=>'ok', 'user' => $projectUser->toArray()]);
    }


})->setName('user.getbyStudyId');
//->add($checkAdminAuthMiddleware);



//delete user
$app->get('/user/allUsers', function ($request, $response, $args) {

    $projectUser = ProjectUserQuery::create()
        ->find();

    if($projectUser != null)
    {
        return $response->withJson(['status'=>'ok', 'user' => $projectUser->toArray()]);
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error']);

})->setName('user.allUsers');
//->add($checkAdminAuthMiddleware);




//delete user
$app->get('/coordinator/response/study/{id}', function ($request, $response, $args) {

$studyId = $args['id'];
    if(Utils::checkIfNotEmpty($studyId))
    {

        $sql = "SELECT m.id, m.text, m.type,m.Study_Id, n.id AS response_id, n.response_text, n.opened_at
                FROM project_messages m 
                JOIN project_study s on s.id  = m.Study_Id
                JOIN project_notification n on n.message_id = m.id
                JOIN project_user u on u.study_id = s.id
                WHERE s.id = {STUDY_ID}
                ORDER BY m.time DESC";
        $sql = str_replace("{STUDY_ID}",$studyId,$sql);

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
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }else{
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);


})->setName('coordinator.response.study');
//->add($checkAdminAuthMiddleware);



//delete user
$app->get('/coordinator/response/user/{id}', function ($request, $response, $args) {
    $userId = $args['id'];
    if(Utils::checkIfNotEmpty($userId))
    {

        $sql = "SELECT m.id, m.text, m.type,m.Study_Id, n.id AS response_id, n.response_text, n.opened_at
                FROM project_messages m 
                JOIN project_study s on s.id  = m.Study_Id
                JOIN project_notification n on n.message_id = m.id
                JOIN project_user u on u.study_id = s.id
                WHERE u.id = {USER_ID}
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
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }else{
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('coordinator.response.user');
//->add($checkAdminAuthMiddleware);



//delete user
$app->get('/coordinator/response/survey/{id}', function ($request, $response, $args) {
    $surveyId = $args['id'];
    if(Utils::checkIfNotEmpty($surveyId))
    {

        $sql = " select u.fname,u.lname,u.id as user_id,pn.response_text,pn.opened_at from  
    project_notification pn
    Join  project_user u on pn.user_id = u.id
    where pn.message_id = {SURVEY_ID}";

        $sql = str_replace("{SURVEY_ID}",$surveyId,$sql);

        $conn = Propel::getConnection();
        $reader = $conn->prepare($sql);
        $reader->execute();
        $Msgs = $reader->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0; $i < count($Msgs); $i++){

            //response
            $tempResponse = $Msgs[$i]["response_text"];
            $php_obj_response = json_decode($tempResponse,true);
            $Msgs[$i]["response_text"] = $php_obj_response;
        }

        if($Msgs != null) {
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }else{
            return $response->withJson(['status'=>'ok' ,'Messages'=>$Msgs]);
        }
    }
    return $response
        ->withStatus(400)
        ->withJson(['status'=>'error', "message"=>"Invalid user ID"]);

})->setName('coordinator.response.user');
//->add($checkAdminAuthMiddleware);
