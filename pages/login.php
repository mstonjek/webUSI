<?php

namespace pages;

session_start();

if (isset($_SESSION['isLogin'])) {
    header('location: ../pages/admin.php');
    exit();
}

include "../templates/loginTemplate.php";

