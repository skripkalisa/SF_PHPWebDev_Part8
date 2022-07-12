<?php

namespace App\controllers;

class Home extends \App\core\Controller
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
