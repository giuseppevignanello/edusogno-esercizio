<?php
session_start();
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

$userEmail = $user->getMail();
$events = $user->getUserEvents($userEmail);

$userName = $user->getName();
$userSurname = $user->getSurname();

//HTML Header
include "./partials/header.php";
?>
<h1 class="title text_bold">Ciao <?php echo ($userName . ' ' . $userSurname) ?> ecco i tuoi eventi</h1>
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
</body>

</html>