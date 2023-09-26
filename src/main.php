<?php

include_once __DIR__ . "/../vendor/autoload.php";

use App\SystemServices\MonologFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddLeware;
use Slim\Factory\AppFactory;

$logger  = MonologFactory::getInstance();

$logger -> info("Informação que julgo importante enquanto programo para loggar");
$logger -> debug("Arquivo main.php rodando...");
$logger -> error("Vejo que temos um erro aqui...");

$app = AppFactory::create();

$app -> addRoutingMiddleware();
$app -> add(new BasePathMiddLeware($app));
$app -> addErrorMiddleware(true, true, true);

$app -> get('/', function (Request $request, Response $response){
    $response -> getBody() -> write('Hello World!');
    return $response;
});

$app -> get('/inserirusuario', function (Request $request, Response $response){
    $response -> getBody() -> write('Hello World');
    return $response;
});

$app -> run();