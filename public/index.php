<?php

use Src\Actions\Error\ErrorAction;
use Src\Http\RequestFactory;
use Src\Http\ResponseSender;
use Src\Http\Router\Router;
use Src\Template\TemplateRenderer;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';
$params = require 'config/params.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
$request = RequestFactory::fromGlobals($params);

$db = new PDO(
    $params['db']['dsn'],
    $params['db']['user'],
    $params['db']['password']
);

$routes = require 'config/routes.php';

$router = new Router($routes);

try {
    $result = $router->match($request);
    $request->withAttributes($result->getAttributes());
    $action = $result->getHandler();
    $response = $action($request);
} catch (Exception $e) {
    $response = (new ErrorAction(new TemplateRenderer()))($e->getMessage(), $e->getCode(), $request);
}

(new ResponseSender($response))->send();
