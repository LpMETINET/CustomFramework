<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use Iut\Http\Request;
use Iut\ControllerResolver;
use Iut\RouteMatcher;
use Iut\Logger\FileLogger;
use Iut\Logger\ChainLogger;
use Iut\Controller\DefaultController;
use Iut\Controller\UserController;
use Iut\Controller\ErrorController;
use Iut\Views\PhpViewRenderer;
use \Iut\Config\PhpLoader;
use \Iut\Config\Configuration;
use Iut\Route;

$request = Request::createFromGlobals();
$phpLoader = new PhpLoader([__DIR__ . "/config/app.php"]);
$configuration = new Configuration($phpLoader);

$viewRenderer = new PhpViewRenderer(__DIR__ . "/config/" . $configuration->getSection("views")["directory"]);

foreach ($configuration->getSection("routes") as $route) {
    $routes[] = new Route($route["url"], $route["method"], $route["action"]);
}

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