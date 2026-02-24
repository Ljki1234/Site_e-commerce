<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;
    private static array $config = [];

    public static function setConfig(array $config): void
    {
        self::$config = $config['database'] ?? $config;
    }

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $c = self::$config;
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $c['host'] ?? 'localhost',
                $c['dbname'] ?? 'webdev_agency',
                $c['charset'] ?? 'utf8mb4'
            );
            self::$instance = new PDO($dsn, $c['user'] ?? 'root', $c['password'] ?? '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$instance;
    }
}
