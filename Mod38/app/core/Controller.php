<?php

namespace App\core;

interface IController
{
    public function index();
}
interface IAuthController
{
    public function register();

    public function login();

    public function logout();
}

interface ICrudController
{
    public function show($id);

    public function edit($id);

    public function delete($id);

    public function getById($id);

    public function getByName($name);
}

class Controller implements IController
{
    protected $_model;
    protected $_view;
    protected $_entity;

    public function __construct($entity = null)
    {
        $this->_entity = $entity;
        $this->_view = new View();
        $this->_model = new Model($this->_entity);
    }

    public function index()
    {
    }
}
