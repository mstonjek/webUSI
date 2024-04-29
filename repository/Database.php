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

        return $hashedPassword && password_verify($password, $hashedPassword);
    }

    public function getAllEvents(): array
    {
        $query = "SELECT * FROM usi_events ORDER BY date DESC";
        $stmt = $this->query($query);
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }

    private function query($query, $params) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }


}