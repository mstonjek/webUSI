<?php

namespace backend;


    use repository\Database;

    require_once "../repository/Database.php";

class UploadEvents
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function uploadEvent(int $eventID, string $title, string $location, string $description): void
    {
        if ( $this->database->getEventById($eventID) !== null ) {
            $this->database->editEvent($eventID, $title, $location, $description);
            header("location: ../pages/editEvents.php");
            exit();
        } else {
            header("location: ../pages/editEvents.php?error=idNotFound");
            exit();
        }
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $eventID = $_POST["eventID"];
        $title = $_POST["title"];
        $location = $_POST["location"];
        //$date = new DateTime($_POST["date"]);
        $description = $_POST["description"];

        if (!empty($title) && !empty($location) && !empty($description)) {
            try {
                $database = new Database();
                $loginSession = new UploadEvents($database);
                $loginSession->uploadEvent($eventID, $title, $date, $location, $description);
            } catch (\Exception $e) {
                error_log("Error: " . $e->getMessage());
                header('location: ../pages/login.php?error=databaseError');
                exit();
            }
        }
    }