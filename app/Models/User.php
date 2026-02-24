<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    public static function findById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('
            INSERT INTO users (email, password, full_name, company, phone, role, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['full_name'],
            $data['company'] ?? null,
            $data['phone'] ?? null,
            $data['role'] ?? 'client',
            $data['status'] ?? 'lead',
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $allowed = ['full_name', 'company', 'phone', 'status'];
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
        $stmt = $db->prepare('UPDATE users SET ' . implode(', ', $set) . ' WHERE id = ?');
        return $stmt->execute($values);
    }

    public static function updatePassword(int $id, string $newPassword): bool
    {
        $db = Database::getInstance();
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([$hash, $id]);
    }

    public static function allClients(): array
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT * FROM users WHERE role = "client" ORDER BY created_at DESC');
        return $stmt->fetchAll();
    }

    public static function countByRole(string $role): int
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE role = ?');
        $stmt->execute([$role]);
        return (int) $stmt->fetchColumn();
    }
}
