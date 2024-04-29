<?php

namespace backend;

session_start();

class Logout
{

    public function logoutUser(): void
    {
        unset($_SESSION['isLogin']);
        session_destroy();
        header('location: ../pages/');
        exit();
    }

}

$logoutHandler = new Logout();

$logoutHandler->logoutUser();