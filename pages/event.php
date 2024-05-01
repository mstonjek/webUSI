<?php
    namespace pages;


    session_start();
    use \repository\Database;
    require_once "../repository/Database.php";

    $database = new \repository\Database();
    $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
    if ($eventId === null) {
        header("location: index.php?error=eventIdDoesNotExist");
        exit();
    }

    $event = $database->getEventById($eventId);
    include_once("../includes/header.php");
    ?>


<h1><?php echo $event["title"]; ?></h1>
<p><?php echo $event["date"]; ?></p>
<p><?php echo $event["location"]; ?></p>
<p><?php echo $event["description"]; ?></p>
<a href="./events.php">Zpět</a>

<?php
    include_once("../includes/footer.php");
    ?>



