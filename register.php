<?php
session_start();
//This could be in a partials
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
include "./partials/header.php";
?>
<main>
    <h1 class="title text_bold">Crea il tuo account</h1>
    <div class="box bg_white">
        <form action="register_auth.php" method="post" class="d_flex flex_column px_2">
            <label for="name_input_register" class=" text_bold label">Inserisci il
                nome</label>
            <input class="input" id="name_input_register" type="text" name="name_register">
            <label for="surname_input_register" class=" text_bold label">Inserisci il
                cognome</label>
            <input class="input" id="surname_input_register" type="text" name="surname_register">
            <label for="mail_input_register" class=" text_bold label">Inserisci la
                mail</label>
            <input class="input" id="mail_input_register" type="mail" name="email_register">
            <label for="password_input_register" class=" text_bold label">Inserisci
                la
                password</label>
            <input class="input" id="password_input_register" type="password" name="password_register">
            <button type="submit" class="input_submit">REGISTRATIt</button>

        </form>
        <p class="box_footer">Hai già un account? <a href="index.php">Accedi</a></p>

    </div>
</main>

</body>

</html>