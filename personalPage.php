<?php
session_start();
require_once "./classes/Event.php";
require_once "./classes/User.php";
require_once "./classes/Database.php";
//This could be in a partials
//message logic
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];

    //remove message
    unset($_SESSION['message']);
}

$user = new User($_SESSION['user_email'], $_SESSION['user_password']);
$database = new Database();
$event = new Event($database, $user);

$userEmail = $user->getMail();
$events = $event->getUserEvents($userEmail);


//HTML Header
include "./partials/header.php";
?>
Dashboard

<?php
foreach ($events as $event_item) {
    echo ($event_item->nome_evento);
    echo ($event_item->data_evento);
}
?>
</body>

</html>