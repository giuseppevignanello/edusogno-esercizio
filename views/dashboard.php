<?php
require_once "../classes/Database.php";
require_once "../classes/EventController.php";
require_once "../classes/Event.php";
//This could be in a partials
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}
$eventController = new EventController;
$events = $eventController->getAllEvents();

include "../partials/header.php";
?>

<main>
    <h1 class="title text_bold">Tutti gli eventi esistenti</h1>
    <form action="../crud/controllerCrud.php" method="post">
        <div class="d_flex justify_content_center">
            <button class="btn bg_green text-center" type="submit" name="add_event"> AGGIUNGI UN NUOVO EVENTO</button>
        </div>
        <div class="d_flex mx_2 flex_wrap justify_content_center flex_sm_events">
            <?php
            foreach ($events as $event_item) {
                echo '<div class="event box bg_white">';
                echo '<div class="event_text">';
                echo '<h2>' . $event_item->getEventName() . '</h2>';
                echo '<span class="hour_date">' . $event_item->getEventDate() . '</span>';
                echo '</div>';
                echo '<div class="d_flex justify_content_around mb_1">';
                echo '<button class="btn bg_edit" name="edit_event" value="' .
                    $event_item->getId() .
                    '">MODIFICA</button>';
                echo '<button type="button" class="delete btn bg_delete" data-event-id="' .
                    $event_item->getId() .
                    '">ELIMINA</button>';
                echo '</div>';
                echo '</div>';
            }
            ?>

        </div>
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Conferma Eliminazione</h2>
                <p>Sei sicuro di voler eliminare questo evento?</p>
                <div class="d_flex justify_content_around">
                    <button class="modal_button" id="confirmDelete" name="delete_event">Conferma</button>
                    <div class="modal_button" id="cancelDelete">Annulla</div>
                </div>
            </div>
        </div>
    </form>
</main>

<script src="../assets/js/modalLogic.js"></script>
<script src="../assets/js/messageScript.js"></script>
</body>

</html>