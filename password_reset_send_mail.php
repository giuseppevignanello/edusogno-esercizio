<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
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

            //calculate 1 hour of expiration (Result 1 hour back, so I have to add 3 hours to add one)
            $expiration = date('Y-m-d H:i:s', strtotime('+3 hour'));

            // Store the token in databes
            $query = "INSERT INTO reset_tokens (user_email, token, expiration) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("sss", $userEmail, $token, $expiration);
            $stmt->execute();

            $env = parse_ini_file('.env');
            $SMTP_USER = $env['SMTP_USER'];
            $SMTP_PASS = $env['SMTP_PASS'];

            // Send the mail for the password reset

            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 2;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = $SMTP_USER;
                $mail->Password =  $SMTP_PASS;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress($userEmail);
                $mail->Subject = 'Recupero Password';
                $reset_link = "http://localhost/edusogno-esercizio/views/reset_password.php?token=" . $token;
                $message = "Clicca sul seguente link per reimpostare la tua password: $reset_link";
                $mail->Body    = $message;
                $mail->send();
                $_SESSION['message'] = "Il link per il recupero è stato inviato al tuo indirizzo mail!";
                header("Location: views/login.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $_SESSION['message'] = "L'indirizzo email non è registrato...";
            header("Location: views/password_reset_form.php");
        }
    } else {
        $_SESSION['message'] = "Inserisci un indirizzo mail...";
        header("Location: views/password_reset_form.php");
    }
}
