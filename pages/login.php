<?php

namespace pages;

session_start();

if (isset($_SESSION['isLogin'])) {
    header('location: ../pages/admin.php');
    exit();
}
include_once("../includes/header.php");
include "../templates/loginTemplate.php";

?>

<?php
    include_once("../includes/footer.php");