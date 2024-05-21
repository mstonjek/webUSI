<?php
    namespace repository;

    use Cassandra\Date;
    use http\Params;
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
    public function getSchoolById(int $schoolId): array
    {
        $query = "SELECT * FROM `school` WHERE `school_id` = :schoolId";
        $params = [ "schoolId" => $schoolId ];
        $stmt = $this->query($query, $params);
        $event = $stmt->fetch();
        return $event;
    }

    public function deleteImageByIdAndGetURL(int $imageId): string
    {
        $query = "SELECT `url` FROM `image` WHERE `image_id` = :imageId";
        $params = [ "imageId" => $imageId ];
        $stmt = $this->query($query, $params);
        $url = $stmt->fetchColumn();

        $query = "DELETE FROM `image` WHERE `image_id` = :imageId";
        $params = [ "imageId" => $imageId ];
        $stmt = $this->query($query, $params);

        return $url;
    }

    public function getImagesByEventId(int $eventId): array
    {
        $query = "SELECT * FROM `image` WHERE `event_id` = :eventId";
        $params = [ "eventId" => $eventId ];
        $stmt = $this->query($query, $params);
        $images = $stmt->fetchAll();
        return $images;
    }
    public function getImagesBySchoolId(int $schoolId): array
    {
        $query = "SELECT * FROM `image` WHERE `school_id` = :schoolId";
        $params = [ "schoolId" => $schoolId ];
        $stmt = $this->query($query, $params);
        $images = $stmt->fetchAll();
        return $images;
    }

    public function addEvent(string $title, string $date, string $location,  string $description, int $adminId, array $fileNames): void
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
            $eventId = $this->pdo->lastInsertId();

            $this->uploadEventImages($fileNames, $eventId, true);
        }

        public function editEvent(int $eventId, string $title, string $date, string $location, string $description, int $adminId, array $fileNames): void
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

            $this->uploadEventImages($fileNames, $eventId, false);
        }
        public function addSchool(string $title, string $address, string $headmaster, string $web, string $description, string $logoUrl ,array $fileNames): void
        {
            $query = "INSERT INTO event (title, address, headmaster, webUrl, description, logoUrl) VALUES (:title, :address, :headmaster, :webUrl, :description, :logoUrl)";
            $params = [
                'title' => $title,
                "address" => $address,
                'headmaster' => $headmaster,
                'webUrl' => $web,
                'description' => $description,
                'logoUrl' => $logoUrl,
            ];
            $stmt = $this->query($query, $params);
            $schoolId = $this->pdo->lastInsertId();

            $this->uploadSchoolImages($fileNames, $schoolId, true);
        }
        public function editSchool(int $schoolId, string $title, string $address, string $headmaster, string $web, string $description, string $logoUrl ,array $fileNames): void
        {
            $query = "UPDATE school SET title = :title, address = :address, headmaster = :headmaster, webUrl = :web, description = :description, logoUrl = :logoUrl WHERE school_id = :schoolId";
            $params = [
                'title' => $title,
                "address" => $address,
                'headmaster' => $headmaster,
                'webUrl' => $web,
                'description' => $description,
                'logoUrl' => $logoUrl,
                'schoolId' => $schoolId
            ];
            $stmt = $this->query($query, $params);

            $this->uploadSchoolImages($fileNames, $schoolId, false);
        }

        public function getEvents($limit = null): array
        {
            $limitClause = ($limit !== null) ? "LIMIT $limit" : "";
            $query = "SELECT e.*, GROUP_CONCAT(i.url) AS url 
              FROM `event` e 
              LEFT JOIN `image` i ON e.event_id = i.event_id 
              GROUP BY e.event_id 
              ORDER BY e.`date` DESC $limitClause";
            $stmt = $this->pdo->query($query);
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $events;
        }
        public function getSchools(): array{
            $query = "SELECT s.*, GROUP_CONCAT(i.url) AS url 
              FROM `school` s 
              LEFT JOIN `image` i ON s.school_id = i.school_id 
              GROUP BY s.school_id 
              ORDER BY s.`title`";
            $stmt = $this->pdo->query($query);
            $schools = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $schools;
        }

    private function isEventWithoutImage(int $eventId): bool
    {
        $query = "SELECT * FROM `image` WHERE `event_id` = :eventId";
        $params = [ "eventId" => $eventId ];
        $stmt = $this->query($query, $params);
        $images = $stmt->fetchAll();
        if (empty($images)) {
            return true;
        }
        return false;
    }
    private function isSchoolWithoutImage(int $schoolId): bool
    {
        $query = "SELECT * FROM `image` WHERE `school_id` = :schoolId";
        $params = [ "schoolId" => $schoolId ];
        $stmt = $this->query($query, $params);
        $images = $stmt->fetchAll();
        if (empty($images)) {
            return true;
        }
        return false;
    }

    private function query($query, $params) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    private function uploadEventImages(array $imageNames, int $eventId, bool $isAddition): void
    {
            foreach ($imageNames as $imageName) {
                if ($imageName === "image_default.png" && !$isAddition && !$this->isEventWithoutImage($eventId)) {
                    continue;
                }
                $query = "INSERT INTO image (url, isVideo, event_id) VALUES (:url, :isVideo, :eventId)";
                $params = [
                    "url" => $imageName,
                    "isVideo" => 0,
                    "eventId" => $eventId
                ];

                $this->query($query, $params);

            }

    }
    private function uploadSchoolImages(array $imageNames, int $schoolId, bool $isAddition): void
    {
            foreach ($imageNames as $imageName) {
                if ($imageName === "image_default.png" && !$isAddition && !$this->isSchoolWithoutImage($schoolId)) {
                    continue;
                }
                $query = "INSERT INTO image (url, isVideo, school_id) VALUES (:url, :isVideo, :schoolId)";
                $params = [
                    "url" => $imageName,
                    "isVideo" => 0,
                    "schoolId" => $schoolId
                ];

                $this->query($query, $params);

            }

    }

}