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
    $query = "SELECT * FROM reset_tokens WHERE token = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $content = '
        <form action="../reset_password_controller.php" method="post" class="d_flex flex_column px_2">
            <input type="hidden" name="token" value="' . $token . '">
            <label class="text_bold label" for="new_password">Inserisci la nuova password</label>
            <input class="input" type="password" id="new_password" name="new_password" placeholder="Scrivila qui" required>
            <button type="submit" class="input_submit">Invia</button>
        </form>
        ';
    } else {

        $content = '<p class="m_2"> Il token non è valido </p>';
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
</body>

</html>