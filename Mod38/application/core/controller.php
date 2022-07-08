<?php
class Controller
{
    public $model;
    public $view;
    // public $entity;

    public function __construct($entity = null)
    {
        $this->view = new View();
        $this->model = new Model($entity);
    }
    public function action_index()
    {
    }
    public function action_show($id)
    {
    }
    public function action_edit($id)
    {
    }
    public function action_delete($id)
    {
    }
}
