<?php
require_once "../classes/Database.php";
//to do: add password confirmation
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    //connection
    $database = new Database();
    $mysqli = $database->getConnection();

    //token check
    $query = "SELECT * FROM reset_tokens WHERE token = ? AND expiration >= NOW()";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $content = '
        <form id="form_reset_password" action="../reset_password_controller.php" method="post" class="d_flex flex_column px_2">
            <input type="hidden" name="token" value="' . $token . '">
            <label class="text_bold label" for="new_password">Inserisci la nuova password</label>
            <div class="password_container d_flex align_items_center">
            <input class="input" type="password" id="new_password" name="new_password" placeholder="Scrivila qui" required>
            <span class="password_toggle_icon" id="toggle_password"><i class="fa-solid fa-eye"></i></span>
            </div>
            <span class="error_message d_none" id="password_error">La password deve contenere almeno un carattere
                maiuscolo,
                uno numerico, un simbolo e deve essere lunga almeno 8 caratteri.</span>
            <button type="submit" class="input_submit">Invia</button>
        </form>
        ';
    } else {

        $content = '<p class="m_2"> Il token non è valido o è scaduto </p>';
    }
} else {

    $content = "ERRORE 404";
}
include "../partials/header.php";
?>


<main>
    <h1 class="title text_bold">Reimposta password</h1>
    <div class="box bg_white">
        <?php echo $content; ?>
    </div>
</main>


<script src="../assets/js/messageScript.js"></script>
<script src="../assets/js/passwordReset.js"></script>
<script src="../assets/js/passwordToggle/passwordToggleReset.js"></script>
</body>

</html>