<?php

namespace Iut\Logger;

interface LoggerInterface
{
    public function log($message);

    public function warn($message);
}