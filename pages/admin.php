<?php

    namespace pages;

    session_start();

    require_once "../backend/Auth.php";

    \backend\Auth::authorizeUser();

    echo "authorized only";