<?php

namespace pages;

session_start();

use \repository\Database;

require_once "../backend/Auth.php";

\backend\Auth::authorizeUser();

require_once "../repository/Database.php";
$database = new \repository\Database();

$events = $database->getAllEvents();

?>


<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <?php $event["eventID"] ?>
        <a href="editEvent.php?event_id=<?php $event["eventID"] ?>">Upravit</a>
        <hr>
    </div>
<?php endforeach; ?>

