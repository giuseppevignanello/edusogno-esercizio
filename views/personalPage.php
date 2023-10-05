<?php
session_start();
require_once "../classes/User.php";
require_once "../classes/Database.php";

include "../partials/message.php";

$user = new User($_SESSION['user_email'], $_SESSION['user_password']);
$database = new Database();

$userEmail = $user->getMail();
$events = $user->getUserEvents($userEmail);

$userName = $user->getName();
$userSurname = $user->getSurname();

//HTML Header
include "../partials/header.php";
?>
<h1 class="title text_bold">Ciao <?php echo ($userName . ' ' . $userSurname) ?> ecco i tuoi eventi</h1>
<div class="d_flex justify_content_center mt_1 mb_1">
    <button id="logoutButton" class="btn bg_edit">Logout</button>
</div>
<?php
foreach ($events as $event_item) {

    echo '<div class="box bg_white">';
    echo '<div class="event_text">';
    echo '<h2>' . $event_item->nome_evento . '</h2>';
    echo '<span class="hour_date">' . $event_item->data_evento . '</span>';
    echo '</div>';
    echo '<div class="d_flex justify_content_center">';
    echo '<button class="event_button">JOIN</button>';
    echo '</div>';
    echo '</div>';
}
?>


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

<script src="../assets/js/messageScript.js"></script>
<script src="../assets/js/modalLogoutLogic.js"></script>
</body>

</html>