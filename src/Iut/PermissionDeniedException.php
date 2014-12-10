<?php

namespace Iut;


class PermissionDeniedException extends \Exception
{
    public function __construct($fullPathName)
    {
        parent::__construct(
            sprintf(
                "Unable to create '%s': PERMISSION DENIED",
                $fullPathName
            )
        );
    }
} 