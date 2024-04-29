<?php
    namespace pages;

    session_start();

    if (isset($_SESSION['isLogin'])) {
        header('location: ../../pages/app/admin');
        exit();
    }

    include "../../templates/loginTemplate.php";

