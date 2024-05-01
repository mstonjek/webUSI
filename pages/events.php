<?php

    namespace pages;

    session_start();

    use \repository\Database;
    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

    $database = new \repository\Database();

    $events = $database->getAllEvents();
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");
?>

<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/event?eventId=<?php echo $event["event_id"]; ?>">Více</a>
    </div>
<?php endforeach; ?>

<?php


    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");




