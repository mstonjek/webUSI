<?php

    namespace backend;

    use repository\Database;

    session_start();

    require_once "../repository/Database.php";



class Login
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function loginUser(string $username, string $password): void
    {
        $user = $this->database->authenticateUser($username, $password);
        if ($user !== null) {
            $_SESSION['isLogin'] = true;
            $_SESSION['user_id'] = $user;
            header('location: ../pages/admin.php');
            exit();
        } else {
            header('location: ../pages/');
            exit();
        }
    }

}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {

            try {
                $database = new Database();
                $loginSession = new Login($database);
                $loginSession->loginUser($username, $password);
            } catch (\Exception $e) {
                error_log("Error: " . $e->getMessage());
                header('location: ../pages/login.php?error=databaseError');
                exit();
            }

        } else {
            header('location: ../pages/login.php?error=emptyInput');
            exit();
        }
    }

