<?php include "./partials/header.php";
//to do: fix password bug 
?>
<main>
    <h1 class="login_title text_bold">Hai già un account?</h1>
    <div class="login_box bg_white">
        <form action="auth.php" method="post" class="d_flex flex_column px_2">
            <label class=" text_bold login_label" for="email_login">Inserisci l'e-mail</label>
            <input class="login_input" type="mail" id="email_login" name="email_login" placeholder="name@example.com " required>

            <label class="text_bold login_label" for="password_login">Inserisci la password</label>
            <input class="login_input" type="password" id="password_login" name="password_login" placeholder="Scrivila qui" required>
            <button type="submit" class="input_submit">ACCEDI</button>
        </form>
        <p class="box_footer">Non hai ancora un profilo? <a href="register.php">Register</a></p>
    </div>
    <a href="Tester.php">tester</a>
</main>
</body>

</html>