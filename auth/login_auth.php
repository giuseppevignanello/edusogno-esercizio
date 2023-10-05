<?php
require_once('../classes/User.php');
session_start();

//check if there are a mail and a password on the login input fields
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email_login']) && !empty($_POST['password_login'])) {
        //take the user data
        $email = $_POST['email_login'];
        $password = $_POST['password_login'];
        $_SESSION['user_email'] = $email;
        //$_SESSION['user_password'] = $password;

        //initialize a user object
        $user = new User($email, $password);
        $login = $user->login();

        if ($login == "success") {

            if ($user->isAdmin()) {
                $_SESSION['message'] = "Login effettuato con successo!";
                header("Location: ../views/dashboard.php");
            } else {
                $_SESSION['message'] = "Login effettuato con successo!";
                header("Location: ../views/personalPage.php");
            }
        } elseif ($login == "email_not_found") {
            $_SESSION['message'] = "Email non trovata...";
            header("Location: ../views/login.php");
        } elseif ($login == "password_mismatch") {
            $_SESSION['message'] = "Password errata...";
            header("Location: ../views/login.php");
        }
    } else {
        $_SESSION['message'] = "Dati mancanti...";
        header("Location: ../views/login.php");
    }
}
