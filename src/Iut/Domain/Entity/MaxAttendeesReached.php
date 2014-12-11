<?php

namespace Iut\Domain\Entity;

class MaxAttendeesReached extends \Exception
{
    public function __construct($maxAttendees)
    {
        parent::__construct(
            sprintf(
                'Le nombre de max de participants a été atteint: %s',
                $maxAttendees
            )
        );
    }
} 