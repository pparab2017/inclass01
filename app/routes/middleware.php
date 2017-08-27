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




$checkAdminAuthMiddleware = function ($request, $response, $next) {
    if(Utils::isAuthenticatedAs(Utils::USER_TYPE_ADMIN)){
        $response = $next($request, $response);
        return $response;
    }
    $path = $this->get('router')->pathFor('main');
    return $response->withRedirect($path);
};

$checkIfDontNeedAuth = function ($request, $response, $next) {
    if(Utils::isAuthenticatedAs(Utils::USER_TYPE_ADMIN)){
        $path = $this->get('router')->pathFor('admin.dashboard');
        return $response->withRedirect($path);
    }
    elseif (Utils::isAuthenticatedAs(Utils::USER_TYPE_NURSE))
    {
        $path = $this->get('router')->pathFor('nurse.dashboard');
        return $response->withRedirect($path);
    }
    elseif (Utils::isAuthenticatedAs(Utils::USER_TYPE_DOCTOR)){
        $path = $this->get('router')->pathFor('doctor.dashboard');
        return $response->withRedirect($path);
    }
    $response = $next($request, $response);
    return $response;
};