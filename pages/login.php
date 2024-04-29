<?php

include "../templates/loginTemplate.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        require_once "../backend/Login.php";
        $loginSession = new Login();
        $loginSession->loginUser($username, $password);

    } else {
        // Username or password is empty
        echo "Empty username and password";
    }
}