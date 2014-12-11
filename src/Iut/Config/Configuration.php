<?php
/**
 * Created by PhpStorm.
 * User: user01
 * Date: 11/12/14
 * Time: 14:21
 */
namespace Iut\Config;

class Configuration
{
    private $loader;
    private $config;

    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function getSection($section)
    {
        if (!$this->config) {
            $this->config = $this->loader->load();
        }

        if (!isset($this->config[$section])) {
            throw new \Exception("La section n'existe pas");
        }

        return $this->config[$section];
    }
} 