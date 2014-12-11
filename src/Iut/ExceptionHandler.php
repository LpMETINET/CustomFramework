<?php

namespace Iut;

use Iut\Controller\ErrorController;
use Iut\Logger\LoggerInterface;

class ExceptionHandler
{
    private $logger;
    private $errorController;

    // Injection de dépendance car exceptionHandler dépend d'une classe Logger
    public function __construct(LoggerInterface $logger, $errorController)
    {
        $this->logger = $logger;
        $this->errorController = $errorController;
    }

    public function handle(\Exception $e)
    {
        $this->logger->log(
          sprintf(
              "[%s] - %s\n",
              date("Y-m-d H:i:s"),
              $e->getMessage()
          )
        );

        $action = "defaultErrorAction";

        if($e instanceof RouteNotFoundException) {
            $action = "routeNotFoundAction";
        }

        return [new ErrorController(), $action];
    }
}