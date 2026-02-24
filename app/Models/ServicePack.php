<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class ServicePack
{
    public static function all(bool $activeOnly = false): array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM service_packs';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY sort_order ASC, id ASC';
        $stmt = $db->query($sql);
        $rows = $stmt->fetchAll();
        foreach ($rows as &$r) {
            if (!empty($r['features'])) {
                $r['features'] = json_decode($r['features'], true) ?? [];
            }
        }
        return $rows;
    }

    public static function findById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM service_packs WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if ($row && !empty($row['features'])) {
            $row['features'] = json_decode($row['features'], true) ?? [];
        }
        return $row ?: null;
    }

    public static function findBySlug(string $slug): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM service_packs WHERE slug = ? AND is_active = 1');
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        if ($row && !empty($row['features'])) {
            $row['features'] = json_decode($row['features'], true) ?? [];
        }
        return $row ?: null;
    }

    public static function create(array $data): int
    {
        $db = Database::getInstance();
        $features = isset($data['features']) ? json_encode($data['features']) : null;
        $stmt = $db->prepare('
            INSERT INTO service_packs (name, slug, description, price, features, is_active, sort_order)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $stmt->execute([
            $data['name'],
            $data['slug'] ?? self::slugify($data['name']),
            $data['description'] ?? null,
            $data['price'],
            $features,
            $data['is_active'] ?? 1,
            $data['sort_order'] ?? 0,
        ]);
        return (int) $db->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $fields = ['name', 'slug', 'description', 'price', 'features', 'is_active', 'sort_order'];
        $set = [];
        $values = [];
        foreach ($fields as $f) {
            if (array_key_exists($f, $data)) {
                $set[] = "{$f} = ?";
                $values[] = $f === 'features' ? (is_array($data[$f]) ? json_encode($data[$f]) : $data[$f]) : $data[$f];
            }
        }
        if (empty($set)) {
            return true;
        }
        $values[] = $id;
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE service_packs SET ' . implode(', ', $set) . ' WHERE id = ?');
        return $stmt->execute($values);
    }

    public static function delete(int $id): bool
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('DELETE FROM service_packs WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Extract support duration in months from pack features (e.g. "1 Month Support", "3 Months Support").
     */
    public static function getSupportMonths(array $pack): int
    {
        $features = $pack['features'] ?? [];
        if (is_string($features)) {
            $features = json_decode($features, true) ?? [];
        }
        foreach ((array) $features as $f) {
            if (preg_match('/^(\d+)\s*Month(s)?\s+Support$/i', trim((string) $f), $m)) {
                return (int) $m[1];
            }
        }
        return 0;
    }

    public static function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = strtolower(trim($text, '-'));
        return $text ?: 'pack';
    }
}
