<?php

//The Admin is now a special type of User, with a isAdmin column on true. There could be a class Admin that extend User to handle the Admin login and protect the dashboard view

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

        <!-- delete modal -->
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
    <div class="d_flex justify_content_center">
        <button id="logoutButton" class="btn bg_edit">Logout</button>
    </div>
    <!-- logout modal -->
    <div id="logoutModal" class="modal" method="post">
        <form action="../auth/logout_auth.php" method="post">
            <div class="modal-content">
                <h2>Conferma Logout</h2>
                <p>Sei sicuro di voler effettuare il logout?</p>
                <div class="d_flex justify_content_around">
                    <button id="confirmLogout" class="modal_button">Conferma</button>
                    <div id="cancelLogout" class="modal_button">Annulla</div>
                </div>
            </div>
        </form>
    </div>
</main>

<script src="../assets/js/modalLogic.js"></script>
<script src="../assets/js/modalLogoutLogic.js"></script>
<script src="../assets/js/messageScript.js"></script>
</body>

</html>