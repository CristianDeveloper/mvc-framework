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

    /**
     *  Load class dependencies
     * @param string $uri    [description]
     * @param string $method [description]
     */
    public function __construct(string $uri, string $method)
    {
        $this->uri = $uri;
        $this->method = $method;
    }

    /**
     *  Add a new route in the $routes property
     *  and store methods for each route in the $methods property
     * @param string $route  
     * @param mixed $action 
     * @param array  $methods 
     * @return self 
     */
    public function addRoute(string $route, $action, array $methods = [])
    {
        $route = $this->routeModifier . $route;
        $this->routes[$route] = $action;
        $this->methods[$route] = $methods;

        return $this;
    }

    
}