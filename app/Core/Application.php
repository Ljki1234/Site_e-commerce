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
        session_name($this->config['session']['name'] ?? 'webdev_session');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->router->dispatch();
    }
}
