<?php
//TODO: add expiration on token 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


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

            // Store the token in databes
            $query = "INSERT INTO reset_tokens (user_email, token) VALUES (?, ?)";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ss", $userEmail, $token);
            $stmt->execute();

            $env = parse_ini_file('.env');
            $SMTP_USER = $env['SMTP_USER'];
            $SMTP_PASS = $env['SMTP_PASS'];

            // Send the mail for the password reset

            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 2;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = $SMTP_USER;
                $mail->Password =  $SMTP_PASS;                 //Set the SMTP server to send through
                $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress($userEmail);     //Add a recipient


                //Content                                 //Set email format to HTML
                $mail->Subject = 'Recupero Password';
                $reset_link = "http://localhost/edusogno-esercizio/reset_password.php?token=" . $token;
                $message = "Clicca sul seguente link per reimpostare la tua password: $reset_link";
                $mail->Body    = $message;

                $mail->send();
                $_SESSION['message'] = "Il codice di recupero è stato inviato al tuo indirizzo mail";
                header("Location: views/login.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $_SESSION['message'] = "L'indirizzo email non è registrato";
            header("Location: views/password_reset_form.php");
        }
    } else {
        $_SESSION['message'] = "Inserisci un indirizzo mail!";
        header("Location: views/password_reset_form.php");
    }
}
