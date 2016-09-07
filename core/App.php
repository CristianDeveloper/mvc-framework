<?php 

/**
 * App class - Acts like a central point for building our application
 */

namespace Core;

class App
{
    /**
     * Contains an instance of the \Core\Container
     * @var object
     */
    protected $container;

    /**
     * Load class dependencies
     */
    public function __construct()
    {
        $this->container = new Container;

        // load components
        $this->setRequest();
    }

    /**
     * Returns the object \Core\Container
     * @return object
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set the \Core\Request object into the container
     */
    protected function setRequest()
    {
        $this->container['request'] = function () {
            return new Request();
        };
    }
}