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



$app->get('/admin/login', function($request, $response, $args){
    return $this->view->render($response, 'public.admin.login.twig.html', []);
})->setName('adminLogin')
    ->add($checkIfDontNeedAuth);


$app->post('/admin/login', function ($request, $response, $args){

    $params = $request->getParsedBody();

    //return $response->getBody()->write(var_dump($params));
    $falloutLoginView = "public.admin.login.twig.html";

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
        $params['errors'] = array('login' => 'Incorrect Username or Password');
        return $this->view->render($response, $falloutLoginView, $params);
    }


    Utils::authenticateAs($user, Utils::USER_TYPE_ADMIN);

    $path = $this->get('router')->pathFor('admin.dashboard');
    return $response->withRedirect($path);


})->setName('adminAuth');


$app->get('/logout', function ($request, $response, $args) {
    Utils::logout();
    $path = $this->get('router')->pathFor('main');
    return $response->withRedirect($path);
})->setName('logout');