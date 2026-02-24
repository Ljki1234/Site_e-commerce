<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

class PortfolioItem
{
    public static function all(bool $activeOnly = true): array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM portfolio_items';
        if ($activeOnly) {
            $sql .= ' WHERE is_active = 1';
        }
        $sql .= ' ORDER BY sort_order ASC, id ASC';
        $stmt = $db->query($sql);
        return $stmt->fetchAll();
    }
}
