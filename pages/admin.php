<?php

namespace pages;

session_start();

require_once "../backend/Auth.php";

\backend\Auth::authorizeUser();

echo "authorized only";
include_once("../includes/headerAdmin.php");
?>

<form action="../backend/Logout.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>

<?php
    include_once("../includes/footer.php");