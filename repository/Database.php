<?php
    namespace repository;

    use PDO;
    use PDOException;

    require_once "../config/config.php";
class Database
{
    private $pdo;

    public function __construct() {
        global $config;

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']}";
        $username = $config['db_user'];
        $password = $config['db_pass'];

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function authenticateUser(string $username, string $password): bool
    {
        $query = "SELECT * FROM `usi_admin` WHERE `username` = :username";
        $params = [
            "username" => $username
        ];

        $stmt = $this->query($query, $params);
        $hashedPassword = $stmt->fetchColumn(2);

        if (!$hashedPassword) {
            return false; // User not found
        }

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            return true; // Passwords match, authentication successful
        } else {
            return false; // Passwords don't match, authentication failed
        }
    }

    public function getEventsForHomepage(): array
    {
        $query = "SELECT * FROM `events` ORDER BY `date` DESC LIMIT 2";
        $stmt = $this->query($query, null);
        $events = $stmt->fetchAll();
        return $events;
    }

    public function getAllEvents()
    {
        $query = "SELECT * FROM `events` ORDER BY `date` DESC";
        $stmt = $this->query($query, null);
        $events = $stmt->fetchAll();
        return $events;
    }

    private function query($query, $params) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }


}