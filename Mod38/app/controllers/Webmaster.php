<?php

namespace App\controllers;

class Webmaster extends \App\core\Controller
{
    public function index()
    {
        $this->_view->generate('webmaster.phtml', 'template.phtml');
    }

    public function show($id)
    {
        $this->_view->generate('webmaster.phtml', 'template.phtml');
    }
}
