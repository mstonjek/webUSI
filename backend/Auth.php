<?php

namespace backend;

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