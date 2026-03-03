<?php
declare(strict_types=1);

use App\Core\Database;

require __DIR__ . '/../bootstrap.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Read JSON body
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

if (!is_array($data) || !isset($data['message'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid payload']);
    exit;
}

// Sanitize input
$message = trim(strip_tags((string) $data['message']));

if ($message === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Please enter a message.']);
    exit;
}

if (mb_strlen($message) > 255) {
    $message = mb_substr($message, 0, 255);
}

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Rate limiting: 10 requests / minute / IP
try {
    $stmt = Database::run(
        'SELECT COUNT(*) AS cnt FROM chat_logs WHERE ip_address = :ip AND created_at >= (NOW() - INTERVAL 1 MINUTE)',
        ['ip' => $ip]
    );
    $row = $stmt->fetch();
    if ($row && (int)($row['cnt'] ?? 0) >= 10) {
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Too many requests. Please try again in a minute.',
        ]);
        exit;
    }
} catch (Throwable $e) {
    // If rate limit check fails, continue but you may want to log the error.
}

// Search in FAQs
$botResponse = null;

try {
    $like = '%' . $message . '%';
    // Use distinct named parameters for MySQL native driver
    $stmt = Database::run(
        'SELECT answer FROM faqs WHERE question LIKE :q1 OR answer LIKE :q2 ORDER BY id ASC LIMIT 1',
        ['q1' => $like, 'q2' => $like]
    );
    $faq = $stmt->fetch();
    if ($faq && isset($faq['answer'])) {
        $botResponse = (string) $faq['answer'];
    } else {
        $botResponse = "I'm not sure about that yet. You can ask about our services, packages, pricing or contact options, or visit our Contact page.";
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error processing your request.']);
    exit;
}

// Log interaction
try {
    Database::run(
        'INSERT INTO chat_logs (user_message, bot_response, ip_address, created_at) VALUES (:um, :br, :ip, NOW())',
        [
            'um' => $message,
            'br' => $botResponse,
            'ip' => $ip,
        ]
    );
} catch (Throwable $e) {
    // Logging failure should not break the response
}

echo json_encode([
    'success'      => true,
    'user_message' => $message,
    'bot_response' => $botResponse,
]);

