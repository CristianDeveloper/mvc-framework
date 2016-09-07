<?php 

/**
 * Middlewares class - Contains all application's middlewares
 */

namespace Core;

class Middleware
{
    /**
     * Stores an array of route's middlewares
     * @var array
     */
    protected $middlewares = [];

    /**
     * Stores an array of global app middlewares
     * @var array
     */
    protected $globalMiddlewares = [];

    /**
     * Holds the \Core\Container object
     * @var object
     */
    protected $container;

    public function __construct(\Core\Container $container)
    {
        $this->container = $container;
    }

    /**
     * Add a route ( before ) middleware
     * @param string $route      
     * @param array  $middleware 
     */
    public function addMiddleware(string $route, array $middleware = []) 
    {
        $this->middlewares[$route] = $middleware;
    }

    /**
     * Add a global ( before ) middleware
     * @param array $globalMiddleware [description]
     */
    public function addGlobalMiddleware(array $globalMiddleware = [])
    {
        $this->globalMiddlewares[] = $globalMiddleware;
    }

    /**
     * Call a route middleware based on the specified route
     * @param  string $route  
     */
    public function callBeforeMiddleware(string $route)
    {
        if (isset($this->middlewares[$route])) {
            $middleware = new $this->middlewares[$route][0]($this->container);
            echo $middleware->{$this->middlewares[$route][1]}();
        }
    }

    /**
     * Call all the global middlewares
     */
    public function callGlobalMiddlewares()
    {
        foreach ($this->globalMiddlewares as $item) {
            $middleware = new $item[0]($this->container);
            echo $middleware->{$item[1]}();
        }
    }
}