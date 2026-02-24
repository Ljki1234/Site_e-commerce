<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class Invoice
{
    public static function findByOrder(int $orderId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM invoices WHERE order_id = ? ORDER BY created_at DESC');
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    public static function findByUser(int $userId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            SELECT i.*, o.id AS order_id
            FROM invoices i
            JOIN orders o ON o.id = i.order_id
            WHERE o.user_id = ?
            ORDER BY i.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM invoices WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }
}
