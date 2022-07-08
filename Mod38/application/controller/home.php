<?php
require_once CORE . "controller.php";


class HomeController extends Controller
{
    public function index()
    {
        $this->view->generate('home.phtml', 'template.phtml');
    }
}
