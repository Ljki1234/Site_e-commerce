<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

class PasswordResetCode
{
    /** Generate and store a 6-digit code for the given email. Returns the code (for dev/testing or email body). */
    public static function create(string $email, int $validMinutes = 15): string
    {
        $db = Database::getInstance();
        $db->prepare('DELETE FROM password_reset_codes WHERE email = ?')->execute([$email]);
        $code = (string) random_int(100000, 999999);
        $stmt = $db->prepare('INSERT INTO password_reset_codes (email, code, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE))');
        $stmt->execute([$email, $code, $validMinutes]);
        return $code;
    }

    /** Verify the code for the given email. Returns true if valid. Deletes the code after use. */
    public static function verify(string $email, string $code): bool
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT id FROM password_reset_codes WHERE email = ? AND code = ? AND expires_at > NOW() LIMIT 1');
        $stmt->execute([$email, $code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        $del = $db->prepare('DELETE FROM password_reset_codes WHERE email = ? AND code = ?');
        $del->execute([$email, $code]);
        return true;
    }
}
