<?php

namespace QuantoSobra\Silex\Redis;

use Pimple\Container;

class OptionsLoader
{
    private $container;
    private $rootKey;

    public function __construct(Container $container, $rootKey)
    {
        $this->container = $container;
        $this->rootKey = $rootKey;
    }

    public function getOption($name, $default = null)
    {
        $options = $this->container[$this->rootKey];

        if (isset($options[$name])) {
            return $options[$name];
        }

        return $default;
    }

    public function getIntOption($name, $default = null)
    {
        $options = $this->container[$this->rootKey];

        if (isset($options[$name]) && is_int($options[$name])) {
            return $options[$name];
        }

        return $default;
    }

    public function getBoolOption($name, $default = null)
    {
        $options = $this->container[$this->rootKey];

        if (isset($options[$name]) && is_bool($options[$name])) {
            return $options[$name];
        }

        return $default;
    }

    public function getStringOption($name, $default = null)
    {
        $options = $this->container[$this->rootKey];

        if (isset($options[$name]) && is_string($options[$name])) {
            return $options[$name];
        }

        return $default;
    }
}