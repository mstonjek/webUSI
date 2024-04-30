<?php


namespace pages;


session_start();

use \repository\Database;

require_once "../repository/Database.php";




$database = new \repository\Database();
$events = $database->getEventsForHomepage();
include_once("../includes/header.php");
?>







<main class="index">
    <section>
        <div>
            <h1>Unie Škol Inovativních</h1>
            <p>Společně rozvíjejme budoucnost vzdělávání</p>
            <a href="./kontakty">
                <button>Přidej se k nám!</button>
            </a>
        </div>
    </section>
    <section>
        <div>
            <?php foreach ($events as $event): ?>
            <div>
                <img src="https://ralfvanveen.com/wp-content/uploads/2021/06/Placeholder-_-Glossary.svg" alt="fotogragie z kroužku">
                <h2><?php echo $event["title"]; ?></h2>
                <p><?php echo substr($event["description"], 0, 30).".."; ?></p>
                <a href="./event.php?event_id=<?php echo $event["eventID"]; ?>">
                    <button>Celý článek</button>                
                </a>
                <hr>
            </div>
            <?php endforeach;?>
        </div>
    </section>
    <section>
        <img src="../assets/skupinova.jpg" alt="skupinove foto">
        <div>
            <h2>UŠI</h2>
            <p>Unie škol inovativních (UŠI) je nová iniciativa spojující několik škol a vedení, které se
                rozhodlo spolupracovat na společných projektech a akcích. Cílem UŠI je vytvořit prostředí, ve
                kterém mohou školy sdílet své inovativní myšlenky a iniciativy, a zároveň zapojit co nejvíce
                studentů do organizace a realizace těchto aktivit.</p>
            <a href="../o-nas">
                <button>Zjistěte více</button>
            </a>
        </div>
    </section>
</main>





<?php
include_once("../includes/footer.php");


