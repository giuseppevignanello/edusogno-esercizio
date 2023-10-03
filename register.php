<?php
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
            <input type="text" id="name_input_register" type="text" name="name_register" required>
            <label for="surname_input_register">Inserisci il
                cognome</label>
            <input type="text" id="surname_input_register" type="text" name="surname_register" required>
            <label for="mail_input_register">Inserisci la
                mail</label>
            <input type="mail" id="mail_input_register" type="mail" name="email_register" required>
            <label for="password_input_register">Inserisci
                la
                password</label>
            <input type="password" id="password_input_register" type="password" name="password_register" required>
            <button type="submit">Submit</button>

        </form>

    </div>
</main>

</body>

</html>