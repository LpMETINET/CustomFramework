<?php

namespace Iut;

use Iut\Controller\ErrorController;
use Iut\Logger\LoggerInterface;

class ExceptionHandler
{
    private $logger;

    // Injection de dépendance car exceptionHandler dépend d'une classe Logger
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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

        $action = "genericErrorAction";
        if($e instanceof RouteNotFoundException) {
            $action = "routeNotFoundAction";
        }

        return [new ErrorController(), $action];
    }
}