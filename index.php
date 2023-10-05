<?php
//to do: admin auth, bonus, add logout 
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
    <h1 class="title text_bold">Benvenuto!</h1>
    <div class="box bg_white ">
        <div class="d_flex align_items_center flex_column mt_1">
            <span>Hai già un account?</span>
            <a href="views/login.php">
                <button class="btn bg_edit">ACCEDI</button>
            </a>
        </div>
        <div class="d_flex align_items_center flex_column mt_1 mb_1">
            <span>Non hai ancora un account?</span>
            <a href="views/register.php">
                <button class="btn bg_edit">REGISTRATI</button>
            </a>
        </div>
    </div>
</main>
</body>

</html>