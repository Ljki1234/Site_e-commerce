<?php
$content = ob_start();
$order = $order ?? [];
$invoices = $invoices ?? [];
?>
<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <a href="<?= base_url('admin/orders') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to orders
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Order details card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-[#0f172a]">Order #<?= (int)$order['id'] ?></h2>
                <?php
                $status = $order['status'] ?? 'pending';
                $badgeClass = $status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($status === 'in_progress' ? 'bg-sky-100 text-sky-800' : ($status === 'cancelled' ? 'bg-slate-100 text-slate-600' : 'bg-amber-100 text-amber-800'));
                ?>
                <span class="inline-flex mt-2 px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Client</dt>
                        <dd class="mt-1 text-sm font-medium text-[#0f172a]"><?= htmlspecialchars($order['client_name'] ?? '—') ?></dd>
                        <dd class="text-sm text-slate-600"><?= htmlspecialchars($order['client_email'] ?? '—') ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pack</dt>
                        <dd class="mt-1 text-sm font-medium text-[#0f172a]"><?= htmlspecialchars($order['pack_name'] ?? '—') ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</dt>
                        <dd class="mt-1 text-lg font-bold text-[#0f172a]">$<?= number_format((float)($order['total_amount'] ?? 0), 2) ?></dd>
                    </div>
                    <?php if (!empty($order['created_at'])): ?>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Created</dt>
                        <dd class="mt-1 text-sm text-slate-600"><?= date('M j, Y H:i', strtotime($order['created_at'])) ?></dd>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($order['notes']) && $order['notes'] !== ''): ?>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Notes</dt>
                        <dd class="mt-1 text-sm text-slate-600 whitespace-pre-wrap"><?= htmlspecialchars($order['notes']) ?></dd>
                    </div>
                    <?php endif; ?>
                </dl>
            </div>
            <div class="h-1 bg-gradient-to-r from-sky-400/40 to-transparent"></div>
        </div>

        <!-- Update order card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-[#0f172a]">Update order</h2>
            </div>
            <form action="<?= base_url('admin/orders/' . $order['id']) ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-[#1e293b] mb-2">Status</label>
                    <select name="status" class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
                        <option value="pending" <?= ($order['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="in_progress" <?= ($order['status'] ?? '') === 'in_progress' ? 'selected' : '' ?>>In progress</option>
                        <option value="completed" <?= ($order['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="cancelled" <?= ($order['status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#1e293b] mb-2">Deadline</label>
                    <div class="relative">
                        <input type="date" name="deadline" value="<?= htmlspecialchars($order['deadline'] ?? '') ?>" class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#1e293b] mb-2">Notes</label>
                    <textarea name="notes" rows="4" class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition resize-y min-h-[100px]" placeholder="Internal notes..."><?= htmlspecialchars($order['notes'] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-[#1e293b] mb-2">Upload deliverables</label>
                    <input type="file" name="deliverables_file" accept=".zip,.pdf" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-sky-50 file:text-sky-700 file:font-semibold">
                </div>
                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-5 py-3.5 rounded-xl font-semibold text-white bg-gradient-to-r from-sky-500 to-sky-600 shadow-lg shadow-sky-500/30 hover:shadow-sky-500/40 hover:scale-[1.01] active:scale-[0.99] transition-all">
                    Save changes
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
            </form>
            <div class="h-1 bg-gradient-to-r from-sky-400/40 to-transparent"></div>
        </div>
    </div>

    <?php if (!empty($invoices)): ?>
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-lg font-bold text-[#0f172a]">Invoices</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead><tr class="bg-slate-50/80 border-b border-slate-200">
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Number</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                </tr></thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($invoices as $inv): ?>
                    <tr class="hover:bg-sky-50/30 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-[#0f172a]"><?= htmlspecialchars($inv['invoice_number'] ?? '') ?></td>
                        <td class="px-6 py-4 text-sm text-slate-600">$<?= number_format((float)($inv['amount'] ?? 0), 2) ?></td>
                        <td class="px-6 py-4"><span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700"><?= htmlspecialchars($inv['status'] ?? '') ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/admin.php';