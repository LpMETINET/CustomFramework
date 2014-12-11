<?php

namespace Iut\Parser;

use Iut\Route;

class ConfigurationBootstrapper
{
    private $configArray;

    public function __construct(array $configArray = [])
    {
        $this->configArray = $configArray;
    }


    public function getRoutes()
    {
        $routes = [];
        foreach ($this->configArray["routes"] as $key => $value) {
            $routes[] = new Route($value['url'], $value["method"], $value["action"]);
        }
        return $routes;
    }

    public function getViewsDirectory()
    {
        return $this->configArray["views"]["directory"];
    }
}