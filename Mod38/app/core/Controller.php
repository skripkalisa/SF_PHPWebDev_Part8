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
    public function create($data);

    public function show($data);

    public function edit($data);

    public function delete($id);
    
    public function getById($id);

    public function getByName($name);
}

class Controller implements IController
{
    protected $_model;
    protected $_view;
    protected $_entity;
    protected $_sessionToken;

    public function __construct($entity = null)
    {
        // var_dump($_SESSION);
        isset($_SESSION['token']) ? $this->_sessionToken = $_SESSION['token'] : $this->_sessionToken = null;

        $this->_entity = $entity;
        $this->_view = new View();
        $this->_model = new Model($this->_entity);
    }

    public function index()
    {
    }
}
