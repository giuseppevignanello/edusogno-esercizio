<?php
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
                $row['id'],
                $row['nome_evento'],
                $row['attendees'],
                $row['data_evento']
            );

            // store the event in the events list  
            $this->events[] = $event;
        }
        return $this->events;
    }

    public function addEvent(Event $event)
    {
    }

    public function updateEvent($eventId, $eventName, $eventDateTime)
    {
        $conn = $this->database->getConnection();

        $query = "UPDATE eventi SET nome_evento = ?, data_evento = ?, attendees = attendees WHERE id = ?";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Query Error: " . $conn->error);
        }
        $stmt->bind_param("ssi", $eventName, $eventDateTime, $eventId);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function deleteEvent(Event $event)
    {
    }
}
