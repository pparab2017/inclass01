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
use Propel\Runtime\Propel;



$app->get('/myAdmin/user/ajax', function ($request, $response, $args) {


    $users = NewuserQuery::create()
        ->find()
        ->toJSON();

    return $users;

})->setName('myAdmin.user.ajax')
    ->add($checkAdminAuthMiddleware);



$app->get('/admin/user/ajax', function ($request, $response, $args) {


    $users = UserQuery::create()
        ->find()
        ->toJSON();

    return $users;

})->setName('admin.user.ajax')
    ->add($checkAdminAuthMiddleware);


$app->get('/admin/messageLog', function ($request, $response, $args){

    $sql = "select R.id As ResponseId, R.Response,N.Fname, N.Lname,R.LastSentTime,
Q.id As questionID, Text, choises, type, time, Q.user_id 
from StudyResponse R join Questions Q
on R.Question_id = Q.id
join NewUser N on Q.user_id = N.id;";

    //$sql = str_replace("{DOCTOR_ID}",$doctor->getId(),$sql);
    $conn = Propel::getConnection();
    $reader = $conn->prepare($sql);
    $reader->execute();
    $results = $reader->fetchAll(PDO::FETCH_ASSOC);


    //json_encode($_GET['recordsTotal']); this is how we access the server side params, if in case
    return json_encode($results);

})->setName('admin.messageLog')->add($checkAdminAuthMiddleware);

$app->post('/admin/user/add', function ($request, $response, $args) {

    $con = Propel::getWriteConnection('default');// get the data base name connection
    $returnJson = "{status: OK}";
    try {
        $params = $request->getParsedBody();// get the form request
        $user = new User();
        $user->setFname(htmlentities($params['user-fname']));
        $user->setLname($params['user-lname']);
        $user->setEmail($params['user-email']);
        $user->setHash(Utils::generateHash($params['user-pass']));
        $user->setGender($params['user-gender']);
        $user->setAddress($params['user-address']);
        $user->setWeight($params['user-weight']);
        $user->setAge($params['user-age']);

        $con->beginTransaction();
        $user->save();


    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            $returnJson =  "Action not completed, An account with this email address already exist!";
        }
        else
        {
            $returnJson = $e->getMessage();
        }
    }
    finally
    {
        $con->commit();
        return json_encode($returnJson);

    }


})->setName('admin.user.add')
    ->add($checkAdminAuthMiddleware);



$app->post('/admin/user/update', function ($request, $response, $args) {
    $returnJson = "OK";
    try {
        $params = $request->getParsedBody();// get the form request
        $user = UserQuery::create()->findOneById($params['user-EditId']);
        $user->setEmail($params['user-email']);
        if($params['user-pass']!= "PASSWORD")
            $user->setHash(Utils::generateHash($params['user-pass']));
        $user->setFname($params['user-fname']);
        $user->setLname($params['user-lname']);
        $user->setGender($params['user-gender']);
        $user->setAddress($params['user-address']);
        $user->setWeight($params['user-weight']);
        $user->setAge($params['user-age']);
        $user->save();
    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An account with this email address already exist!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
    }
    finally
    {
        return json_encode($returnJson);
    }


})
    ->setName('admin.user.update')
    ->add($checkAdminAuthMiddleware);


$app->get('/admin/user/delete/{id}', function ($request, $response, $args) {

    $returnJson = "OK";

    try{
        UserQuery::create()
            ->findById( $args['id'])
            ->delete();
    }
    catch (Exception $ex)
    {
        $returnJson = $ex->getMessage();
    }
    finally
    {
        return json_encode($returnJson);
    }

})->setName('admin.user.delete')
    ->add($checkAdminAuthMiddleware);



$app->get('/admin/user/getAll', function ($request, $response, $args){

    $returnJson = "OK";
    try {
        $returnJson = $request->getParsedBody();// get the form request
        $returnJson =  NewuserQuery::create()
            ->find()
            ->toJSON();

    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An error occurred!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
        $returnJson = json_encode($returnJson);
    }
    finally
    {
        return ($returnJson);
    }


})->setName('myAdmin.user.getAll');



$app->get('/admin/user/getAllQuestions', function ($request, $response, $args){

    $returnJson = "OK";
    try {
        $returnJson = $request->getParsedBody();// get the form request
        $returnJson =  QuestionsQuery::create()
            ->joinWithNewuser()
             ->select(array('Id', 'Text', 'Choises', 'Type', 'Time','StudyId','UserId', 'Newuser.Fname', 'Newuser.Lname' ))
            ->find()

            ->toJSON();

    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An error occurred!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
        $returnJson = json_encode($returnJson);
    }
    finally
    {
        return ($returnJson);
    }


})->setName('myAdmin.user.getAllQuestions') ->add($checkAdminAuthMiddleware);


$app->get('/admin/message/delete/{id}', function ($request, $response, $args) {

    $returnJson = "OK";

    try{
        QuestionsQuery::create()
            ->findOneById( $args['id'])
            ->delete();
    }
    catch (Exception $ex)
    {
        $returnJson = $ex->getMessage();
    }
    finally
    {
        return json_encode($returnJson);
    }

})->setName('admin.message.delete')->add($checkAdminAuthMiddleware);





$app->post('/admin/user/updateMessage', function ($request, $response, $args){

    $returnJson = "{status: OK}";;
    try {

        $params = $request->getParsedBody();// get the form request
        $questions = QuestionsQuery::create()->findOneById($params['questionId']);
if($questions!=null) {
    $questions->setUserId($params['userId']);
    $questions->setType($params['type']);
    $questions->setTime($params['time']);
    $questions->setChoises($params['choices']);
    $questions->setText($params['questionText']);
    $questions->setStudyId(1);
    $questions->save();
}

    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An error occurred!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
    }
    finally
    {
        return json_encode($returnJson);
    }


})->setName('myAdmin.user.UpdateMessage')->add($checkAdminAuthMiddleware);





$app->post('/admin/user/addMessage', function ($request, $response, $args){

    $returnJson = "{status: OK}";;
    try {

        $params = $request->getParsedBody();// get the form request
        $questions = new Questions();
        $questions->setUserId($params['userId']);
        $questions->setType($params['type']);
        $questions->setTime($params['time']);
        $questions->setChoises($params['choices']);
        $questions->setText($params['questionText']);
        $questions->setStudyId(1);
        $questions->save();

    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An error occurred!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
    }
    finally
    {
        return json_encode($returnJson);
    }


})->setName('myAdmin.user.addMessage')->add($checkAdminAuthMiddleware);




$app->post('/myAdmin/user/add', function ($request, $response, $args) {

    $con = Propel::getWriteConnection('default');// get the data base name connection
    $returnJson = "OK";
    try {
        $params = $request->getParsedBody();// get the form request
        $user = new Newuser();
        $user->setFname(htmlentities($params['user-fname']));
        $user->setLname($params['user-lname']);
        $user->setEmail($params['user-email']);
        $user->setHash(Utils::generateHash($params['user-pass']));
        $user->setGender($params['user-gender']);
        $user->setRole('PATIENT');

        $con->beginTransaction();
        $user->save();


    }
    catch (Exception $e) {
        $con->rollBack();
        if(strpos($e, '1062') !== false)
        {
            $returnJson =  "Action not completed, An account with this email address already exist!";
        }
        else
        {
            $returnJson = $e->getMessage();
        }
    }
    finally
    {
        $con->commit();
        return json_encode($returnJson);

    }


})->setName('myAdmin.user.add')
    ->add($checkAdminAuthMiddleware);




$app->post('/myAdmin/user/update', function ($request, $response, $args) {
    $returnJson = "OK";
    try {
        $params = $request->getParsedBody();// get the form request
        $user = NewuserQuery::create()->findOneById($params['user-EditId']);
        $user->setEmail($params['user-email']);
        if($params['user-pass']!= "PASSWORD")
            $user->setHash(Utils::generateHash($params['user-pass']));
        $user->setFname($params['user-fname']);
        $user->setLname($params['user-lname']);
        $user->setGender($params['user-gender']);
        $user->setRole('PATIENT');
        $user->save();
    }
    catch (Exception $ex)
    {
        if(strpos($ex, '1062') !== false)
        {
            $returnJson =  "Action not completed, An account with this email address already exist!";
        }
        else
        {
            $returnJson = $ex->getMessage();
        }
    }
    finally
    {
        return json_encode($returnJson);
    }


})
    ->setName('myAdmin.user.update')
    ->add($checkAdminAuthMiddleware);



$app->get('/myAdmin/user/delete/{id}', function ($request, $response, $args) {

    $returnJson = "OK";

    try{
        NewuserQuery::create()
            ->findById( $args['id'])
            ->delete();
    }
    catch (Exception $ex)
    {
        $returnJson = $ex->getMessage();
    }
    finally
    {
        return json_encode($returnJson);
    }

})->setName('myAdmin.user.delete')
    ->add($checkAdminAuthMiddleware);


$app->get('/doctor/patient/surveyResults/{id}', function($request, $response, $args)
{
    $params = $request->getParsedBody();// get the form request
    $returnJson =  SurveylogQuery::create()
        ->joinWithNewuser()
        ->filterByPatientId($args['id'])
        ->orderByCreatedAt('desc')
        ->find()
        ->toJSON();

    return ($returnJson);

})->setName('doctor.patients.surveyResults')
    ->add($checkAdminAuthMiddleware);



$app->get('/myAdmin/user/{id}', function ($request, $response, $args) {


    $patient = NewuserQuery::create()
        ->findOneById( $args['id']);
//echo $patient;


   // $patient->get
    return $this->view->render($response, 'public.patient.profile.twig.html', [
       'Patient' => $patient
    ]);

})->setName('myAdmin.user')
    ->add($checkAdminAuthMiddleware);

