<?php

namespace App\controllers;

class Error extends \App\core\Controller
{
    public function index()
    {
        $this->_view->generate('error.phtml', 'template.phtml');
    }
}
