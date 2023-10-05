<?php
require_once('../classes/User.php');
session_start();
//check if there are data on the login input fields
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (checkNameAndSurname($_POST['name_register'], $_POST['surname_register'])  && checkEmail($_POST['email_register']) && checkPassword($_POST['password_register'])) {
        $name = $_POST['name_register'];
        $surname = $_POST['surname_register'];
        $email = $_POST['email_register'];
        $password = $_POST['password_register'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $_SESSION['user_email'] = $email;
        $_SESSION['user_password'] = $password;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;

        $user = new User($email, $hashedPassword);
        $registation = $user->register($name, $surname);

        if ($registation == "success") {
            $_SESSION['message'] = "Registrazione effettuata con successo!";
            header("Location: ../views/personalPage.php");
        } elseif ($registation == "email_already_exists") {
            $_SESSION['message'] = "L'indirizzo mail è già utilizzato...";
            header("Location: ../views/register.php");
        } elseif ($registation == "registration_error") {
            $_SESSION['message'] = "C'è stato un'errore durante la registrazione, riprova più tardi...";
            header("Location: ../views/register.php");
        }
    } else {
        //$_SESSION['message'] = "Dati mancanti...";
        header("Location: ../views/register.php");
    }
}

function checkNameAndSurname($name, $surname)
{
    $validator = true;
    if (empty($name)) {
        $_SESSION['message'] = "Nome mancante...";
        $validator = false;
    } else if (strlen($name) < 3 || strlen($name) > 20) {
        $_SESSION['message'] = "Formato del nome non valido";
        $validator = false;
    } else if (empty($surname)) {
        $_SESSION['message'] = "Cognome mancante...";
        $validator = false;
    } else if (strlen($surname) < 3 || strlen($surname) > 20) {
        $_SESSION['message'] = "Formato del cognome non valido";
        $validator = false;
    }

    return $validator;
}

function checkEmail($emailLogin)
{

    if (empty($emailLogin)) {
        $_SESSION['message'] = "Mail mancante...";
        return false;
    } else if (!filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Formato della mail non valido...";
        return false;
    } else {
        return true;
    }
}

function checkPassword($passwordLogin)
{
    $passwordPattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?['#?!@$%^&*-]).{8,}$/";

    if (empty($passwordLogin)) {
        $_SESSION['message'] = "Password mancante...";
        return false;
    } else if (!preg_match($passwordPattern, $passwordLogin)) {
        $_SESSION['message'] = "Formato della password non valido...";
    } else {
        return true;
    }
}
