<?php


class Database
{
    const HOST = 'localhost';
    const USER = 'user';
    const PASSWORD = 'pass';
    const DATABASE_NAME = 'database';

    private static ?Database $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public function getConnection()
    {
        $dsn = sprintf("mysql:host=%s;dbname=%s", self::HOST, self::DATABASE_NAME);
        return new \PDO($dsn, self::USER, self::PASSWORD);
    }
}

// usage
$db = Database::getInstance();
$connection = $db->getConnection();