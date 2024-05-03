<?php

namespace backend;

    session_start();


    use repository\Database;

    require_once $_SERVER['DOCUMENT_ROOT'] . "/webUSI/repository/Database.php";

class UploadEvents
{
    private Database $database;

    const TITLE_MAX_LENGTH = 255;
    const LOCATION_MAX_LENGTH = 255;
    const DESCRIPTION_MAX_LENGTH = 65535;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function uploadEvent(int|null $eventId, string $title, string $date, string $location, string $description, $files): void
    {
        if ($eventId !== null) {
            $this->database->editEvent($eventId, $title, $date, $location, $description, $_SESSION['user_id']);
        } else {
            $imageNames = $this->uploadImages($files);
            $this->database->addEvent($title, $date, $location, $description, $_SESSION['user_id'], $imageNames);

        }
        header("location: /webUSI/editEvents");
        exit();
    }

    private function uploadImages($images): array
    {
        $imageNames = [];

        if (!isset($images['tmp_name']) || !is_array($images['tmp_name'])) {
            return ["image_default.jpg"];
        }

        foreach ($images['tmp_name'] as $key => $tmp_name) {
            if (!is_uploaded_file($tmp_name)) {
                throw new \Exception("Chyba: Soubor '{$images['name'][$key]}' nebyl nahrán.");
            }

            $imageInfo = getimagesize($tmp_name);
            if ($imageInfo === false || !in_array($imageInfo['mime'], ['image/jpeg', 'image/png', 'image/webp'])) {
                throw new \Exception("Chyba: Neplatný formát obrázku '{$images['name'][$key]}'.");
            }
        }

        foreach ($images['tmp_name'] as $key => $tmp_name) {
            $imageName = uniqid("image_") . "." . pathinfo($images['name'][$key], PATHINFO_EXTENSION);
            $path = $_SERVER["DOCUMENT_ROOT"] . '/webUSI/uploads/' . $imageName;

            if (!move_uploaded_file($tmp_name, $path)) {
                throw new \Exception("Chyba: Nahrání obrázku '{$images['name'][$key]}' selhalo.");
            }

            $imageNames[] = $imageName;
        }

        return $imageNames;
    }

}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $eventId = isset($_POST["eventId"]) ? $_POST["eventId"] : null;
        $title = $_POST["title"];
        $location = $_POST["location"];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $images = isset($_FILES["images"]) ? $_FILES["images"] : null;

        $database = new Database();
        $uploadEvents = new UploadEvents($database);

        if (empty($title) || empty($location) || empty($date) || empty($description)) {
            header('location: /webUSI/editEvents?EmptyFields');
            exit();
        }

        if (strlen($title) > UploadEvents::TITLE_MAX_LENGTH || strlen($location) > UploadEvents::LOCATION_MAX_LENGTH || strlen($description) > UploadEvents::DESCRIPTION_MAX_LENGTH) {
            header('location: /webUSI/editEvents?InvalidLength');
            exit();
        }

        $uploadEvents->uploadEvent($eventId, $title, $date, $location, $description, $images);
    }