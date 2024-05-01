<?php


namespace pages;


session_start();

use \repository\Database;

require_once "../repository/Database.php";




$database = new \repository\Database();
$events = $database->getEventsForHomepage();

include_once("../includes/header.php");
?>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <p><?php echo substr($event["description"], 0, 30).".."; ?></p>
        <a href="./event.php?eventId=<?php echo $event["event_id"]; ?>"><button>Celý článek</button> </a>
    </div>
<?php endforeach; ?>

<?php
    include_once("../includes/footer.php");
    ?>





