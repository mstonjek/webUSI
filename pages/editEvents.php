<?php

namespace pages;

session_start();

use \repository\Database;

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

\backend\Auth::authorizeUser();

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
$database = new \repository\Database();

$events = $database->getAllEvents();

include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/headerAdmin.php");
?>

<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/addEvent">Přidat</a>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editEvent?eventId=<?php echo $event["event_id"]; ?>">Upravit</a>
        <hr>
    </div>
<?php endforeach;
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
