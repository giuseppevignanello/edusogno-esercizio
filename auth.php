<?php
require_once('./classes/User.php');
session_start();

//check if there are a mail and a password on the login input fields
if (isset($_POST['email_login']) && isset($_POST['password_login'])) {
    //take the user data
    $email = $_POST['email_login'];
    $password = $_POST['password_login'];

    //initialize a user object
    $user = new User($email, $password);
    $login = $user->login();

    if ($login == "success") {
        $_SESSION['message'] = "Login effettuato con successo!";
        header("Location: dashboard.php");
    } elseif ($login == "email_not_found") {
        $_SESSION['message'] = "Email non trovata!";
        header("Location: index.php");
    } elseif ($login == "password_mismatch") {
        $_SESSION['message'] = "Password errata";
        header("Location: index.php");
    }
} else {
    $_SESSION['message'] = "Dati mancanti!";
    header("Location: index.php");
}
