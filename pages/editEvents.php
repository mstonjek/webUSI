<?php

namespace pages;

session_start();

use \repository\Database;

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

\backend\Auth::authorizeUser();

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

$database = new \repository\Database();
$events = $database->getEvents();

include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/headerAdmin.php");
?>

    <style>
        #image-preview {
            display: flex;
            flex-wrap: wrap;
        }

        .preview-image {
            margin: 5px;
            max-width: 200px;
            max-height: 200px;
        }
    </style>

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/addEvent">Přidat</a>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
            <?php
                $imageUrl = explode(",", $event["url"])[0];
            ?>
                    <div id="image-preview">
                        <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo trim($imageUrl); ?>" alt="<?php $event["title"] ?>">
                    </div>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editEvent?eventId=<?php echo $event["event_id"]; ?>">Upravit</a>
        <hr>
    </div>
<?php endforeach;
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
