<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class Message
{
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO messages (user_id, name, email, subject, body) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['user_id'] ?? null,
            $data['name'],
            $data['email'],
            $data['subject'],
            $data['body'],
        ]);
        return (int) $db->lastInsertId();
    }

    public static function all(): array
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT * FROM messages ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }
}
