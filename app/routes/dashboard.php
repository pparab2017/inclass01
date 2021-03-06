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



$app->get('/admin[/[dashboard]]', function ($request, $response, $args) {

    $errorString="";
    $paramValue = $request-> getQueryParam('error',null);
    if($paramValue!=null)
    $errorString = Utils::getErrorString($paramValue);
    return $this->view->render($response, 'public.admin.dashboard.twig.html', [
        "error" => $errorString
    ]);
})->setName('admin.dashboard')
    ->add($checkAdminAuthMiddleware);



$app->get('/project/admin[/[dashboard]]', function ($request, $response, $args) {

    $errorString="";
    $paramValue = $request-> getQueryParam('error',null);
    if($paramValue!=null)
        $errorString = Utils::getErrorString($paramValue);


    return $this->view->render($response, 'public.project.admin.dashboard.twig.html', [
        "error" => $errorString
    ]);


})->setName('project.admin.dashboard')
    ->add($checkAdminAuthMiddleware);




$app->get('/project/coordinator[/[dashboard]]', function ($request, $response, $args) {

    $errorString="";
    $paramValue = $request-> getQueryParam('error',null);
    if($paramValue!=null)
        $errorString = Utils::getErrorString($paramValue);
    return $this->view->render($response, 'public.project.coordinator.dashboard.twig.html', [
        "error" => $errorString
    ]);
})->setName('project.coordinator.dashboard')
    ->add($checkCoordinatorAuthMiddleware);





$app->get('/myAdmin/messages', function ($request, $response, $args) {

    $errorString="";
    $paramValue = $request-> getQueryParam('error',null);
    if($paramValue!=null)
        $errorString = Utils::getErrorString($paramValue);
    return $this->view->render($response, 'public.myAdmin.messages.twig.html', [
        "error" => $errorString
    ]);
})->setName('myAdmin.messages')
    ->add($checkAdminAuthMiddleware);



$app->get('/myAdmin/logs', function ($request, $response, $args) {

    $errorString="";
    $paramValue = $request-> getQueryParam('error',null);
    if($paramValue!=null)
        $errorString = Utils::getErrorString($paramValue);
    return $this->view->render($response, 'public.myAdmin.messageLog.twig.html', [
        "error" => $errorString
    ]);
})->setName('myAdmin.logs')
    ->add($checkAdminAuthMiddleware);


