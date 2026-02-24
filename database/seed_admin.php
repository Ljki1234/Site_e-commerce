<?php
// Run once: php database/seed_admin.php
// Sets admin password to admin123
$config = require __DIR__ . '/../config/app.php';
$db = $config['database'] ?? $config;
$pdo = new PDO(
    'mysql:host=' . ($db['host'] ?? 'localhost') . ';dbname=' . ($db['dbname'] ?? 'webdev_agency'),
    $db['user'] ?? 'root',
    $db['password'] ?? ''
);
$hash = password_hash('admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = 'admin@webdevagency.com'");
$stmt->execute([$hash]);
echo "Admin password set to admin123.\n";
