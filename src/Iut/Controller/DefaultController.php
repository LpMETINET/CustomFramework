<?php

namespace Iut\Controller;

class DefaultController extends AbstractController
{
    public function homePageAction()
    {
        return $this->createResponse(
            $this->viewRenderer->render(
                "homepage.html.php",
                [
                    "title" => "je s'appel Homepage",
                    "headTitle" => "homepage"
                ]
            )
        );
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
}