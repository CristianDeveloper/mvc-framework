<?php 

namespace App\Controllers;

class Controller 
{
    protected $container;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if (isset($this->container[$property])) {
            return $this->container[$property];
        }
    }
}