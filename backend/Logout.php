<?php

namespace backend;

session_start();

class Logout
{

    public function logoutUser(): void
    {
        unset($_SESSION['isLogin']);
        unset($_SESSION['user_id']);
        session_destroy();
        header('location: /webUSI/login?LogoutSuccess');
        exit();
    }

}

$logoutHandler = new Logout();

$logoutHandler->logoutUser();