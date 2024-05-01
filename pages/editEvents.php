<?php

namespace pages;

session_start();

use \repository\Database;

require_once "../backend/Auth.php";

\backend\Auth::authorizeUser();

require_once "../repository/Database.php";
$database = new \repository\Database();

$events = $database->getAllEvents();

include_once("../includes/headerAdmin.php");
?>

<a href="./addEvent.php">Přidat</a>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <a href="./editEvent.php?eventId=<?php echo $event["event_id"]; ?>">Upravit</a>
        <hr>
    </div>
<?php endforeach;
include_once("../includes/footer.php");
