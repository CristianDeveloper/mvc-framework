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

    /**
     * Return an item from the $server property
     * @param  string $offset
     * @return mixed
     */
    public function get(string $offset)
    {
        if (isset($this->server[$offset])) {
            return $this->server[$offset];
        }
    }

    /**
     * Return the current HTTP method
     * @return string
     */
    public function getMethod()
    {
        return $this->get('REQUEST_METHOD');
    }

    /**
     * Return the request URI without the query string
     * @return string
     */
    public function getUri()
    {
        return str_replace('?' . $this->get('QUERY_STRING'), '', $this->get('REQUEST_URI'));
    }

    /**
     * Returns the URL protocol used
     * @return string
     */
    public function getProtocol()
    {
        $protocol = $this->get('HTTPS');

        return isset($protocol) ? $protocol : "http";
    }

    /**
     * Get the URL hostname
     * @return string
     */
    public function getHost()
    {
        return $this->get('HTTP_HOST');
    }

    /**
     * Return an item from the $query property
     * @param  string $offset 
     * @return mixed
     */
    public function query(string $offset)
    {
        if (isset($this->query[$offset])) {
            return $this->query[$offset];
        }
    }

    /**
     * Return an item from the $post property
     * @param  string $offset 
     * @return mixed
     */
    public function post(string $offset)
    {
        if (isset($this->post[$offset])) {
            return $this->post[$offset];
        }
    }

    /**
     * Return the entire content of the $files property
     * @return array
     */
    public function files()
    {
        return $this->files;
    }

}