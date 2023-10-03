<?
require_once "./classes/Database.php";

class Event
{
    private $database;
    private $user;

    public function __construct($database, $user)
    {
        $this->database = $database;
        $this->user = $user;
    }

    public function getUserEvents($userEmail)
    {
        $conn = $this->database->getConnection();

        //this method is partially exposed to injections

        $query = "SELECT * FROM eventi WHERE FIND_IN_SET('$userEmail', attendees)";
        $result = $conn->query($query);

        if (!$result) {
            die("Query Error: " . $conn->error);
        }

        $events = array();

        while ($row = $result->fetch_assoc()) {
            $event = new stdClass();
            $event->id = $row['id'];
            $event->nome_evento = $row['nome_evento'];
            $event->data_evento = $row['data_evento'];

            $events[] = $event;
        }

        return $events;
    }
}
