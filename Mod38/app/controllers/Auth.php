<?php

namespace App\controllers;

class Auth extends \App\core\Controller implements \App\core\IAuthController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_view->generate('error.phtml', 'template.phtml');
    }

    public function register()
    {
        $this->_view->generate('auth/register.phtml', 'template.phtml');
    }

    public function login()
    {
        $this->_view->generate('auth/login.phtml', 'template.phtml');
    }

    public function success()
    {
        $this->_view->generate('auth/success.phtml', 'template.phtml');
    }

    public function validate()
    {
        $this->_view->generate('auth/utils/handler.php', '../auth/utils/handler.php');
    }

    public function logout()
    {
        $this->_view->generate('auth/logout.phtml', 'template.phtml');
    }
}
