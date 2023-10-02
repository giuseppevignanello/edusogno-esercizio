<?php

class User
{
    private $database;


    public function __construct()
    {
        $this->database = new Database();
    }
}
