<?php

require_once('./classes/Database.php');
require_once('./classes/User.php');

//db connection test
$database = new Database();
$query = "SELECT * FROM utenti";
$result = $database->getConnection()->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['nome'] . "<br>";
        echo "Surname: " . $row['cognome'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Password: " . $row['password'] . "<br>";
    }
} else {
    echo "Errore nella query: " . $database->getConnection()->error;
}
$database->getConnection()->close();


//user authentication test 
//user data
$email = "peppe.vignanello@gmail.com";
$password = "provaprova";

// login
$user = new User($email, $password);
$result = $user->login();

// Visualizza il risultato del login
echo $result;
