<?php

class Service extends Model
{
    protected static $data_file;
    protected $inventory = [];

    public function __construct()
    {
        self::$data_file = DATA . 'list.txt';
    }

    private function load()
    {
        if (file_exists(self::$data_file)) {
            $this->inventory = file(self::$data_file);
        }
    }

    public function get_data()
    {
        $this->load();
        // var_dump($this->inventory);
        return $this->inventory;
    }
}
