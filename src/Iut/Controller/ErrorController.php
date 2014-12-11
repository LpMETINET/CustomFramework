<?php

namespace Iut\Controller;

use Iut\Http\Response;

class ErrorController extends AbstractController
{
    public function routeNotFoundAction()
    {
        return new Response(404, "La page n'existe pas");
    }

    public function defaultErrorAction()
    {
        return new Response(500, "Une erreur inconnue est survenue");
    }
}