<?php

namespace Iut\Domain\Services;

use Iut\Domain\Entity\Conference;

class ConferenceService
{
    public function addSit(Conference $conference, $sitNumber)
    {
        if ($sitNumber <= $conference->getMaxSitNumber()) {
            $value = $conference->getMaxSitNumber() - $sitNumber;
            $conference->setMaxSitNumber($value);
        }
    }
}