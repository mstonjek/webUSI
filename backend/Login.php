<?php
namespace pages;

session_start();

use classes\userRepository;
use repository\Database;

require_once "../repository/Database.php";

class Login
{
    private readonly $database;
    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function loginUser(string $username, string $password): void
    {
        $sanitizedData = $this->sanitizeInput($username, $password);
        $user = $this->database->authenticateUser($sanitizedData['username'], $sanitizedData['password']);

        if ($user) {
            $_SESSION['isLogin'] = $user;
            header('location: ../pages/admin.php?success=true');
        } else {
            header('location: ../pages/login.php?error=wrongPassword');
        }
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
