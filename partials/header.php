<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/edusogno-esercizio/assets/styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,500;9..40,700&display=swap"
        rel="stylesheet">
    <script src="/edusogno-esercizio/assets/js/script.js"></script>
    <title>Edusogno-Login</title>
</head>

<body>
    <header class="app_header bg_white d_flex align_items_center">
        <div class="logo">
            <img src="https://edusogno.com/logo-black.svg" alt="">
        </div>
    </header>

    <?php if (!empty($message)) : ?>
    <span id="message_header" class="message">
        <?php echo $message; ?>
    </span>
    <?php endif; ?>