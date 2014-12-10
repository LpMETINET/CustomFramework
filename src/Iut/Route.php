<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 09/12/14
 * Time: 16:11
 */

namespace Iut;


class Route
{
    private $url;
    private $method;
    private $action;

    public function __construct($url, $method, $action)
    {
        $this->url    = $url;
        $this->method = $method;
        $this->action = $action;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }


} 