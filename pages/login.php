<?php
    namespace pages;

    session_start();

    if (isset($_SESSION['isLogin'])) {
        header('location: ../pages/admin.php?success=true');
        exit();
    }

    include "../templates/loginTemplate.php";

