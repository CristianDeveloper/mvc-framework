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

    /**
     * Get last added route
     * @return string
     */
    public function getLastRoute()
    {
        end($this->routes);
        $route = key($this->routes);

        return $route;
    }

    /**
     * Set the name of the last route
     * @param string $name 
     */
    public function setRouteName(string $name)
    {
        $route = $this->getLastRoute();

        $this->routesName[$name] = $route;
    }

    /**
     * Return a route by using its name
     * @param  string $name
     * @return mixed
     */
    public function getRouteByName(string $name)
    {
        if (isset($this->routeNames[$name])) {
            return $this->routeNames[$name];
        }
    }

    /**
     * Set a segment of the route URI
     * @param string $routeModifier
     */
    public function setRouteModifier(string $routeModifier)
    {
        $this->routeModifier = $routeModifier;
    }

    /**
     *  Call the specific action based on the URI
     * @param  \Core\Container|null $container
     * @return mixed
     */
    public function dispatch(\Core\Container $container = null)
    {
        // check if the URI match one of the routes
        if (!isset($this->routes[$this->uri])) {
            throw new RouteNotFoundException("The {$this->uri} route was not found.", 404);
        }

        // check if the current HTTP method matches one of the route's methods
        if (!in_array($this->method, $this->methods[$this->uri])) {
            throw new MethodNotAllowedException("The {$this->method} is not allowed.", 405);
        }

        if (is_array($this->routes[$this->uri])) {
            $controller = new $this->routes[$this->uri][0]($container);
            echo $controller->{$this->routes[$this->uri][1]}();

            return;
        }

        echo call_user_func($this->routes[$this->uri], [$container]);

        return;
    }
}