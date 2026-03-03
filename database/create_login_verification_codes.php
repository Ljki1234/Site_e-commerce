<?php
/**
 * One-time script: create login_verification_codes table (MFA).
 * Run from project root: php database/create_login_verification_codes.php
 */
declare(strict_types=1);

$config = require __DIR__ . '/../config/app.php';
$c = $config['database'] ?? [];
$dsn = sprintf(
    'mysql:host=%s;dbname=%s;charset=%s',
    $c['host'] ?? 'localhost',
    $c['dbname'] ?? 'webdev_agency',
    $c['charset'] ?? 'utf8mb4'
);
try {
    $pdo = new PDO($dsn, $c['user'] ?? '', $c['password'] ?? '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ]);
} catch (PDOException $e) {
    fwrite(STDERR, 'Failed to connect to database: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}

$sql = "CREATE TABLE IF NOT EXISTS login_verification_codes (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    code CHAR(6) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_expires (expires_at)
) ENGINE=InnoDB";

$pdo->exec($sql);
echo "Table login_verification_codes created successfully.\n";
