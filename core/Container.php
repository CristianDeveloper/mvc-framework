<?php 

/**
 * Container - Acts like a tool for managing dependencies
 */

namespace Core;

class Container
{
    /**
     * All dependencies are stored in this property
     * @var array
     */
    protected $items = [];

    /**
     * Already called dependencies are stored in this property
     * @var array
     */
    protected $cached = [];

    /**
     *  Add a new item in the $items property
     * @param string $offset
     * @param mixed $value
     */
    public function add(string $offset, $value) {}

    /**
     *  Get an item from the $items property 
     *  If the item is found, cache that item and store it in the $cached property
     * @param  string $offset
     * @return mixed
     */
    public function get(string $offset) {}
}