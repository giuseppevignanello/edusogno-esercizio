<?php
require_once "./classes/User.php";
require_once "./classes/Database.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['token']) && !empty($_POST['new_password'])) {
        $token = $_POST['token'];
        $newPassword = $_POST['new_password'];

        // db connection
        $database = new Database();
        $mysqli = $database->getConnection();

        // token check
        $query = "SELECT * FROM reset_tokens WHERE token = ?";
        $stmt_select = $mysqli->prepare($query);
        $stmt_select->bind_param("s", $token);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $userEmail = $row['user_email'];


            $update_query = "UPDATE utenti SET password = ? WHERE email = ?";
            $stmt_update = $mysqli->prepare($update_query);
            $stmt_update->bind_param("ss", $newPassword, $userEmail);

            if ($stmt_update->execute()) {
                // delete the token 
                $delete_query = "DELETE FROM reset_tokens WHERE token = ?";
                $stmt_delete = $mysqli->prepare($delete_query);
                $stmt_delete->bind_param("s", $token);
                $stmt_delete->execute();

                $_SESSION['message'] = "Password reimpostata con successo!";
                header("Location: views/login.php");
            } else {
                $_SESSION['message'] = "Errore durante l'aggiornamento della password...";
                header("Location: views/reset_password.php?token=" . $token);
            }
        } else {
            $_SESSION['message'] = "Token non valido o scaduto...";
            header("Location: views/reset_password.php?token=" . $token);
        }
    } else {
        $_SESSION['message'] = "Dati mancanti...";
        header("Location: views/reset_password.php?token=" . $token);
    }
} else {
    header("Location: views/reset_password.php");
}
