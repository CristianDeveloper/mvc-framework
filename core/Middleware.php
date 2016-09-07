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

    
}