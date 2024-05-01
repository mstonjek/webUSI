<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once "../backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once "../repository/Database.php";
    $database = new \repository\Database();

    $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
    if ($eventId === null) {
        header("location: ./index.php?error=eventIdDoesNotExist");
        exit();
    }

    $event = $database->getEventById($eventId);



    ?>

<form action="../backend/UploadEvents.php" method="POST">
    <input type="hidden" name="eventId" value="<?php echo $event["event_id"]; ?>">
    <input type="text" name="title" value="<?php echo $event["title"]; ?>"/>
    <input type="date" name="date" value="<?php echo $event["date"]; ?>"/>
    <input type="text" name="location" value="<?php echo $event["location"]; ?>"/>
    <textarea name="description" cols="30" rows="10"><?php echo $event["description"]; ?></textarea>
    <button name="submit">Upravit</button>
</form>
<a href="./editEvents.php">Zpět</a>

<?php
    include_once("../includes/footer.php");
