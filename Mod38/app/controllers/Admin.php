<?php

namespace App\controllers;

class Admin extends \App\core\Controller
{
    public function index()
    {
        $this->_view->generate('admin.phtml', 'template.phtml');
    }
}
