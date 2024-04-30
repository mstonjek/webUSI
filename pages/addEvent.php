<?php

    namespace pages;

    session_start();

    use \repository\Database;

    require_once "../backend/Auth.php";

    \backend\Auth::authorizeUser();

    require_once "../repository/Database.php";
    $database = new \repository\Database();

    ?>


        <form action="../backend/UploadEvents.php" method="POST">
            <input type="text" name="title"/>
            <input type="date" name="date" />
            <input type="text" name="location"/>
            <textarea name="description" cols="30" rows="10"></textarea>
            <button name="submit">Upravit</button>
        </form>
        <a href="./editEvents.php">Zpět</a>

        <?php
    include_once("../includes/footer.php");

