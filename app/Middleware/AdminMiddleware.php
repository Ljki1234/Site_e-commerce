<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;

class AdminMiddleware
{
    public function handle(Request $request, callable $next)
    {
        if (empty($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
            header('Location: ' . base_url('login'));
            exit;
        }
        return $next($request);
    }
}
