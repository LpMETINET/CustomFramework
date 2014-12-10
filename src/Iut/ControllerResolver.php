<?php

namespace Iut;

use Iut\Http\Request;

class ControllerResolver implements ControllerResolverInterface
{
    private $matcher;

    public function __construct(RouteMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function resolve(Request $request)
    {
        $action = $this->matcher->match($request);
        $splitAction = explode('::', $action);
        if (!class_exists($splitAction[0])) {
            throw new ControllerNotFoundException($splitAction[0]);
        }

        $controller = new $splitAction[0]();
        $action = $splitAction[1];

        return [$controller, $action];
    }
}