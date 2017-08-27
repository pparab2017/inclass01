<?php
/**
 * Created by PhpStorm.
 * User: rlews
 * Date: 3/2/16
 * Time: 12:28 AM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;
use Utils\Utils;
use Utils\TwigExtensionUpdated;
use Dotenv\Dotenv;

require '../vendor/autoload.php';
// setup Propel
require_once '../app/generated-conf/config.php';

$dotenv = new Dotenv('../app');
$dotenv->load();

$app = new \Slim\App;

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig('../app/templates', [
        //'cache' => '../app/cache',
        'debug' => true
    ]);

    $twigExtension = new TwigExtensionUpdated(
        $container['router'],
        $container['request']->getUri()
    );

    $view->addExtension($twigExtension);

    $view->addExtension(new Twig_Extension_Debug());

    $mainUrl = $container['request']->getUri()->getBaseUrl();
    $mainUrl = substr($mainUrl, 0, strrpos ( $mainUrl , '/' ));

    Utils::safeSessionStart();

    if(Utils::isAuthenticated()){
        $view->offsetSet('user', $_SESSION[Utils::USER_OBJECT]);
        $view->offsetSet('role', $_SESSION[Utils::USER_TYPE]);

    }

    $view->offsetSet('baseUrl', $mainUrl);


    return $view;
};

$container["jwt"] = function ($container) {
    return new StdClass;
};

$app->add(new \Slim\Middleware\JwtAuthentication([
    "secure" => false,
    "secret" => getenv("JWT_SECRET"),
    "path" => ["/api"],
    "passthrough" => ["/api/signup", "/api/login", "/api/forgotPassword"],
    "attribute" => "jwt",
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    },
    "callback" => function ($request, $response, $arguments) use ($container) {
        $container["jwt"] = $arguments["decoded"];
    }
]));

require '../app/routes/middleware.php';
require '../app/routes/auth.php';
require '../app/routes/admin.php';
require '../app/routes/api.php';
require '../app/routes/dashboard.php';

$app->get('/', function (Request $request, Response $response) {

    return $this->view->render($response, 'public.home.twig.html', [
    ]);
})->setName('main')
    ->add($checkIfDontNeedAuth);


$app->get('/app', function (Request $request, Response $response) {
    return $this->view->render($response, 'public.app.twig.html', [
    ]);
})->setName('app');

$app->run();