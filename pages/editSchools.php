<?php

namespace pages;

session_start();

use \repository\Database;

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

\backend\Auth::authorizeUser();

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

$database = new \repository\Database();
$schools = $database->getSchools();

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

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/addSchool">Přidat</a>

<?php foreach ($schools as $school): ?>
    <div>
        <h1><?php echo $school["title"]; ?></h1>
            <?php
                $imageUrl = explode(",", $school["url"])[0];
            ?>
                    <div id="image-preview">
                        <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo trim($imageUrl); ?>" alt="<?php $school["title"] ?>">
                    </div>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editSchool?schoolId=<?php echo $school["school_id"]; ?>">Upravit</a>
        <hr>
    </div>
<?php endforeach;
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
