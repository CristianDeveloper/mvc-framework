<?php 

/**
 * Container - Acts like a tool for managing dependencies
 */

namespace Core;

class Container implements \ArrayAccess
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
    public function add(string $offset, $value) 
    {
        $this->items[$offset] = $value;
    }

    /**
     *  Get an item from the $items property 
     *  If the item is found, remove it from $items,
     *  store it in the $cached property
     * @param  string $offset
     * @return mixed
     */
    public function get(string $offset) 
    {
        if (isset($this->cached[$offset])) {
            return $this->cached[$offset];
        }

        if ($this->offsetExists($offset)) {
            if (is_callable($this->items[$offset])) {
                $this->cached[$offset] = call_user_func($this->items[$offset]);
            } else {
                $this->cached[$offset] = $this->items[$offset];
            }

            $this->offsetUnset($offset);

            return $this->cached[$offset];
        }
    }

    public function offsetSet($offset, $value) 
    {
        $this->add($offset, $value);
    }

    public function offsetGet($offset) 
    {
        return $this->get($offset);
    }

    public function offsetExists($offset) 
    {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset) 
    {
        if ($this->offsetExists($offset)) {
            unset($this->items[$offset]);
        }
    }
}