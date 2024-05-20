<?php
namespace pages;

session_start();
use \repository\Database;
require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

$database = new \repository\Database();
$schoolId = isset($_GET['schoolId']) ? $_GET['schoolId'] : null;
if ($schoolId === null) {
    header("location: /webUSI/index?SchoolDoesNotExist");
    exit();
}
$school = $database->getSchoolById($schoolId);
$images = $database->getImagesBySchoolId($schoolId);

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
    <h1><?php echo $school["title"]; ?></h1>
    <p><?php echo $school["headmaster"]; ?></p>
    <p><?php echo $school["address"]; ?></p>
    <p><?php echo $school["description"]; ?></p>
</div>

<div id="image-preview">
    <?php foreach ($images as $image): ?>
        <div>
            <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo $image["url"]; ?>" alt="Existing Image">
        </div>
    <?php endforeach; ?>
</div>

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/about" class="back-link">Zpět</a>


<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
?>
