<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/repository/Database.php";
    $database = new \repository\Database();

    ?>


        <form action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/backend/UploadEvents.php" method="POST">
            <input type="text" name="title"/>
            <input type="date" name="date" />
            <input type="text" name="location"/>
            <textarea name="description" cols="30" rows="10"></textarea>
            <button name="submit">Upravit</button>
        </form>
        <a href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/editEvents">Zpět</a>

        <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");

