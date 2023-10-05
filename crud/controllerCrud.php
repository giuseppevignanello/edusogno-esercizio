<?php


require_once "../classes/EventController.php";


$eventController = new EventController;
$events = $eventController->getAllEvents();


//redirect to edit
if (isset($_POST['edit_event'])) {
    $id = $_POST['edit_event'];

    header('Location: edit.php?id=' . $id);
}

//update
//TODO: change name into update
if (isset($_POST['update'])) {
    $id = $_POST['update'];
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
    header('Location: ../views/dashboard.php');
}

//redirect to create
if (isset($_POST['add_event'])) {
    header('Location: create.php');
}


//store
if (isset($_POST['store_event'])) {
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];
    $eventTime = $_POST['event_time'];
    $eventDateTime = $eventDate . ' ' . $eventTime . ':00';
    $eventAttendees = $_POST['event_attendees'];

    $newEvent = new Event($eventName, $eventAttendees, $eventDateTime);

    $store = $eventController->storeEvent($newEvent);

    if ($store) {
        $_SESSION['message'] = "Evento aggiunto con successo!";
    } else {
        $_SESSION['message'] = "Ops, qualcosa è andato storto...";
    }
    header('Location: ../views/dashboard.php');
}


//delete
if (isset($_POST['delete_event'])) {
    $id = $_POST['delete_event'];


    $delete = $eventController->deleteEvent($id);

    if ($delete) {
        $_SESSION['message'] = "Evento eliminato con successo!";
    } else {
        $_SESSION['message'] = "Ops, qualcosa è andato storto...";
    }
    header('Location: ../dashboard.php');
}