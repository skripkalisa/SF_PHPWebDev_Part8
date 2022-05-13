<?php

// namespace App\Model;

class User
{
    protected static $data_file;
    protected $inventory = [];

    public function __construct()
    {
        self::$data_file = DATA . 'users.txt';
    }

    private function load()
    {
        if (file_exists(DATA . 'users.txt')) {
            $this->inventory = file(DATA . 'users.txt');
        }
    }

    public function getUsers()
    {
        $this->load();
        return $this->inventory;
    }
}
