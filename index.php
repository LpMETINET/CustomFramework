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
use \Iut\Controller\DefaultController;
use \Iut\Controller\UserController;
use \Iut\Controller\ErrorController;
use \Iut\Views\PhpViewRenderer;

$request = Request::createFromGlobals();

$routes = [
    new Route('/', 'GET', '\Iut\Controller\DefaultController::homepageAction'),
    new Route('/about', 'GET', '\Iut\Controller\DefaultController::aboutAction'),
    new Route('/register', 'GET', '\Iut\Controller\UserController::registerAction'),
    new Route('/profile', 'GET', '\Iut\Controller\UserController::viewProfileAction'),
];

$viewRenderer = new PhpViewRenderer(__DIR__ . "/views/");

try {
    $matcher            = new RouteMatcher($routes);
    $controllerResolver = new ControllerResolver($matcher);
    $controllerResolver->addController(
        new DefaultController($viewRenderer)
    );
    $controllerResolver->addController(
        new UserController($viewRenderer)
    );
    $resolvedController = $controllerResolver->resolve($request);
    $response           = call_user_func($resolvedController);
} catch (\Exception $e) {
    $chainLogger           = new ChainLogger();
    $chainLogger->addLogger(new FileLogger("error.log"));
    $exceptionHandler = new \Iut\ExceptionHandler($chainLogger, new ErrorController($viewRenderer));
    $controllerAction = $exceptionHandler->handle($e);
    $response         = call_user_func($controllerAction);
}

$response->send();