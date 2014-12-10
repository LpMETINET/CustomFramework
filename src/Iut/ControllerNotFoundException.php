<?php

namespace Iut;

class ControllerNotFoundException extends \LogicException {
    public function __construct($className)
    {
        parent::__construct(
            sprintf(
                'le controller "%s" n\'a pas été trouvé',
                $className
            )
        );
    }
}