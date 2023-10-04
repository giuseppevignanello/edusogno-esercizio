<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "../classes/EventController.php";


$eventController = new EventController;
$events = $eventController->getAllEvents();


//redirect to edit
if (isset($_POST['edit_event'])) {
    $id = $_POST['edit_event'];

    header('Location: edit.php?id=' . $id);
}

if (isset($_POST['event_id_edit'])) {
    $id = $_POST['event_id_edit'];
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];
    $eventTime = $_POST['event_time'];
    $eventDateTime = $eventDate . ' ' . $eventTime;

    $update = $eventController->updateEvent($id, $eventName, $eventDateTime,);

    if ($update) {
        $_SESSION['message'] = "Evento aggiornato con successo!";
    } else {
        $_SESSION['message'] = "Ops, qualcosa è andato storto...";
    }
    header('Location: dashboard.php');
}

if (isset($_POST['add_event'])) {
    header('Location: create.php');
}

if (isset($_POST['store_event'])) {
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];
    $eventTime = $_POST['event_time'];
    $eventDateTime = $eventDate . ' ' . $eventTime;
    $eventAttendees = "";

    $newEvent = new Event($eventName, $eventDateTime, $eventAttendees);

    $store = $eventController->storeEvent($newEvent);

    if ($store) {
        $_SESSION['message'] = "Evento aggiunto con successo!";
    } else {
        $_SESSION['message'] = "Ops, qualcosa è andato storto...";
    }
    header('Location: dashboard.php');
}
