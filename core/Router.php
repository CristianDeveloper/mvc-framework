<?php 

/**
 * Router class - Stores application's routes
 */

namespace Core;

class Router
{
    /**
     *  Contains the current URI
     * @var string
     */
    protected $uri;

    /**
     *  Contains the current HTTP method
     * @var string
     */
    protected $method;

    /**
     *  Contains all application's routes
     * @var array
     */
    protected $routes = [];

    /**
     *  Contains specific HTTP methods for every single route
     * @var array
     */
    protected $methods = [];

    /**
     *  Contains names for routes
     * @var array
     */
    protected $routesName = [];

    /**
     *  Route modifier, used when a group of routes is created.
     * @var string
     */
    protected $routeModifier = '';

    
}