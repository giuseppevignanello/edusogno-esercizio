<?php
//to do: fix password bug 
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
include "./partials/header.php";
?>


<main>
    <h1 class="title text_bold">Reimposta la tua password</h1>
    <div class="box bg_white">
        <form action="password_reset.php" method="post" class="d_flex flex_column px_2">
            <label class=" text_bold label" for="email_login">Inserisci l'e-mail</label>
            <input class="input" type="mail" id="email_reset_password" name="email_reset_password"
                placeholder="name@example.com " required>
            <button type="submit" class="input_submit">INVIA</button>
        </form>
        <p class="box_footer">Hai ricordato la tua password? <a href="index.php">ACCEDI</a></p>
    </div>
</main>
</body>

</html>