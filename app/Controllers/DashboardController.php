<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;

class DashboardController extends Controller
{
    public function index(): void
    {
        $userId = (int) $_SESSION['user_id'];
        $user = User::findById($userId);
        $orders = Order::findByUser($userId);
        $invoices = Invoice::findByUser($userId);

        $this->view('dashboard.index', [
            'pageTitle' => 'Dashboard',
            'user' => $user,
            'orders' => $orders,
            'invoices' => $invoices,
        ]);
    }

    public function profile(): void
    {
        $userId = (int) $_SESSION['user_id'];
        $user = User::findById($userId);
        $this->view('dashboard.profile', ['pageTitle' => 'Profile', 'user' => $user]);
    }

    public function updateProfile(Request $request): void
    {
        $userId = (int) $_SESSION['user_id'];
        $full_name = trim((string) $request->input('full_name'));
        $company = trim((string) $request->input('company'));
        $phone = trim((string) $request->input('phone'));
        if ($full_name !== '') {
            User::update($userId, [
                'full_name' => $full_name,
                'company' => $company ?: null,
                'phone' => $phone ?: null,
            ]);
        }
        $this->redirect(base_url('dashboard/profile?updated=1'));
    }

    public function order(int $id): void
    {
        $userId = (int) $_SESSION['user_id'];
        $order = Order::findById($id);
        if (!$order || (int) $order['user_id'] !== $userId) {
            $this->redirect(base_url('dashboard'));
            return;
        }
        $this->view('dashboard.order', ['pageTitle' => 'Order #' . $id, 'order' => $order]);
    }

    public function downloadDeliverable(int $id): void
    {
        $userId = (int) $_SESSION['user_id'];
        $order = Order::findById($id);
        if (!$order || (int) $order['user_id'] !== $userId || empty($order['deliverables_file'])) {
            $this->redirect(base_url('dashboard'));
            return;
        }
        $path = ROOT_PATH . '/storage/uploads/' . $order['deliverables_file'];
        if (!is_file($path)) {
            $this->redirect(base_url('dashboard'));
            return;
        }
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($order['deliverables_file']) . '"');
        readfile($path);
        exit;
    }
}
