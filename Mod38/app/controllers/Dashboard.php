<?php

namespace App\controllers;

use App\core;

class Dashboard extends core\Controller implements core\ICrudController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->generate('dashboard/index.phtml', 'template.phtml');
    }

    public function create($payload = null)
    {
        $this->_view->generate('dashboard/index.phtml', 'template.phtml', $payload);
    }

    public function show($payload = null)
    {
        $this->_view->generate('dashboard/index.phtml', 'template.phtml', $payload);
    }

    public function edit($payload = null)
    {
        $this->_view->generate('dashboard/index.phtml', 'template.phtml', $payload);
    }

    public function delete($payload = null)
    {
        $this->_view->generate('dashboard/index.phtml', 'template.phtml', $payload);
    }


    public function getById($id = null)
    {
        return $id;
    }

    public function getByName($name = null)
    {
        return $name;
    }

    public function validate(array $payload = null)
    {
        $this->_view->generate('dashboard/utils/handler.php', '../dashboard/utils/handler.php', $payload);

       
        return $payload;
    }
}
