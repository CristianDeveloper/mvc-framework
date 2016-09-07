<?php 

namespace App\Controllers;

class HomeController extends Controller
{
    public function home()
    {
        $this->container['name'] = 'cata';

        return $this->name;
    }
}