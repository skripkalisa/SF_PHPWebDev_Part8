<?php

class ErrorController extends Controller
{
    public function index()
    {
        $this->view->generate('error.phtml', 'template.phtml');
    }
}
