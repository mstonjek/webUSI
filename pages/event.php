<?php
    namespace pages;


    session_start();
    use \repository\Database;
    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";

    $database = new \repository\Database();
    $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
    if ($eventId === null) {
        header("location: /webUSI/index?EventDoesNotExist");
        exit();
    }

    $event = $database->getEventById($eventId);
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");
    ?>


<h1><?php echo $event["title"]; ?></h1>
<p><?php echo $event["date"]; ?></p>
<p><?php echo $event["location"]; ?></p>
<p><?php echo $event["description"]; ?></p>
<a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/events">Zpět</a>

<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");
    ?>



