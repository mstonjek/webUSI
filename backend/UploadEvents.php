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

    public function uploadEvent(int|null $eventId, string $title, string $date, string $location, string $description): void
    {
        if ($eventId !== null) {

            $this->database->editEvent($eventId, $title, $date, $location, $description, $_SESSION['user_id']);
        } else {
            $this->database->addEvent($title, $date, $location, $description, $_SESSION['user_id']);
        }
        header("location: ../pages/editEvents.php");
        exit();
    }
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $eventId = isset($_POST["eventId"]) ? $_POST["eventId"] : null;
        $title = $_POST["title"];
        $location = $_POST["location"];
        $date = $_POST["date"];
        $description = $_POST["description"];

        if (!empty($title) && !empty($location) && !empty($date) && !empty($description)) {
                $database = new Database();
                $uploadEvents = new UploadEvents($database);
                $uploadEvents->uploadEvent($eventId, $title, $date, $location, $description);

        } else {
            header('location: ../pages/admin.php?error=emptyFields');
            exit();


            }


    }