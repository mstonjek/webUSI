<?php

namespace backend;

session_start();

class Auth
{
    public static function authorizeUser(): void
    {
        if (!isset($_SESSION['isLogin'])) {
            header('location: /webUSI/login?NotLoggedIn');
            exit();
        }
    }

}