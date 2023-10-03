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
    <h1 class="title text_bold">Tutti gli eventi esistenti</h1>
    <div class="box bg_white">

    </div>
</main>