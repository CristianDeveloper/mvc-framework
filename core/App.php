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
        $this->setRouter();
        $this->setMiddleware();
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
            return new \Core\Request();
        };
    }

     /**
     * Set the \Core\Router object into the container
     */
    protected function setRouter()
    {
        $container = $this->container;

        $this->container['router'] = function () use ($container){
            $uri = str_replace('/mvc-framework/public', '', $container['request']->getUri());
            $method = $container['request']->getMethod();

            return new \Core\Router($uri, $method);
        };
    }

        /**
     * Set the \Core\Middleware component
     */
    public function setMiddleware()
    {
        $container = $this->container;

        $this->container['middleware'] = function () use ($container){
            return new \Core\Middleware($container);
        };
    }

    /**
     * Create a route that answers to a HTTP GET request
     * @param  string $route 
     * @param  mixed $action
     * @return self
     */
    public function get(string $route, $action) 
    {
        $this->container['router']->addRoute($route, $action, ['GET']);

        return $this;
    }

    /**
     * Create a route that answers to a HTTP POST request
     * @param  string $route 
     * @param  mixed $action
     * @return self
     */
    public function post(string $route, $action) 
    {
        $this->container['router']->addRoute($route, $action, ['POST']);

        return $this;
    }

    /**
     * Create a group of routes
     * @param  string   $route 
     * @param  callable $action 
     * @return self
     */
    public function group(string $route, callable $action)
    {
        $this->container['router']->setRouteModifier($route);
        call_user_func($action);
        $this->container['router']->setRouteModifier('');

        return $this;
    }

    /**
     * Set a name for the last added route
     * @param string $name
     * @return self
     */
    public function setName(string $name)
    {
        $this->container['router']->setRouteName($name);

        return $this;
    }

    /**
     * Add a route middleware
     * @param  array  $middleware
     */
    public function middleware(array $middleware = []) 
    {
        $route = $this->container['router']->getLastRoute();

        $this->container['middleware']->addMiddleware($route, $middleware);
    }

    /**
     * Add a global middleware
     * @param array $middleware
     */
    public function add(array $middleware = [])
    {
        $this->container['middleware']->addGlobalMiddleware($middleware);
    }

    /**
     * Run the application
     */
    public function run()
    {

        $uri = str_replace('/mvc-framework/public', '', $this->container['request']->getUri());

        $this->container['middleware']->callGlobalMiddlewares();
        $this->container['middleware']->callBeforeMiddleware($uri);
        $this->container['router']->dispatch($this->container);

    }
}