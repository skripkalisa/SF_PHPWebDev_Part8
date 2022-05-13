<?php

// namespace App\Core;

class View
{
    protected $view_file;
    protected $view_data;

    public function __construct($view_file, $view_data)
    {
        $this->view_file = $view_file;
        $this->view_data = $view_data;
    }

    public function render()
    {
        $path = VIEW . $this->view_file . '.phtml';
        // print_r($path);
        if (file_exists($path)) {
            include_once($path);
        }
    }
    public function getAction()
    {
        return (explode(DIRECTORY_SEPARATOR, $this->view_file)[1]);
    }
}
