<?php
require_once('Database.php');

class User
{
    private $email;
    private $password;
    private $database;
    private $connection;

    public function __construct($email, $password)
    {
        $this->email = $email;
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
        if ($this->password == $user_data['password']) {
            return "success";
        } else {
            return "password_mismatch";
        }
    }

    public function register($name, $surname)
    {

        //check if the email is already used
        $query = "SELECT * FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            // Insert user data in db
            $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssss", $name, $surname, $this->email, $this->password);

            if ($stmt->execute()) {
                return "success";
            } else {
                return "registration_error";
            }
        } else {
            return "email_already_exists";
        }
    }

    public function getMail()
    {
        return $this->email;
    }

    public function getName()
    {
        $query = "SELECT nome FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return $row['nome'];
        } else {
            return null;
        }
    }

    public function getSurname()
    {
        $query = "SELECT cognome FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            return $row['cognome'];
        } else {
            return null;
        }
    }
}
