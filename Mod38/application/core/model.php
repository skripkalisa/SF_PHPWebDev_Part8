<?php
class Model
{
    private $string;
    private $entity;

    public function __construct($entity = null)
    {
        $this->string = "MVC + PHP = Awesome!";
        $this->entity = $entity;
    }
    public function getData()
    {
        return $this->string;
    }
    public function getEntity()
    {
        return $this->entity;
    }
}
