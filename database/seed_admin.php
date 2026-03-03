<?php
// Run once: php database/seed_admin.php
// Sets admin password to admin123
declare(strict_types=1);

$config = require __DIR__ . '/../config/app.php';
$db = $config['database'] ?? $config;

try {
    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $db['host'] ?? 'localhost',
        $db['dbname'] ?? 'webdev_agency',
        $db['charset'] ?? 'utf8mb4'
    );
    $pdo = new PDO(
        $dsn,
        $db['user'] ?? '',
        $db['password'] ?? ''
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::MYSQL_ATTR_MULTI_STATEMENTS, false);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    fwrite(STDERR, 'Failed to connect to database: ' . $e->getMessage() . PHP_EOL);
    exit(1);
}
$hash = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@webdevagency.com'");
$stmt->execute([$hash]);
echo "Admin password set to admin123.\n";
