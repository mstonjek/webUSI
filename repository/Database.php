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
        $query = "SELECT * FROM `user` WHERE `username` = :username AND `password` = :password";
        $params = [
            "username" => $username,
            "password" => $password
        ];

        $stmt = $this->query($query, $params);
        $user = $stmt->fetch();
        return $user ? true : false;
    }

    private function query($query, $params) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }


}