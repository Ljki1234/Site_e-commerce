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
            try {
                self::$instance = new PDO(
                    $dsn,
                    $c['user'] ?? '',
                    $c['password'] ?? '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                    ]
                );
            } catch (PDOException $e) {
                // Centralize connection error handling.
                throw new PDOException('Database connection failed: ' . $e->getMessage(), (int) $e->getCode(), $e);
            }
        }
        return self::$instance;
    }

    /**
     * Centralized helper to execute parameterized queries using prepared statements.
     */
    public static function run(string $sql, array $params = []): \PDOStatement
    {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
