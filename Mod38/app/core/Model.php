<?php

namespace App\core;

class Model
{
    private $_entity;

    public function __construct($entity = null)
    {
        $this->_entity = $entity;
    }

    public function getData()
    {
        return 'Model';
    }

    public function getEntity()
    {
        return $this->entity;
    }
}
