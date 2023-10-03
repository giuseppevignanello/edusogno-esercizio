<?php
require_once('./classes/User.php');
session_start();
//check if there are data on the login input fields
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name_register']) && !empty($_POST['surname_register']) && !empty($_POST['email_register']) && !empty($_POST['password_register'])) {
        $name = $_POST['name_register'];
        $surname = $_POST['surname_register'];
        $email = $_POST['email_register'];
        $password = $_POST['password_register'];
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $password;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;

        $user = new User($email, $password);
        $registation = $user->register($name, $surname);

        if ($registation == "success") {
            $_SESSION['message'] = "Registrazione effettuata con successo!";
            header("Location: personalPage.php");
        } elseif ($registation == "email_already_exists") {
            $_SESSION['message'] = "L'indirizzo mail è già utilizzato";
            header("Location: register.php");
        } elseif ($registation == "registration_error") {
            $_SESSION['message'] = "C'è stato un'errore durante la registrazione, riprova più tardi";
            header("Location: register.php");
        }
    } else {
        $_SESSION['message'] = "Dati mancanti!";
        header("Location: register.php");
    }
}
