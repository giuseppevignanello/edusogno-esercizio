<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
require_once "Database.php";
require_once "Event.php";
class EventController
{
    private $events;
    private $database;
    public function __construct()
    {
        $this->database = new Database();
        $this->events = array();
    }

    public function getAllEvents()
    {
        //db connection
        $conn = $this->database->getConnection();
        $query = "SELECT * FROM eventi";
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }

        while ($row = $result->fetch_assoc()) {
            //initialize a new Event Object 
            $event = new Event(
                $row['nome_evento'],
                $row['attendees'],
                $row['data_evento']
            );

            $event->setId($row['id']);

            // store the event in the events list  
            $this->events[] = $event;
        }
        return $this->events;
    }


    //store method
    public function storeEvent(Event $event)
    {
        $conn = $this->database->getConnection();
        $eventName = $event->getEventName();
        $eventDateTime = $event->getEventDate();
        $eventAttendees = $event->getAttendees();

        $query = "INSERT INTO eventi (nome_evento, data_evento, attendees) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $conn->error);
        }
        $stmt->bind_param("sss", $eventName, $eventDateTime, $eventAttendees);


        if ($stmt->execute()) {

            $subject = "Evento creato";
            $message = "L'evento $eventName è stato appena aggiunto. Ti aspettiamo il giorno $eventDateTime";
            //send emails
            EventController::sendMail($subject, $message, $eventAttendees);
            return true;
        } else {
            return false;
        }
    }

    //update method
    public function updateEvent($eventId, $eventName, $eventDateTime)
    {
        $conn = $this->database->getConnection();

        $conn = $this->database->getConnection();

        //get attendees
        $getEmailsQuery = "SELECT attendees FROM eventi WHERE id = ?";
        $getEmailsStmt = $conn->prepare($getEmailsQuery);
        if (!$getEmailsStmt) {
            die("Query Error: " . $conn->error);
        }
        $getEmailsStmt->bind_param("i", $eventId);
        $getEmailsStmt->execute();
        $result = $getEmailsStmt->get_result();
        $row = $result->fetch_assoc();
        $eventAttendees = $row['attendees'];

        //update
        $query = "UPDATE eventi SET nome_evento = ?, data_evento = ?, attendees = attendees WHERE id = ?";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $conn->error);
        }
        $stmt->bind_param("ssi", $eventName, $eventDateTime, $eventId);




        if ($stmt->execute()) {
            //send emails
            $subject = "Evento modificato";
            $message = "L'evento $eventName è stato appena modificato. Ti aspettiamo il giorno $eventDateTime";
            //send emails
            EventController::sendMail($subject, $message, $eventAttendees);
            return true;
        } else {
            return false;
        }
    }

    public function deleteEvent($eventId)
    {
        $conn = $this->database->getConnection();

        $query = "SELECT nome_evento, data_evento, attendees FROM eventi WHERE id = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $conn->error);
        }
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $eventName = $row['nome_evento'];
        $eventDateTime = $row['data_evento'];
        $eventAttendees = $row['attendees'];


        $deleteQuery = "DELETE FROM eventi WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);
        if (!$deleteStmt) {
            die("Query Error: " . $conn->error);
        }
        $deleteStmt->bind_param("i", $eventId);

        if ($deleteStmt->execute()) {
            $subject = "Evento eliminato";
            $message = "L'evento $eventName è stato eliminato. Era programmato per il giorno $eventDateTime. Ci scusiamo per il disagio...";
            EventController::sendMail($subject, $message, $eventAttendees);
            return true;
        } else {
            return false;
        }
    }

    private static function sendMail($subject, $message, $eventAttendees)
    {
        //user and password to send emails
        $env = parse_ini_file('../.env');
        $SMTP_USER = $env['SMTP_USER'];
        $SMTP_PASS = $env['SMTP_PASS'];
        $eventAttendees = explode(',', $eventAttendees);
        foreach ($eventAttendees as $attendeeEmail) {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = $SMTP_USER;
            $mail->Password =  $SMTP_PASS;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($attendeeEmail);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->send();
        }
    }
}
