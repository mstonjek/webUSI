<?php

namespace backend;

    session_start();


    use repository\Database;

    require_once "../repository/Database.php";

class UploadEvents
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function uploadEvent(int|null $eventID, string $title, string $date, string $location, string $description): void
    {
        if ($eventID !== null) {

            $this->database->editEvent($eventID, $title, $date, $location, $description, $_SESSION['userID']);
        } else {
            $this->database->addEvent($title, $date, $location, $description, $_SESSION['userID']);
        }
        header("location: ../pages/editEvents.php");
        exit();
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $eventID = isset($_POST["eventID"]) ? $_POST["eventID"] : null;
        $title = $_POST["title"];
        $location = $_POST["location"];
        $date = $_POST["date"];
        $description = $_POST["description"];

        if (!empty($title) && !empty($location) && !empty($date) && !empty($description)) {
                $database = new Database();
                $uploadEvents = new UploadEvents($database);
                $uploadEvents->uploadEvent($eventID, $title, $date, $location, $description);

        } else {
            header('location: ../pages/admin.php?error=emptyFields');
            exit();


            }


    }