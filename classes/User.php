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
        if (password_verify($this->password, $user_data['password'])) {
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

    public function checkIfEmailExists()
    {

        $query = "SELECT COUNT(*) as count FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserEvents($userEmail)
    {
        $conn = $this->database->getConnection();

        //this method is partially exposed to injections

        $query = "SELECT * FROM eventi WHERE FIND_IN_SET('$userEmail', attendees)";
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }

        $events = array();

        while ($row = $result->fetch_assoc()) {
            $event = new stdClass();
            $event->id = $row['id'];
            $event->nome_evento = $row['nome_evento'];
            $event->data_evento = $row['data_evento'];

            $events[] = $event;
        }

        return $events;
    }

    public function isAdmin()
    {
        $query = "SELECT isAdmin FROM utenti WHERE email = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return false;
        }

        $userData = $result->fetch_assoc();

        return $userData['isAdmin'];
    }
}
