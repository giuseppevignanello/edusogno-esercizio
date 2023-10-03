<?
require_once "./classes/Database.php";

class Event
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
}
