<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use Iut\Http\Request;
use Iut\Route;
use Iut\ControllerResolver;
use Iut\RouteMatcher;
use Iut\Logger\FileLogger;
use Iut\Logger\ChainLogger;

$request = Request::createFromGlobals();

$homepageRoute = new Route('/', 'GET', '\Iut\Controller\DefaultController::homepageAction');
$aboutRoute    = new Route('/about', 'GET', '\Iut\Controller\DefaultController::aboutAction');
try {
    $matcher            = new RouteMatcher([$homepageRoute, $aboutRoute]);
    $controllerResolver = new ControllerResolver($matcher);
    $resolvedController = $controllerResolver->resolve($request);
    $response           = call_user_func($resolvedController);
} catch (\Exception $e) {
    $chainLogger           = new ChainLogger();
    $chainLogger->addLogger(new FileLogger("error.log"));
    $exceptionHandler = new \Iut\ExceptionHandler($chainLogger);
    $controllerAction = $exceptionHandler->handle($e);
    $response         = call_user_func($controllerAction);
}

$response->send();