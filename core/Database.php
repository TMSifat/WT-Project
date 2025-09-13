<?php
class Database
{
    private static $instance = null;
    private $conn;

    private function __construct(array $config)
    {
        $this->conn = mysqli_connect(
            $config['host'] ?? 'localhost',
            $config['user'] ?? 'root',
            $config['pass'] ?? '',
            $config['name'] ?? ''
        );

        if (!$this->conn) {
            die('Database connection failed: ' . mysqli_connect_error());
        }

        if (!empty($config['charset'])) {
            mysqli_set_charset($this->conn, $config['charset']);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config/config.php';
            self::$instance = new self($config['db'] ?? []);
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

