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
        $sanitizedData = $this->sanitizeInput($username, $password);
        $user = $this->database->authenticateUser($sanitizedData['username'], $sanitizedData['password']);
        if ($user) {
            $_SESSION['isLogin'] = $user;
            header('location: ../pages/admin.php?success=true');
            exit();
        } else {
            header('location: ../pages/login.php?error=wrongPassword');
            exit();
        }
    }

    public function logoutUser(): void
    {
        unset($_SESSION['isLogin']);
        session_destroy();
        header('location: ../pages/login.php?success=true');
        exit();
    }

    private function sanitizeInput(string $username, string $password): array
    {
        $sanitizedData = [
            'username' => htmlspecialchars(trim($username)),
            'password' => htmlspecialchars(trim($password))
        ];
        return $sanitizedData;
    }
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!empty($username) && !empty($password)) {

            try {
                $database = new \repository\Database();
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

