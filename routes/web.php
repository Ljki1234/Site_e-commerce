<?php
declare(strict_types=1);

use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminMiddleware;
use App\Middleware\GuestMiddleware;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Controllers\OrderController;
use App\Controllers\DashboardController;
use App\Controllers\AdminController;

return function (Router $r): void {
    $r->get('/', [HomeController::class, 'index']);
    $r->get('/services', [PageController::class, 'services']);
    $r->get('/packs', [PageController::class, 'packs']);
    $r->get('/portfolio', [PageController::class, 'portfolio']);
    $r->get('/contact', [PageController::class, 'contact']);
    $r->post('/contact', [PageController::class, 'submitContact']);

    $r->get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
    $r->post('/login', [AuthController::class, 'login'], [GuestMiddleware::class]);
    $r->get('/login/verify', [AuthController::class, 'showLoginVerify'], [GuestMiddleware::class]);
    $r->post('/login/verify', [AuthController::class, 'verifyLogin'], [GuestMiddleware::class]);
    $r->get('/register', [AuthController::class, 'showRegister'], [GuestMiddleware::class]);
    $r->post('/register', [AuthController::class, 'register'], [GuestMiddleware::class]);
    $r->get('/logout', [AuthController::class, 'logout']);
    $r->get('/forgot-password', [AuthController::class, 'showForgotPassword'], [GuestMiddleware::class]);
    $r->post('/forgot-password', [AuthController::class, 'sendResetCode'], [GuestMiddleware::class]);
    $r->get('/reset-password', [AuthController::class, 'showResetPassword'], [GuestMiddleware::class]);
    $r->post('/reset-password', [AuthController::class, 'resetPassword'], [GuestMiddleware::class]);

    // Client dashboard
    $r->get('/dashboard', [DashboardController::class, 'index'], [AuthMiddleware::class]);
    $r->get('/dashboard/profile', [DashboardController::class, 'profile'], [AuthMiddleware::class]);
    $r->post('/dashboard/profile', [DashboardController::class, 'updateProfile'], [AuthMiddleware::class]);
    $r->get('/dashboard/orders/{id}', [DashboardController::class, 'order'], [AuthMiddleware::class]);
    $r->get('/dashboard/orders/{id}/download', [DashboardController::class, 'downloadDeliverable'], [AuthMiddleware::class]);

    // Order: PayPal flow (requires auth)
    $r->post('/order/initiate', [OrderController::class, 'initiate'], [AuthMiddleware::class]);
    $r->get('/order/paypal/return', [OrderController::class, 'paypalReturn'], [AuthMiddleware::class]);
    $r->get('/order/paypal/cancel', [OrderController::class, 'paypalCancel'], [AuthMiddleware::class]);

    // Admin
    $r->get('/admin', [AdminController::class, 'index'], [AdminMiddleware::class]);
    $r->get('/admin/packs', [AdminController::class, 'packs'], [AdminMiddleware::class]);
    $r->get('/admin/packs/new', [AdminController::class, 'packForm'], [AdminMiddleware::class]);
    $r->get('/admin/packs/{id}', [AdminController::class, 'packForm'], [AdminMiddleware::class]);
    $r->post('/admin/packs/save', [AdminController::class, 'packSave'], [AdminMiddleware::class]);
    $r->post('/admin/packs/save/{id}', [AdminController::class, 'packSave'], [AdminMiddleware::class]);
    $r->post('/admin/packs/delete/{id}', [AdminController::class, 'packDelete'], [AdminMiddleware::class]);
    $r->get('/admin/clients', [AdminController::class, 'clients'], [AdminMiddleware::class]);
    $r->get('/admin/clients/{id}', [AdminController::class, 'clientDetail'], [AdminMiddleware::class]);
    $r->post('/admin/clients/{id}/status', [AdminController::class, 'clientUpdateStatus'], [AdminMiddleware::class]);
    $r->post('/admin/clients/{id}/note', [AdminController::class, 'clientAddNote'], [AdminMiddleware::class]);
    $r->get('/admin/orders', [AdminController::class, 'orders'], [AdminMiddleware::class]);
    $r->get('/admin/orders/{id}', [AdminController::class, 'orderDetail'], [AdminMiddleware::class]);
    $r->post('/admin/orders/{id}', [AdminController::class, 'orderUpdate'], [AdminMiddleware::class]);
    $r->get('/admin/messages', [AdminController::class, 'messages'], [AdminMiddleware::class]);
};
