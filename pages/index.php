<?php


    namespace pages;


    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";




    $database = new \repository\Database();
    $events = $database->getEvents(2);

    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");
/*
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
<?php endforeach; */?>

<main class="index">
        <section>
            <div>
                <h1>Unie Škol Inovativních</h1>
                <p>Společně rozvíjejme budoucnost vzdělávání</p>
                <a href="#footer">
                    <button>Přidej se k nám!</button>
                </a>
            </div>
        </section>
        <section>
            <div>
                <?php foreach ($events as $event): ?>
                    <div>
                    <?php
                        $imageUrl = explode(",", $event["url"])[0];
                    ?>
                        <div id="image-preview">
                            <img class="preview-image" src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/uploads/<?php echo trim($imageUrl); ?>" alt="<?php echo $event["title"] ?>">
                        </div>
                        <h2><?php echo $event["title"]; ?></h2>
                        <p><?php echo substr($event["description"], 0, 30).".."; ?></p>
                        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/event?eventId=<?php echo $event["event_id"]; ?>"><button>Celý článek</button> </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section>
            <img src="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/assets/skupinova.jpg" alt="skupinove foto">
            <div>
                <h2>UŠI</h2>
                <p>Unie škol inovativních (UŠI) je nová iniciativa spojující několik škol a vedení, které se
                    rozhodlo spolupracovat na společných projektech a akcích. Cílem UŠI je vytvořit prostředí, ve
                    kterém mohou školy sdílet své inovativní myšlenky a iniciativy, a zároveň zapojit co nejvíce
                    studentů do organizace a realizace těchto aktivit.</p>
                <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/about">
                    <button>Zjistěte více</button>
                </a>
            </div>
        </section>
    </main>

<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");

    ?>





