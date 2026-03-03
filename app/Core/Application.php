<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Router;
use App\Core\Database;

class Application
{
    private Router $router;
    private array $config;

    public function __construct()
    {
        $this->config = require ROOT_PATH . '/config/app.php';
        $this->router = new Router();
        $this->registerRoutes();
    }

    private function registerRoutes(): void
    {
        $routes = require ROOT_PATH . '/routes/web.php';
        $routes($this->router);
    }

    public function run(): void
    {
        $sessionName = $this->config['session']['name'] ?? 'webdev_session';
        $lifetime = (int)($this->config['session']['lifetime'] ?? 7200);

        // Force fully secure session cookie for webdev_session
        session_name($sessionName);
        session_set_cookie_params([
            'lifetime' => $lifetime,
            'path' => '/',
            'domain' => '',
            'secure' => true,        // only sent over HTTPS
            'httponly' => true,      // not accessible via JavaScript
            'samesite' => 'Strict',  // prevent all cross-site sends
        ]);
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_secure', '1');
        ini_set('session.cookie_samesite', 'Strict');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Session inactivity timeout (15 minutes)
        $now = time();
        $timeout = 900;
        if (!empty($_SESSION['last_activity']) && ($now - (int)$_SESSION['last_activity']) > $timeout) {
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $p = session_get_cookie_params();
                setcookie(session_name(), '', $now - 42000, $p['path'], $p['domain'], (bool) $p['secure'], (bool) $p['httponly']);
            }
            session_destroy();
            session_start();
        }
        $_SESSION['last_activity'] = $now;

        // Global security headers
        header('X-Frame-Options: DENY');
        header('X-Content-Type-Options: nosniff');
        header("Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.tailwindcss.com https://cdn.jsdelivr.net https://www.google.com https://www.gstatic.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https://images.unsplash.com; connect-src 'self' https://www.google.com https://www.gstatic.com; frame-src https://www.google.com https://www.gstatic.com; frame-ancestors 'none';");

        // If you deploy only over HTTPS, HSTS is recommended; adjust as needed.
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

        $this->router->dispatch();
    }
}
