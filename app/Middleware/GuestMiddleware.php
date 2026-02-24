<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Core\Request;

class GuestMiddleware
{
    public function handle(Request $request, callable $next)
    {
        if (!empty($_SESSION['user_id'])) {
            $redirect = ($_SESSION['role'] ?? '') === 'admin' ? base_url('admin') : base_url();
            header('Location: ' . $redirect);
            exit;
        }
        return $next($request);
    }
}
