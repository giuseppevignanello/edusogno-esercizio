<?php
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}

$id = $_GET['id'];

include "../partials/header.php";
?>
<main>
    <h1 class="title text_bold">Modifica l'evento</h1>
    <form action="controllerCrud.php" method="post">
        <input type="hidden" name="update" value="<?php echo $id ?>">
        <div class="box bg_white d_flex flex_column px_2">
            <label class="label" for="event_name">Nome dell'evento</label>
            <input class="input" type="text" id="event_name" name="event_name">
            <label class="label" for="event_date">Data dell'evento</label>
            <input class="input" type="date" id="event_name" name="event_date">
            <label class="label" for="event_time">Orario dell'evento</label>
            <input class="input" type="time" id="event_time" name="event_time">
            <button type="submit" class="input_submit">EDIT</button>

        </div>

    </form>
</main>