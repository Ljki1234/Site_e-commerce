<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\Order;
use App\Models\ServicePack;
use App\Models\Invoice;
use App\Services\PayPal;

class OrderController extends Controller
{
    /**
     * Start PayPal flow: validate pack, save order data to session, create PayPal order, redirect to PayPal.
     */
    public function initiate(Request $request): void
    {
        $packId = (int) $request->input('pack_id');
        $pack = ServicePack::findById($packId);
        if (!$pack || !$pack['is_active']) {
            $this->redirect(base_url('packs'));
            return;
        }
        $userId = (int) $_SESSION['user_id'];
        $notes = trim((string) $request->input('notes'));
        $requirementsFile = null;
        $file = $request->file('requirements_file');
        if ($file && $file['error'] === UPLOAD_ERR_OK && is_uploaded_file($file['tmp_name'])) {
            $dir = ROOT_PATH . '/storage/uploads';
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION) ?: 'bin';
            $name = 'req_' . $userId . '_' . time() . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $dir . '/' . $name)) {
                $requirementsFile = $name;
            }
        }
        $amount = (float) $pack['price'];
        $_SESSION['paypal_pending'] = [
            'user_id' => $userId,
            'pack_id' => $packId,
            'total_amount' => $amount,
            'requirements_file' => $requirementsFile,
            'notes' => $notes ?: null,
            'pack_name' => $pack['name'] ?? 'Order',
        ];

        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.client_secret');
        $sandbox = config('paypal.sandbox', true);
        if (empty($clientSecret)) {
            $_SESSION['paypal_error'] = 'PayPal is not configured. Add client_secret in config/app.php.';
            $this->redirect(base_url('packs'));
            return;
        }
        try {
            $paypal = new PayPal($clientId, $clientSecret, $sandbox);
            $returnUrl = base_url('order/paypal/return');
            $cancelUrl = base_url('order/paypal/cancel');
            $result = $paypal->createOrder($amount, $returnUrl, $cancelUrl, 'Pack: ' . ($pack['name'] ?? 'Order'));
            $this->redirect($result['approve_url']);
        } catch (\Throwable $e) {
            $_SESSION['paypal_error'] = $e->getMessage();
            $this->redirect(base_url('packs'));
        }
    }

    /**
     * PayPal return: capture payment then create order in DB and redirect to dashboard.
     */
    public function paypalReturn(Request $request): void
    {
        $token = trim((string) $request->input('token'));
        $pending = $_SESSION['paypal_pending'] ?? null;
        unset($_SESSION['paypal_pending']);
        if (!$token || !$pending || (int)($pending['user_id'] ?? 0) !== (int)($_SESSION['user_id'] ?? 0)) {
            $this->redirect(base_url('packs'));
            return;
        }
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.client_secret');
        $sandbox = config('paypal.sandbox', true);
        if (empty($clientSecret)) {
            $this->redirect(base_url('packs'));
            return;
        }
        try {
            $paypal = new PayPal($clientId, $clientSecret, $sandbox);
            if (!$paypal->captureOrder($token)) {
                $_SESSION['paypal_error'] = 'Payment capture failed.';
                $this->redirect(base_url('packs'));
                return;
            }
        } catch (\Throwable $e) {
            $_SESSION['paypal_error'] = $e->getMessage();
            $this->redirect(base_url('packs'));
            return;
        }
        Order::create([
            'user_id' => $pending['user_id'],
            'pack_id' => $pending['pack_id'],
            'total_amount' => $pending['total_amount'],
            'requirements_file' => $pending['requirements_file'] ?? null,
            'notes' => $pending['notes'] ?? null,
            'create_invoice' => true,
        ]);
        $this->redirect(base_url('dashboard?ordered=1'));
    }

    /**
     * User cancelled on PayPal.
     */
    public function paypalCancel(): void
    {
        unset($_SESSION['paypal_pending']);
        $this->redirect(base_url('packs'));
    }
}
