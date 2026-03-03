<?php
declare(strict_types=1);

return [
    'name' => 'AtlasTech Solutions',
    'env' => 'development',
    'url' => 'http://localhost/e-commerce/public',
    'timezone' => 'UTC',
    'database' => [
        'host' => 'localhost',
        'dbname' => 'webdev_agency',
        'charset' => 'utf8mb4',
        'user' => 'root',
        'password' => '',
    ],
    'session' => [
        'name' => 'webdev_session',
        'lifetime' => 7200,
    ],
    'mail' => [
        'from_email' => 'eljabikihind@gmail.com',
        'from_name' => 'V Agency',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => 587,
        'smtp_username' => 'eljabikihind@gmail.com',
        'smtp_password' => 'oghnfkaqpmdbywxb', // Mot de passe d'application Gmail
        'smtp_encryption' => 'tls',
    ],
    'paypal' => [
        'client_id' => 'ASx5Y7jzxLrBdNrfQuGvQ-WVSacHqDDRwzf34_ssgg0hHLrkh3EMpxMn_vL2ox1qbYmqHc5az9-PSODU',
        'client_secret' => 'EFQ-NwWOeIED4e1bZtT5xLQfkVZyhCboRRhgGisydNkwc3J-YFlS5AwMH1SD_iiCEwPY8oki8uuUS4ZJ',
        'sandbox' => true,
    ],
    // Google reCAPTCHA v3 (invisible). Get keys: https://www.google.com/recaptcha/admin
    'recaptcha' => [
        'site_key' => '6LeBz34sAAAAAO3Dt29TksK9F9JpNaeQ-XhvPwqS',   // Public key for frontend (safe in HTML/JS)
        'secret_key' => '6LeBz34sAAAAAGppXdXeBcXf6qfK290bZ9RdwXrL', // Secret key for server-side verification only
        'min_score' => 0.5, // Reject if score below this (0.0 = bot, 1.0 = human)
    ],
];
