<?php

namespace Iut;

use Iut\Http\Request;

class RouteNotFoundException extends \LogicException {
    public function __construct(Request $request)
    {
        parent::__construct(
            sprintf(
                'La route %s associée à la méthode %s n\'existe pas',
                $request->getUri(),
                $request->getMethod()
            )
        );
    }
}