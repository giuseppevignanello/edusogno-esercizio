<?php

require_once('./classes/Database.php');

$database = new Database();
$database->connection();


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
