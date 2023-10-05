<?php

session_start();
include "../partials/message.php";
include "../partials/header.php";
?>


<main>
    <h1 class="title text_bold">Reimposta la tua password</h1>
    <div class="box bg_white">
        <form id="form_reset_password_mail" action="../password_reset_send_mail.php" method="post" class="d_flex flex_column px_2">
            <label class=" text_bold label" for="email_login">Inserisci l'e-mail</label>
            <input class="input" type="mail" id="email_reset_password" name="email_reset_password" placeholder="name@example.com " required>
            <span class="error_message d_none" id="mail_error">Inserisci un indirizzo mail valido</span>
            <button type="submit" class="input_submit">INVIA</button>
        </form>
        <p class="box_footer">Hai ricordato la tua password? <a href="login.php">ACCEDI</a></p>
    </div>
</main>

<script src="../assets/js/messageScript.js"></script>
<script src="../assets/js/passwordResetMail.js"></script>
</body>

</html>