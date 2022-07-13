<?php

namespace App\controllers;

use App\core;

class Home extends core\Controller
{
    public function index()
    {
        $this->_view->generate('home.phtml', 'template.phtml');
    }

    public function profile()
    {
        $this->_view->generate('profile.phtml', 'template.phtml');
    }
}
