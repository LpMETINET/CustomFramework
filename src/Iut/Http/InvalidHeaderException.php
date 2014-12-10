<?php

namespace Iut\Http;

class InvalidHeaderException extends \InvalidArgumentException
{
    static public function name($name)
    {
        return new self(sprintf(
           "Le nom de l'entête est invalide: '%s'",
            $name
        ));
    }

    static public function value($name, $value)
    {
        return new self(sprintf(
          "La valeur de l'entête '%s' est invalide: %s",
          $name,
          $value
        ));
    }
}
