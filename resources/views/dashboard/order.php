<?php
$content = ob_start();
$status = $order['status'];
$statusClass = $status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($status === 'in_progress' ? 'bg-blue-100 text-blue-800' : ($status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-slate-100 text-slate-700'));
?>
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 mb-6">
        <div class="flex flex-wrap justify-between items-start gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Order #<?= (int)$order['id'] ?></h2>
                <p class="text-slate-600 mt-1"><?= htmlspecialchars($order['pack_name']) ?></p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium <?= $statusClass ?>"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $status))) ?></span>
        </div>
        <dl class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm text-slate-500">Amount</dt>
                <dd class="font-medium text-slate-900">$<?= number_format((float)$order['total_amount'], 2) ?></dd>
            </div>
            <div>
                <dt class="text-sm text-slate-500">Placed on</dt>
                <dd class="font-medium text-slate-900"><?= date('F j, Y', strtotime($order['created_at'])) ?></dd>
            </div>
            <?php if (!empty($order['deadline'])): ?>
            <div>
                <dt class="text-sm text-slate-500">Deadline</dt>
                <dd class="font-medium text-slate-900"><?= date('F j, Y', strtotime($order['deadline'])) ?></dd>
            </div>
            <?php endif; ?>
        </dl>
        <?php if (!empty($order['deliverables_file'])): ?>
        <div class="mt-6 pt-6 border-t border-slate-100">
            <a href="<?= base_url('dashboard/orders/' . $order['id'] . '/download') ?>" class="inline-flex items-center px-4 py-2 rounded-lg font-medium bg-primary-500 text-white hover:bg-primary-600 transition">Download deliverables</a>
        </div>
        <?php endif; ?>
    </div>
    <?php if (!empty($order['notes'])): ?>
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
        <h3 class="font-semibold text-slate-900">Admin notes</h3>
        <p class="mt-2 text-slate-600"><?= nl2br(htmlspecialchars($order['notes'])) ?></p>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/dashboard.php';
