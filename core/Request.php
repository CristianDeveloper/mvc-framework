<?php 

/**
 * Request class - Acts like a representation of the HTTP Request
 */

namespace Core;

class Request
{
    /**
     * Stores the content of the $_SERVER superglobal variable
     * @var array
     */
    protected $server = [];

    /**
     * Stores the content of the $_POST superglobal variable
     * @var array
     */
    protected $post = [];

    /**
     * Stores the content of the $_GET superglobal variable
     * @var array
     */
    protected $query = [];

    /**
     * Stores the content of the $_FILES superglobal variable
     * @var array
     */
    protected $file = []
}