<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 10/12/14
 * Time: 11:09
 */

namespace Iut;

use Iut\Controller\ErrorController;

class ExceptionHandler
{
    public function handle(\Exception $e)
    {
        $action = "genericErrorAction";
        if($e instanceof RouteNotFoundException) {
            $action = "routeNotFoundAction";
        }

        return [new ErrorController(), $action];
    }
} 