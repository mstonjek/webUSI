<?php

namespace backend;

session_start();

class Logout
{

    public function logoutUser(): void
    {
        unset($_SESSION['isLogin']);
        unset($_SESSION['userID']);
        session_destroy();
        header('location: ../pages/');
        exit();
    }

}

$logoutHandler = new Logout();

$logoutHandler->logoutUser();