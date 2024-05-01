<?php
    namespace repository;

    use Cassandra\Date;
    use PDO;
    use PDOException;
    use Relay\Event;

    require_once $_SERVER["DOCUMENT_ROOT"] . "/webUSI/config/config.php";

    // For local dev
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
            $query = "SELECT `admin_id`, `password` FROM `admin` WHERE `username` = :username";
            $params = [
                "username" => $username
            ];

            $stmt = $this->query($query, $params);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return null;
            }

            $hashedPassword = $user['password'];
            $userId = $user['admin_id'];

            if (password_verify($password, $hashedPassword)) {
                return $userId;
            }

            return null;
        }

    public function getEventById(int $eventId): array
    {
        $query = "SELECT * FROM `event` WHERE `event_id` = :eventId";
        $params = [ "eventId" => $eventId ];
        $stmt = $this->query($query, $params);
        $event = $stmt->fetch();
        return $event;
    }

    public function addEvent(string $title, string $date, string $location,  string $description, int $adminId): void
        {
            $query = "INSERT INTO event (title, location, date, description, author_id) VALUES (:title, :location, :date, :description, :authorId)";
            $params = [
                'title' => $title,
                'location' => $location,
                'date' => $date,
                "description" => $description,
                "authorId" => $adminId
            ];

            $stmt = $this->query($query, $params);
        }


        public function editEvent(int $eventId, string $title, string $date, string $description, string $location, int $adminId): void
    {
        $query = "UPDATE event SET title = :title, date = :date, location = :location, description = :description, author_id = :authorId WHERE event_id = :eventId";
        $params = [
            'title' => $title,
            "date" => $date,
            'location' => $location,
            'description' => $description,
            'eventId' => $eventId,
            "authorId" => $adminId
        ];
        $stmt = $this->query($query, $params);
    }

    public function getAllEvents(): array
    {
        $query = "SELECT * FROM `event` ORDER BY `date` DESC";
        $stmt = $this->pdo->query($query);
        $events = $stmt->fetchAll();
        return $events;
    }


    public function getEventsForEvents(): array
    {
        $query = "SELECT * FROM `event` ORDER BY `date` DESC LIMIT 6";
        $stmt = $this->pdo->query($query);
        $events = $stmt->fetchAll();
        return $events;
    }

    public function getEventsForHomepage(): array
    {
        $query = "SELECT * FROM `event` ORDER BY `date` DESC LIMIT 2";
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