<?php
namespace pages;

session_start();
use \repository\Database;
require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

$database = new \repository\Database();
$eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
if ($eventId === null) {
    header("location: /webUSI/index?EventDoesNotExist");
    exit();
}
$event = $database->getEventById($eventId);
$images = $database->getImagesByEventId($eventId);

include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");
?>
<style>
    #image-preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .preview-image {
        margin: 5px;
        max-width: 200px;
        max-height: 200px;
    }
</style>

<div>
    <h1><?php echo $event["title"]; ?></h1>
    <p><?php echo $event["date"]; ?></p>
    <p><?php echo $event["location"]; ?></p>
    <p><?php echo $event["description"]; ?></p>
</div>

<div id="image-preview">
    <?php foreach ($images as $image): ?>
        <div>
            <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo $image["url"]; ?>" alt="Existing Image">
        </div>
    <?php endforeach; ?>
</div>

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/events" class="back-link">Zpět</a>


<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
?>
