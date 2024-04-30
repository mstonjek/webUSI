<?php


namespace pages;


session_start();

use \repository\Database;

require_once "../repository/Database.php";




$database = new \repository\Database();
$events = $database->getEventsForHomepage();
include_once("../includes/header.php");
?>

<h1><?php $events["title"] ?></h1>
<h1><?php $events["date"]->format("d-m-Y") ?></h1>
<h1><?php $events["location"] ?></h1>
<h1><?php $events["description"] ?></h1>
<a href="event.php?event_id=<?php $events["eventID"]?>">Více</a>

<?php
    include_once("../includes/footer.php");
    ?>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <a href="./event.php?event_id=<?php echo $event["eventID"]; ?>">Více</a>
        <hr>
    </div>
<?php endforeach; ?>



