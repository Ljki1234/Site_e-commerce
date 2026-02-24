<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class AdminNote
{
    public static function getForUser(int $userId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            SELECT n.*, u.full_name AS author_name
            FROM admin_notes n
            JOIN users u ON u.id = n.author_id
            WHERE n.user_id = ?
            ORDER BY n.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function add(int $userId, int $authorId, string $note): int
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO admin_notes (user_id, author_id, note) VALUES (?, ?, ?)');
        $stmt->execute([$userId, $authorId, $note]);
        return (int) $db->lastInsertId();
    }
}
