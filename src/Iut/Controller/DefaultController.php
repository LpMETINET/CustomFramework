<?php

namespace Iut\Controller;

use Iut\Http\Response;
use Iut\Views\ViewRenderer;

class DefaultController
{
    private $viewRenderer;

    public function __construct()
    {
        $this->viewRenderer = new ViewRenderer(__DIR__ . '/../Views/');
    }

    public function homePageAction()
    {
        $view = $this->viewRenderer->render(
            "homepage.html.php",
            [
                "title" => "je s'appel Homepage",
                "headTitle" => "homepage"
            ]
        );

        return $this->createResponse($view);
    }

    public function aboutAction()
    {
        $view = $this->viewRenderer->render(
            "about.html.php",
            [
                "title" => "je s'appel About",
                "headTitle" => "about"
            ]
        );

        return $this->createResponse($view);
    }

    public function createResponse($body)
    {
        return new Response(200, $body);
    }
}