<?php
    namespace pages;


    session_start();
    use \repository\Database;
    require_once "../repository/Database.php";

    $database = new \repository\Database();
    $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;
    if ($event_id === null) {
        header("location: index.php?error=eventIdDoesNotExist");
        exit();
    }

    $event = $database->getEventById($event_id);
    include_once("../includes/header.php");
    ?>

<h1><?php $event["title"] ?></h1>
<h1><?php $event["date"]->format("d-m-Y") ?></h1>
<h1><?php $event["location"] ?></h1>
<h1><?php $event["description"] ?></h1>
<a href="events.php">Zpět</a>

<?php
    include_once("../includes/footer.php");
