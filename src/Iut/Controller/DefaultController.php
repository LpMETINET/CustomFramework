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
    public function aboutAction()
    {
        $view = $this->viewRenderer->render(
          "about.html.php",
          [
              "titre"     => "je sapel About",
              "headTitle" => "about"
          ]
        );

        return $this->createResponse($view);
    }

    public function homePageAction()
    {
        $view = $this->viewRenderer->render(
            "about.html.php",
            [
                "titre"     => "je sapel Homepage",
                "headTitle" => "homepage"
            ]
        );

        return $this->createResponse($view);
    }

    public function createResponse($body)
    {
        return new Response(200, $body);
    }
} 