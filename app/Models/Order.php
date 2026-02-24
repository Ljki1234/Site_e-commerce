<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class Order
{
    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            INSERT INTO orders (user_id, pack_id, total_amount, requirements_file, notes)
            VALUES (?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['user_id'],
            $data['pack_id'],
            $data['total_amount'],
            $data['requirements_file'] ?? null,
            $data['notes'] ?? null,
        ]);
        $orderId = (int) $db->lastInsertId();
        if (!empty($data['create_invoice'])) {
            self::createInvoiceForOrder($orderId, $data['total_amount']);
        }
        return $orderId;
    }

    public static function createInvoiceForOrder(int $orderId, float $amount): int
    {
        $db = Database::getInstance();
        $num = 'INV-' . date('Ymd') . '-' . str_pad((string)$orderId, 4, '0', STR_PAD_LEFT);
        $due = date('Y-m-d', strtotime('+14 days'));
        $stmt = $db->prepare('INSERT INTO invoices (order_id, invoice_number, amount, status, due_date) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$orderId, $num, $amount, 'sent', $due]);
        return (int) $db->lastInsertId();
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            SELECT o.*, p.name AS pack_name, p.slug AS pack_slug
            FROM orders o
            JOIN service_packs p ON p.id = o.pack_id
            WHERE o.id = ?
        ');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    /** For admin order detail: same as findById but includes client_name, client_email */
    public static function findByIdWithClient(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            SELECT o.*, p.name AS pack_name, p.slug AS pack_slug,
                   u.full_name AS client_name, u.email AS client_email
            FROM orders o
            JOIN service_packs p ON p.id = o.pack_id
            LEFT JOIN users u ON u.id = o.user_id
            WHERE o.id = ?
        ');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function findByUser(int $userId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            SELECT o.*, p.name AS pack_name
            FROM orders o
            JOIN service_packs p ON p.id = o.pack_id
            WHERE o.user_id = ?
            ORDER BY o.created_at DESC
        ');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public static function all(string $status = null): array
    {
        $db = Database::getInstance();
        $sql = 'SELECT o.*, p.name AS pack_name, u.full_name AS client_name, u.email AS client_email
                FROM orders o
                JOIN service_packs p ON p.id = o.pack_id
                JOIN users u ON u.id = o.user_id
                WHERE 1=1';
        $params = [];
        if ($status) {
            $sql .= ' AND o.status = ?';
            $params[] = $status;
        }
        $sql .= ' ORDER BY o.created_at DESC';
        $stmt = $params ? $db->prepare($sql) : $db->query($sql);
        if ($params) {
            $stmt->execute($params);
        }
        return $stmt->fetchAll();
    }

    public static function update(int $id, array $data): bool
    {
        $allowed = ['status', 'deadline', 'deliverables_file', 'notes'];
        $set = [];
        $values = [];
        foreach ($allowed as $k) {
            if (array_key_exists($k, $data)) {
                $set[] = "{$k} = ?";
                $values[] = $data[$k];
            }
        }
        if (empty($set)) {
            return true;
        }
        $values[] = $id;
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE orders SET ' . implode(', ', $set) . ' WHERE id = ?');
        return $stmt->execute($values);
    }

    public static function countByStatus(string $status = null): int
    {
        $db = Database::getInstance();
        if ($status) {
            $stmt = $db->prepare('SELECT COUNT(*) FROM orders WHERE status = ?');
            $stmt->execute([$status]);
        } else {
            $stmt = $db->query('SELECT COUNT(*) FROM orders');
        }
        return (int) $stmt->fetchColumn();
    }

    public static function totalRevenue(): float
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE status = "completed"');
        return (float) $stmt->fetchColumn();
    }

    public static function monthlyRevenue(int $months = 6): array
    {
        $db = Database::getInstance();
        $stmt = $db->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(total_amount) AS total
            FROM orders
            WHERE status = 'completed' AND created_at >= DATE_SUB(CURDATE(), INTERVAL {$months} MONTH)
            GROUP BY DATE_FORMAT(created_at, '%Y-%m')
            ORDER BY month ASC
        ");
        return $stmt->fetchAll();
    }
}
