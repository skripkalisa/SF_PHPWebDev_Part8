<?php

namespace App\controllers;

class Merchant extends \App\core\Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        // $data = $this->model->getEntity()->getData();
        $this->_view->generate('merchant.phtml', 'template.phtml');
    }

    public function show($id = null)
    {
        // $data = $this->model->getEntity()->getData();
        $this->_view->generate('merchant.phtml', 'template.phtml');
    }
}
