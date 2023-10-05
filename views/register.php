<?php
session_start();
//This could be in a partials
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
include "../partials/header.php";
?>
<main>
    <h1 class="title text_bold">Crea il tuo account</h1>
    <div class="box bg_white">
        <form id="form_register" action="../auth/register_auth.php" method="post" class="d_flex flex_column px_2">
            <label for="name_input_register" class=" text_bold label">Inserisci il
                nome</label>
            <input class="input" id="name_input_register" type="text" name="name_register" required>
            <span class="error_message d_none" id="name_error">Il nome deve essere tra 3 e 15 caratteri.</span>
            <label for="surname_input_register" class=" text_bold label">Inserisci il
                cognome</label>
            <input class="input" id="surname_input_register" type="text" name="surname_register" required>
            <span class="error_message d_none" id="surname_error">Il cognome deve essere tra 3 e 15 caratteri.</span>
            <label for="mail_input_register" class=" text_bold label">Inserisci la
                mail</label>

            <input class="input" id="mail_input_register" type="mail" name="email_register" required>
            <span class="error_message d_none" id="mail_error">Inserisci un indirizzo mail valido</span>
            <label for="password_input_register" class=" text_bold label">Inserisci
                la
                password</label>
            <div class="password_container d_flex align_items_center">
                <input class="input" id="password_input_register" type="password" name="password_register" required>
                <span class="password_toggle_icon" id="toggle_password"><i class="fa-solid fa-eye"></i></span>
            </div>
            <span class="error_message d_none" id="password_error">La password deve contenere almeno un carattere
                maiuscolo,
                uno numerico, un simbolo e deve essere lunga almeno 8 caratteri.</span>
            <button type="submit" class="input_submit">REGISTRATI</button>

        </form>
        <p class="box_footer">Hai già un account? <a href="login.php">Accedi</a></p>

    </div>
</main>


<script src="../assets/js/messageScript.js"></script>
<script src="../assets/js/registerValidation.js"></script>
<script src="../assets/js/passwordToggle.js"></script>
</body>

</html>