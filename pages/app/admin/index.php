<?php

    namespace pages;

    session_start();

    require_once "../../../backend/Auth.php";

    \backend\Auth::authorizeUser();

    echo "authorized only";
    ?>

<form action="../../../backend/Logout.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>