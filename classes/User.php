<?php
require_once('Database.php');

class User
{
    private $email;
    private $password;
    private $database;
    private $connection;

    public function __construct($mail, $password)
    {
        $this->email = $mail;
        $this->password = $password;
        $this->database = new Database();
        $this->connection = $this->database->getConnection();
    }

    public function login()
    {
        $query = "SELECT * FROM utenti WHERE email = ? AND password = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ss", $this->email, $this->password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            return "success";
        } else {
            return "failure";
        }
    }
}
