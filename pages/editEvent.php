<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once "../backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once "../repository/Database.php";
    $database = new \repository\Database();

    $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;
    if ($event_id === null) {
        header("location: ./index.php?error=eventIdDoesNotExist");
        exit();
    }

    $event = $database->getEventById($event_id);

    ?>

<form action="../backend/UploadEvents.php" method="POST">
    <input type="hidden" name="eventID" value="<?php echo $event["eventID"]; ?>">
    <input type="text" name="title" value="<?php echo $event["title"]; ?>"/>
    <input type="date" name="date" value="<?php echo $event["date"]; ?>"/>
    <input type="text" name="location" value="<?php echo $event["location"]; ?>"/>
    <textarea name="description" cols="30" rows="10"><?php echo $event["description"]; ?></textarea>
    <button name="submit">Upravit</button>
</form>
<a href="./events.php">Zpět</a>

<?php
    include_once("../includes/footer.php");
