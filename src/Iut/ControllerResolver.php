<?php

namespace Iut;

use Iut\Http\Request;

class ControllerResolver implements ControllerResolverInterface
{
    private $matcher;
    private $controllers;

    public function __construct(RouteMatcher $matcher)
    {
        $this->matcher = $matcher;
    }

    public function resolve(Request $request)
    {
        $action = $this->matcher->match($request);
        $splitAction = explode('::', $action);
        foreach ($this->controllers as $controller) {
            if ('\\' . get_class($controller) === $splitAction[0]) {
                $action = $splitAction[1];

                return [$controller, $action];
            }
        }

        throw new ControllerNotFoundException($splitAction[0]);
    }

    public function addController($controllerInstance)
    {
        if (!is_object($controllerInstance)) {
            throw new \Exception('$controllerInstance must be an instance of Controller');
        }

        $this->controllers[] = $controllerInstance;
    }
}