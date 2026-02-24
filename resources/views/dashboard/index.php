<?php
$content = ob_start();
$orders = $orders ?? [];
$invoices = $invoices ?? [];
$user = $user ?? [];
$ordered = isset($_GET['ordered']);
$inProgress = count(array_filter($orders, fn($o) => $o['status'] === 'in_progress'));
$completed = count(array_filter($orders, fn($o) => $o['status'] === 'completed'));
?>
<div class="max-w-6xl mx-auto space-y-8">
    <?php if ($ordered): ?>
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 shadow-lg shadow-emerald-500/10">
        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </span>
        <p class="font-medium">Your order has been placed. We will get in touch soon.</p>
    </div>
    <?php endif; ?>

    <!-- Stats: colorful cards -->
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
            <div class="absolute top-0 right-0 w-20 h-20 opacity-10" style="background: radial-gradient(circle at 70% 30%, #0ea5e9 1px, transparent 1px); background-size: 8px 8px;"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total orders</span>
                    <span class="w-11 h-11 rounded-xl bg-sky-100 flex items-center justify-center text-sky-600 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-2xl lg:text-3xl font-bold text-sky-600"><?= count($orders) ?></p>
            </div>
            <div class="h-1.5 bg-gradient-to-r from-sky-400 to-sky-500"></div>
        </div>
        <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
            <div class="absolute top-0 right-0 w-20 h-20 opacity-10" style="background: radial-gradient(circle at 70% 30%, #f59e0b 1px, transparent 1px); background-size: 8px 8px;"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">In progress</span>
                    <span class="w-11 h-11 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-2xl lg:text-3xl font-bold text-amber-600"><?= $inProgress ?></p>
            </div>
            <div class="h-1.5 bg-gradient-to-r from-amber-400 to-amber-500"></div>
        </div>
        <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
            <div class="absolute top-0 right-0 w-20 h-20 opacity-10" style="background: radial-gradient(circle at 70% 30%, #10b981 1px, transparent 1px); background-size: 8px 8px;"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Completed</span>
                    <span class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-2xl lg:text-3xl font-bold text-emerald-600"><?= $completed ?></p>
            </div>
            <div class="h-1.5 bg-gradient-to-r from-emerald-400 to-emerald-500"></div>
        </div>
        <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5">
            <div class="absolute top-0 right-0 w-20 h-20 opacity-10" style="background: radial-gradient(circle at 70% 30%, #8b5cf6 1px, transparent 1px); background-size: 8px 8px;"></div>
            <div class="relative p-6">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Invoices</span>
                    <span class="w-11 h-11 rounded-xl bg-violet-100 flex items-center justify-center text-violet-600 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                </div>
                <p class="mt-3 text-2xl lg:text-3xl font-bold text-violet-600"><?= count($invoices) ?></p>
            </div>
            <div class="h-1.5 bg-gradient-to-r from-violet-400 to-violet-500"></div>
        </div>
    </div>

    <!-- Quick action -->
    <div class="rounded-2xl bg-gradient-to-r from-primary-500 via-primary-400 to-cyan-400 p-6 lg:p-8 shadow-xl shadow-primary-500/25 text-white">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold">Ready for a new project?</h2>
                <p class="mt-1 text-primary-100 text-sm">Browse our packs and place an order in a few clicks.</p>
            </div>
            <a href="<?= base_url('packs') ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold bg-white text-primary-600 shadow-lg hover:bg-primary-50 hover:scale-105 transition-all">
                Browse packs
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>

    <!-- Your orders -->
    <div>
        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
            <h2 class="text-lg font-bold text-[#0f172a]">Your orders</h2>
            <a href="<?= base_url('packs') ?>" class="text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">Browse packs →</a>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <?php if (empty($orders)): ?>
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <p class="mt-4 text-slate-600">No orders yet.</p>
                    <a href="<?= base_url('packs') ?>" class="mt-3 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-primary-600 bg-primary-50 hover:bg-primary-100 transition-colors">Browse packs</a>
                </div>
            <?php else: ?>
                <table class="min-w-full">
                    <thead><tr class="bg-gradient-to-r from-slate-50 to-slate-100/80 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pack</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($orders as $o):
                            $v = $o['status'] ?? 'pending';
                            $badgeClass = $v === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($v === 'in_progress' ? 'bg-amber-100 text-amber-800' : ($v === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-sky-100 text-sky-800'));
                        ?>
                        <tr class="hover:bg-primary-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-[#0f172a]">#<?= (int)$o['id'] ?></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['pack_name']) ?></td>
                            <td class="px-6 py-4 text-sm font-semibold text-slate-700">$<?= number_format((float)$o['total_amount'], 2) ?></td>
                            <td class="px-6 py-4"><span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badgeClass ?>"><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $v))) ?></span></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= date('M j, Y', strtotime($o['created_at'] ?? 'now')) ?></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="<?= base_url('dashboard/orders/' . $o['id']) ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-700">View</a>
                                <?php if (!empty($o['deliverables_file'])): ?>
                                <a href="<?= base_url('dashboard/orders/' . $o['id'] . '/download') ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-emerald-600 hover:text-emerald-700">Download</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Invoices -->
    <div>
        <h2 class="text-lg font-bold text-[#0f172a] mb-4">Invoices</h2>
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <?php if (empty($invoices)): ?>
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-2xl bg-violet-100 flex items-center justify-center mx-auto text-violet-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="mt-4 text-slate-600">No invoices yet.</p>
                </div>
            <?php else: ?>
                <table class="min-w-full">
                    <thead><tr class="bg-gradient-to-r from-violet-50/80 to-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Due date</th>
                    </tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($invoices as $inv): ?>
                        <tr class="hover:bg-violet-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-[#0f172a]"><?= htmlspecialchars($inv['invoice_number'] ?? '') ?></td>
                            <td class="px-6 py-4 text-sm font-medium text-slate-700">$<?= number_format((float)($inv['amount'] ?? 0), 2) ?></td>
                            <td class="px-6 py-4"><span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold <?= ($inv['status'] ?? '') === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' ?>"><?= htmlspecialchars($inv['status'] ?? '') ?></span></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= date('M j, Y', strtotime($inv['due_date'] ?? 'now')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/dashboard.php';