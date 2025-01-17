<?php

require_once __DIR__ . "../../config.php";
class Database
{

    //db data
    private $server;
    private $username;
    private $password;
    private $name;
    private $conn;


    public function __construct()
    {
        //take db data from config
        global $dbConfig;
        $this->server = $dbConfig['dbServer'];
        $this->username = $dbConfig['dbUsername'];
        $this->password = $dbConfig['dbPassword'];
        $this->name = $dbConfig['dbName'];

        //establish the db connection
        $this->connection();
    }

    public function connection()
    {
        //new connection
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->name);

        //try the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
