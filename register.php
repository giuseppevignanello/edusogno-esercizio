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
    <div class="register_box">
        <form action="register_auth.php" method="post">
            <label for="name_input_register">Inserisci il
                nome</label>
            <input id="name_input_register" type="text" name="name_register">
            <label for="surname_input_register">Inserisci il
                cognome</label>
            <input id="surname_input_register" type="text" name="surname_register">
            <label for="mail_input_register">Inserisci la
                mail</label>
            <input id="mail_input_register" type="mail" name="email_register">
            <label for="password_input_register">Inserisci
                la
                password</label>
            <input id="password_input_register" type="password" name="password_register">
            <button type="submit">Submit</button>

        </form>

    </div>
</main>

</body>

</html>