<?php 

/**
 * Request class - Acts like a very simple representation of the HTTP Request
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
    protected $files = [];

    /**
     * Load class dependencies
     */
    public function __construct()
    {
        $this->createFromGlobals();
    }

    /**
     * Create a simple representation of the HTTP request
     * @return [type] [description]
     */
    protected function createFromGlobals()
    {
        $this->server = $_SERVER;
        $this->post = $_POST;
        $this->query = $_GET;
        $this->files = $_FILES;
    }
}