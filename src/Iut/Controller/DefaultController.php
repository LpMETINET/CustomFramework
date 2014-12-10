<?php

namespace Iut\Controller;

use Iut\Response;

class DefaultController {

    public function homepageAction()
    {
        $response = new Response(200, 'Page home');

        return $response;
    }

    public function aboutAction()
    {
        $response = new Response(200, 'Page about');

        return $response;
    }
} 