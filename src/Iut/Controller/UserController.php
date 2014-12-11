<?php

namespace Iut\Controller;

class UserController extends AbstractController
{
    public function registerAction()
    {
        return $this->createResponse(
            $this->viewRenderer->render(
                "register.html.php",
                [
                    "title" => "je s'appel Register",
                    "headTitle" => "register"
                ]
            )
        );
    }

    public function viewProfileAction()
    {
        return $this->createResponse(
            $this->viewRenderer->render(
                "viewProfile.html.php",
                [
                    "title" => "je s'appel ViewProfile",
                    "headTitle" => "view profile"
                ]

            )
        );
    }
}