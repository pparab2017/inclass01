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


$app->get('/MyAdmin/login', function($request, $response, $args){
    return $this->view->render($response, 'public.myAdmin.login.twig.html', []);
})->setName('MyAdminLogin')
    ->add($checkIfDontNeedAuth);


$app->get('/login', function($request, $response, $args){
    return $this->view->render($response, 'public.project.login.twig.html', []);
})->setName('login')
    ->add($checkIfDontNeedAuth);


$app->post('/login', function ($request, $response, $args){

    $params = $request->getParsedBody();

    //return $response->getBody()->write(var_dump($params));
    $falloutLoginView = "public.project.login.twig.html";

    if(!Utils::checkIfNotEmpty($params['login-name'])){
        $params['errors'] = array('username'=>'Error with username');
        return $this->view->render($response, $falloutLoginView, $params);
    } else if(!Utils::checkIfNotEmpty($params['login-pass'])){
        $params['errors'] = array('password'=>'Error with password');
        return $this->view->render($response, $falloutLoginView, $params);
    }

    $user = AdminQuery::create()
        ->filterByEmail($params['login-name'], UserQuery::EQUAL)
        ->findOne();



   // $user->getFname();
    if($user == NULL || !Utils::verifyPassword($params['login-pass'], $user->getHash())) {

        $coordinator =  ProjectUserQuery::create()
            ->filterByEmail($params['login-name'], ProjectUserQuery::EQUAL)
            ->findOne();
        if($coordinator==null || !Utils::verifyPassword($params['login-pass'], $coordinator->getHash())){
                   $params['errors'] = array('login' => 'Incorrect Username or Password');
                   return $this->view->render($response, $falloutLoginView, $params);
        }else{
            Utils::authenticateAs($coordinator, Utils::USER_TYPE_NURSE);
            $path = $this->get('router')->pathFor('project.coordinator.dashboard');
            return $response->withRedirect($path);
        }

    }else {

        //if($user->getro)
        Utils::authenticateAs($user, Utils::USER_TYPE_ADMIN);

        $path = $this->get('router')->pathFor('project.admin.dashboard');
        return $response->withRedirect($path);
    }


})->setName('auth');


$app->get('/logout', function ($request, $response, $args) {
    Utils::logout();
    $path = $this->get('router')->pathFor('main');
    return $response->withRedirect($path);
})->setName('logout');


/// survey app
///
///


