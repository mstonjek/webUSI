<?php

namespace pages;

session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/backend/Auth.php";

\backend\Auth::authorizeUser();

echo "authorized only";
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/headerAdmin.php");
?>

<form action="<?php $_SERVER["DOCUMENT_ROOT"] ?>/webUSI/backend/Logout.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>

<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");