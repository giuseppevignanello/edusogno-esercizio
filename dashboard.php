<?php
require_once "./classes/Database.php";
require_once "./classes/EventController.php";
require_once "./classes/Event.php";
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
$eventController = new EventController;
$events = $eventController->getAllEvents();


include "./partials/header.php";
?>

<main>
    <h1 class="title text_bold">Tutti gli eventi esistenti</h1>
    <form action="crud/controllerCrud.php" method="post">
        <div class="d_flex justify_content_center">
            <button class="btn bg_green text-center" type="submit" name="add_event"> AGGIUNGI UN NUOVO EVENTO</button>
        </div>
        <div class="d_flex mx_2 flex_wrap justify_content_center">
            <?php
            foreach ($events as $event_item) {
                echo '<div class="event box bg_white">';
                echo '<div class="event_text">';
                echo '<h2>' . $event_item->getEventName() . '</h2>';
                echo '<span class="hour_date">' . $event_item->getEventDate() . '</span>';
                echo '</div>';
                echo '<div class="d_flex justify_content_around mb_1">';
                echo '<button class="btn bg_edit" name="edit_event" value="';
                echo $event_item->getId();
                echo '">MODIFICA</button>';
                echo '<button class="btn bg_delete" name="delete_event" value="';
                echo $event_item->getId();
                echo '">ELIMINA</button>';
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>
    </form>
</main>