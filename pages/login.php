<?php

namespace pages;

session_start();

if (isset($_SESSION['isLogin'])) {
    header("location: /webUSI/admin?LoginSuccess");
    exit();
}
include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/header.php");

include $_SERVER["DOCUMENT_ROOT"] . "/webUSI/templates/loginTemplate.php";

?>

<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/webUSI/includes/footer.php");