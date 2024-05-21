<?php


    namespace pages;


    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";




    $database = new \repository\Database();
    $events = $database->getEvents(2);

    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");
?>

<style>
    #image-preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .preview-image {
        margin: 5px;
        max-width: 200px;
        max-height: 200px;
    }
</style>


<?php foreach ($events as $event): ?>
    <div>
        <h1><?php echo $event["title"]; ?></h1>
        <p>Location: <?php echo $event["location"]; ?></p>
        <span>Date: <?php echo $event["date"]; ?></span>
        <p><?php echo substr($event["description"], 0, 30).".."; ?></p>
        <?php
            $imageUrl = explode(",", $event["url"])[0];
                ?>
                <div id="image-preview">
                    <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo trim($imageUrl); ?>" alt="<?php $event["title"] ?>">
                </div>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/event?eventId=<?php echo $event["event_id"]; ?>"><button>Celý článek</button> </a>
    </div>
<?php endforeach; ?>

<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");

    ?>





