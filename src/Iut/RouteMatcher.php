<?php

namespace Iut;


class RouteMatcher
{
    private $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    public function match(Request $request)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($route->getUrl() === $request->getUri()
            && $route->getMethod() === $request->getMethod()) {

                return $route->getAction();
            }
        }

        throw new RouteNotFoundException($request);
    }
}