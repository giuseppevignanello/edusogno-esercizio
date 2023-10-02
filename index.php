<?php
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,500;9..40,700&display=swap" rel="stylesheet">
    <title>Edusogno-Login</title>
</head>

<body>
    <header class="app_header bg_white d_flex align_items_center">
        <div class="logo">
            <img src="https://edusogno.com/logo-black.svg" alt="">
        </div>
    </header>

    <div>
        <?php echo $message ?>
    </div>

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