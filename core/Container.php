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
}