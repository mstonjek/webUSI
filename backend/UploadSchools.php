<?php

namespace backend;

    session_start();


    use repository\Database;

    require_once $_SERVER['DOCUMENT_ROOT'] . "/webUSI/repository/Database.php";

class UploadSchools
{
    private Database $database;

    const TITLE_MAX_LENGTH = 255;
    const LOCATION_MAX_LENGTH = 255;
    const DESCRIPTION_MAX_LENGTH = 65535;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function uploadSchool(int|null $schooId, string $title, string $address, string $headmaster, string $web, string $description, $logo, $files, array|null $checkedImages): void
    {
        foreach ($logo as $key => $value) {
            array_unshift($files[$key], $value);
        }
        if ($schooId !== null) {
            $imageNames = $this->uploadImages($files);
            $this->replaceImages($checkedImages, $schooId);
            if(empty($logo["tmp_name"])){
                $this->database->editSchool($schooId, $title, $address, $headmaster, $web, $description, null, $imageNames);
            }
            else{
                $this->database->editSchool($schooId, $title, $address, $headmaster, $web, $description, $imageNames[0], array_slice($imageNames, 1));
            }
        } else {
            $imageNames = $this->uploadImages($files);
            $this->database->addSchool($title, $address, $headmaster, $web, $description, $imageNames[0], array_slice($imageNames, 1));

        }
        header("location: /webUSI/editSchools");    
        exit();
    }

    private function replaceImages(array|null $checkedImages, int $schooId): void
    {
        $allSchoolImages = $this->database->getImagesBySchoolId($schooId);
        foreach ($allSchoolImages as $image) {
            if ($checkedImages === null || !in_array($image["image_id"], $checkedImages)) {
                $url = $this->database->deleteImageByIdAndGetURL($image["image_id"]);
                $path = $_SERVER['DOCUMENT_ROOT'] . "/webUSI/uploads/" . $url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }


    private function uploadImages($images): array
    {
        $imageNames = [];

        if ((!isset($images['tmp_name']) || count(array_filter($images['tmp_name'])) === 0) && !isset($images[0]['tmp_name'])) {
            return ["image_default.png"];
        }


        foreach ($images['tmp_name'] as $key => $tmp_name) {
            if(empty($tmp_name)){
                continue;
            }
            if (!is_uploaded_file($tmp_name)) {
                throw new \Exception("Chyba: Soubor '   {$images['name'][$key]}' nebyl nahrán."."Pole:".print_r($images, true));
            }

            $imageInfo = getimagesize($tmp_name);
            if ($imageInfo === false || !in_array($imageInfo['mime'], ['image/jpeg', 'image/png', 'image/webp'])) {
                throw new \Exception("Chyba: Neplatný formát obrázku '{$images['name'][$key]}'.");
            }
        }

        foreach ($images['tmp_name'] as $key => $tmp_name) {
            if(empty($tmp_name)){
                continue;
            }
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

        $schooId = isset($_POST["schoolId"]) ? $_POST["schoolId"] : null;
        $title = $_POST["title"];
        $address = $_POST["address"];
        $headmaster = $_POST["headmaster"];
        $web = $_POST["web"];
        $description = $_POST["description"];
        $logo = isset($_FILES["logo"]) ? $_FILES["logo"] : null;
        $images = isset($_FILES["images"]) ? $_FILES["images"] : null;
        $oldImages = isset($_POST["oldImages"]) ? $_POST["oldImages"] : null;

        $database = new Database();
        $uploadSchools = new UploadSchools($database);

        if (empty($title) || empty($address) || empty($headmaster) || empty($web) || empty($description)) {
            header('location: /webUSI/editSchools?EmptyFields');
            exit();
        }

        if (strlen($title) > UploadSchools::TITLE_MAX_LENGTH || strlen($address) > UploadSchools::LOCATION_MAX_LENGTH || strlen($description) > UploadSchools::DESCRIPTION_MAX_LENGTH) {
            header('location: /webUSI/editSchools?InvalidLength');
            exit();
        }

        $uploadSchools->uploadSchool($schooId, $title, $address, $headmaster, $web, $description, $logo, $images, $oldImages);
    }