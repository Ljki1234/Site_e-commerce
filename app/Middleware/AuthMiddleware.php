<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;

class AuthMiddleware
{
    public function handle(Request $request, callable $next)
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: ' . base_url('login'));
            exit;
        }
        return $next($request);
    }
}
