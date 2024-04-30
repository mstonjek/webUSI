<?php
    namespace repository;

    use Cassandra\Date;
    use PDO;
    use PDOException;
    use Relay\Event;

    require_once "../config/config.php";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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

        public function authenticateUser(string $username, string $password): ?int
        {
            $query = "SELECT `adminID`, `password` FROM `usi_admin` WHERE `username` = :username";
            $params = [
                "username" => $username
            ];

            $stmt = $this->query($query, $params);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return null;
            }

            $hashedPassword = $user['password'];
            $userID = $user['adminID'];

            if (password_verify($password, $hashedPassword)) {
                // Authentication successful, return the user ID
                return $userID;
            }

            // Authentication failed
            return null;
        }

    public function getEventById(int $id): array
    {
        $query = "SELECT * FROM `usi_event` WHERE `eventID` = :id";
        $params = [ "id" => $id ];
        $stmt = $this->query($query, $params);
        $event = $stmt->fetch();
        return $event;
    }

    public function addEvent(string $title, string $date, string $location,  string $description, int $userID): void
        {
            $query = "INSERT INTO usi_event (title, location, date, description, authorID) VALUES (:title, :location, :date, :description, :userID)";
            $params = [
                'title' => $title,
                'location' => $location,
                'date' => $date,
                "description" => $description,
                "userID" => $userID
            ];

            $stmt = $this->query($query, $params);
        }


        public function editEvent(int $eventID, string $title, string $date, string $description, string $location, int $userID): void
    {
        $query = "UPDATE usi_event SET title = :title, date = :date, location = :location, description = :description, authorID = :userID WHERE eventID = :eventID";
        $params = [
            'title' => $title,
            "date" => $date,
            'location' => $location,
            'description' => $description,
            'eventID' => $eventID,
            "userID" => $userID
        ];
        $stmt = $this->query($query, $params);
    }

    public function getAllEvents(): array
    {
        $query = "SELECT * FROM `usi_event` ORDER BY `date` DESC";
        $stmt = $this->pdo->query($query);
        $events = $stmt->fetchAll();
        return $events;
    }


    public function getEventsForEvents(): array
    {
        $query = "SELECT * FROM `usi_event` ORDER BY `date` DESC LIMIT 6";
        $stmt = $this->pdo->query($query);
        $events = $stmt->fetchAll();
        return $events;
    }

    public function getEventsForHomepage(): array
    {
        $query = "SELECT * FROM `usi_event` ORDER BY `date` DESC LIMIT 2";
        $stmt = $this->pdo->query($query);
        $events = $stmt->fetchAll();
        return $events;
    }

    private function query($query, $params) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }


}