<?php

namespace Iut\Http;

class Header
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->checkName($name);
        $this->checkValue($name, $value);
        $this->name = $name;
        $this->value = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return sprintf('%s: %s', $this->name, $this->value);
    }

    private function checkName($name)
    {
        if (!preg_match('/[a-z-]*/i', $name)) {
            throw InvalidHeaderException::name($name);
        }
    }

    private function checkValue($name, $value) {
        if (!preg_match('/[a-z\/-]*/i', $value)) {
            throw InvalidHeaderException::value($name, $value);
        }
    }
}
