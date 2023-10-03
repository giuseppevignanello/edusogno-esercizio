<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./classes/User.php');
require_once('./classes/Database.php');
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['email_reset_password'])) {
        $userEmail = $_POST['email_reset_password'];
        //Check if the mail exist in db
        $user = new User($userEmail, "test");

        $emailExists = $user->checkIfEmailExists();

        if ($emailExists) {
            //database connection
            $database = new Database();
            $mysqli = $database->getConnection();
            //generate a random token 
            $token = bin2hex(random_bytes(32));

            // Store the token in databes
            $query = "INSERT INTO reset_tokens (user_email, token) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ss", $userEmail, $token);
            $stmt->execute();

            // Send the mail for the password reset
            $to = $userEmail;
            $subject = "Reimposta Password";
            $reset_link = "http://localhost/edusogno-esercizio/reset_password.php?token=" . $token;
            $headers = "From: peppe.vignanello@gmail.com";
            $message = "Clicca sul seguente link per reimpostare la tua password: $reset_link";
            mail($to, $subject, $message, $headers);

            $_SESSION['message'] = "è stata inviata una mail al tuo indirizzo";
            header("Location: index.php");
        } else {
            $_SESSION['message'] = "L'indirizzo email non è registrato";
            header("Location: password_reset_form.php");
        }
    } else {
        $_SESSION['message'] = "Inserisci un indirizzo mail!";
        header("Location: password_reset_form.php");
    }
}
