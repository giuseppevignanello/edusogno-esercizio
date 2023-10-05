<?php
//to do: fix password bug 
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
include "../partials/header.php";
?>


<main>
    <h1 class="title text_bold">Hai già un account?</h1>
    <h5 class="mb_1 text_center">Con le giuste credenziali l'admin può accedere alla dashboard anche da qui</h5>
    <div class="box bg_white">
        <form id="formLogin" action="../auth/login_auth.php" method="post" class="d_flex flex_column px_2">
            <label class=" text_bold label" for="email_login">Inserisci l'e-mail</label>
            <input class="input" type="mail" id="email_login" name="email_login" placeholder="name@example.com ">
            <span class="error_message d_none" id="email_login_error">Mail non valida</span>
            <label class="text_bold label" for="password_login">Inserisci la password</label>
            <div class="password_container d_flex align_items_center">
                <input class="input" type="password" id="password_login" name="password_login"
                    placeholder="Scrivila qui">
                <span class="password_toggle_icon" id="toggle_password"><i class="fa-solid fa-eye"></i></span>
            </div>
            <span class="error_message d_none" id="password_login_error">Password non valida</span>

            <button type="submit" class="input_submit">ACCEDI</button>
        </form>
        <p class="box_footer">Non hai ancora un profilo? <a href="register.php">Registrati</a> <br>
            Hai dimenticato la password? <a href="password_reset_form.php">Reimposta password</a></p>
    </div>
</main>

<script src="../assets/js/messageScript.js"></script>
<script src="../assets/js/passwordToggle.js"></script>
<!-- <script src="../assets/js/loginValidation.js"></script> -->
</body>

</html>