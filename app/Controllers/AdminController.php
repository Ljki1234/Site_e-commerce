<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Models\ServicePack;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\AdminNote;

class AdminController extends Controller
{
    public function index(): void
    {
        $revenue = Order::totalRevenue();
        $clients = User::countByRole('client');
        $activeOrders = Order::countByStatus('in_progress') + Order::countByStatus('pending');
        $completedOrders = Order::countByStatus('completed');
        $monthly = Order::monthlyRevenue(6);
        $recentOrders = array_slice(Order::all(), 0, 5);

        $this->view('admin.index', [
            'pageTitle' => '',
            'revenue' => $revenue,
            'clients' => $clients,
            'activeOrders' => $activeOrders,
            'completedOrders' => $completedOrders,
            'monthly' => $monthly,
            'recentOrders' => $recentOrders,
        ]);
    }

    public function packs(): void
    {
        $packs = ServicePack::all(false);
        $this->view('admin.packs', ['pageTitle' => '', 'packs' => $packs]);
    }

    public function packForm(int $id = 0): void
    {
        $pack = $id ? ServicePack::findById($id) : null;
        $this->view('admin.pack-form', ['pageTitle' => '', 'pack' => $pack]);
    }

    public function packSave(Request $request, int $id = 0): void
    {
        $name = trim((string) $request->input('name'));
        $slug = trim((string) $request->input('slug'));
        $description = trim((string) $request->input('description'));
        $price = (float) $request->input('price');
        $is_active = (int) $request->input('is_active', 1);
        $sort_order = (int) $request->input('sort_order', 0);
        $featuresStr = trim((string) $request->input('features'));
        $features = array_filter(array_map('trim', explode("\n", $featuresStr)));

        if ($name === '') {
            $this->redirect(base_url('admin/packs'));
            return;
        }
        if ($slug === '') {
            $slug = ServicePack::slugify($name);
        }

        if ($id) {
            ServicePack::update($id, [
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'price' => $price,
                'is_active' => $is_active,
                'sort_order' => $sort_order,
                'features' => $features,
            ]);
        } else {
            ServicePack::create([
                'name' => $name,
                'slug' => $slug,
                'description' => $description,
                'price' => $price,
                'is_active' => $is_active,
                'sort_order' => $sort_order,
                'features' => $features,
            ]);
        }
        $this->redirect(base_url('admin/packs'));
    }

    public function packDelete(int $id): void
    {
        ServicePack::delete($id);
        $this->redirect(base_url('admin/packs'));
    }

    public function clients(): void
    {
        $clients = User::allClients();
        $this->view('admin.clients', ['pageTitle' => '', 'clients' => $clients]);
    }

    public function clientDetail(int $id): void
    {
        $client = User::findById($id);
        if (!$client || $client['role'] !== 'client') {
            $this->redirect(base_url('admin/clients'));
            return;
        }
        $orders = Order::findByUser($id);
        $notes = AdminNote::getForUser($id);
        $this->view('admin.client-detail', [
            'pageTitle' => '',
            'client' => $client,
            'orders' => $orders,
            'notes' => $notes,
        ]);
    }

    public function clientUpdateStatus(Request $request, int $id): void
    {
        $status = (string) $request->input('status');
        if (in_array($status, ['lead', 'active', 'vip'], true)) {
            User::update($id, ['status' => $status]);
        }
        $this->redirect(base_url('admin/clients/' . $id));
    }

    public function clientAddNote(Request $request, int $id): void
    {
        $note = trim((string) $request->input('note'));
        if ($note !== '') {
            AdminNote::add($id, (int) $_SESSION['user_id'], $note);
        }
        $this->redirect(base_url('admin/clients/' . $id));
    }

    public function orders(): void
    {
        $orders = Order::all();
        $this->view('admin.orders', ['pageTitle' => '', 'orders' => $orders]);
    }

    public function orderDetail(int $id): void
    {
        $order = Order::findByIdWithClient($id);
        if (!$order) {
            $this->redirect(base_url('admin/orders'));
            return;
        }
        $invoices = Invoice::findByOrder($id);
        $this->view('admin.order-detail', [
            'pageTitle' => '',
            'order' => $order,
            'invoices' => $invoices,
        ]);
    }

    public function orderUpdate(Request $request, int $id): void
    {
        $data = [];
        if ($request->has('status')) {
            $data['status'] = $request->input('status');
        }
        if ($request->has('deadline')) {
            $data['deadline'] = $request->input('deadline') ?: null;
        }
        if ($request->has('notes')) {
            $data['notes'] = $request->input('notes');
        }

        $file = $request->file('deliverables_file');
        if ($file && $file['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
            $dir = ROOT_PATH . '/storage/uploads';
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'zip';
            $name = 'delivery_' . $id . '_' . time() . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
                $data['deliverables_file'] = $name;
            }
        }

        if (!empty($data)) {
            Order::update($id, $data);
        }
        $this->redirect(base_url('admin/orders/' . $id));
    }

    public function messages(): void
    {
        $messages = Message::all();
        $this->view('admin.messages', ['pageTitle' => '', 'messages' => $messages]);
    }
}
