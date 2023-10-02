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
        //email check
        $query = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        //if there are not result
        if ($result->num_rows === 0) {
            return "email_not_found";
        }

        $user_data = $result->fetch_assoc();


        //check the password
        // If the password had been hashed I would have used password_verify 
        if ($this->password = $user_data['password']) {
            return "success";
        } else {
            return "password_mismatch";
        }
    }
}
