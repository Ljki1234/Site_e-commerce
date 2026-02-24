<?php
$content = ob_start();
?>
<div class="grid gap-5 sm:gap-6 md:grid-cols-2 lg:grid-cols-4">
    <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-slate-300/30 hover:border-sky-100">
        <div class="absolute top-0 right-0 w-24 h-24 opacity-[0.06]" style="background: radial-gradient(circle at 70% 30%, #64748b 1px, transparent 1px); background-size: 10px 10px;"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total revenue</span>
                <span class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-sky-600 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl lg:text-3xl font-bold text-[#0f172a]">$<?= number_format($revenue, 2) ?></p>
        </div>
        <div class="h-1 bg-gradient-to-r from-sky-400/50 to-transparent"></div>
    </div>
    <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-slate-300/30 hover:border-red-200">
        <div class="absolute top-0 right-0 w-24 h-24 opacity-[0.06]" style="background: radial-gradient(circle at 70% 30%, #64748b 1px, transparent 1px); background-size: 10px 10px;"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total clients</span>
                <span class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-800 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl lg:text-3xl font-bold text-red-800"><?= (int)$clients ?></p>
        </div>
        <div class="h-1 bg-gradient-to-r from-red-400/60 to-transparent"></div>
    </div>
    <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-slate-300/30 hover:border-amber-100">
        <div class="absolute top-0 right-0 w-24 h-24 opacity-[0.06]" style="background: radial-gradient(circle at 70% 30%, #64748b 1px, transparent 1px); background-size: 10px 10px;"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Active orders</span>
                <span class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl lg:text-3xl font-bold text-amber-600"><?= (int)$activeOrders ?></p>
        </div>
        <div class="h-1 bg-gradient-to-r from-amber-400/50 to-transparent"></div>
    </div>
    <div class="group relative bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-slate-300/30 hover:border-emerald-100">
        <div class="absolute top-0 right-0 w-24 h-24 opacity-[0.06]" style="background: radial-gradient(circle at 70% 30%, #64748b 1px, transparent 1px); background-size: 10px 10px;"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Completed</span>
                <span class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <p class="mt-3 text-2xl lg:text-3xl font-bold text-emerald-600"><?= (int)($completedOrders ?? 0) ?></p>
        </div>
        <div class="h-1 bg-gradient-to-r from-emerald-400/50 to-transparent"></div>
    </div>
</div>

<?php if (!empty($monthly)): ?>
<div class="mt-8 bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="text-lg font-bold text-[#0f172a]">Monthly revenue (last 6 months)</h2>
    </div>
    <div class="p-6">
        <div class="flex flex-wrap items-end gap-4 h-48">
            <?php
            $max = max(array_column($monthly, 'total')) ?: 1;
            foreach ($monthly as $m):
                $h = (float)$m['total'] / $max * 120;
            ?>
            <div class="flex flex-col items-center group">
                <div class="w-10 lg:w-12 rounded-t-lg bg-gradient-to-t from-sky-500 to-sky-400 transition-all duration-300 group-hover:from-sky-600 group-hover:to-sky-400" style="height: <?= $h ?>px; min-height: 4px;" title="$<?= number_format((float)$m['total'], 2) ?>"></div>
                <span class="mt-2 text-xs font-medium text-slate-500"><?= htmlspecialchars($m['month']) ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-[#0f172a]">Recent orders</h2>
        <a href="<?= base_url('admin/orders') ?>" class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">View all →</a>
    </div>
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
        <?php if (empty($recentOrders)): ?>
            <div class="p-10 text-center text-slate-500">No orders yet.</div>
        <?php else: ?>
            <table class="min-w-full">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pack</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($recentOrders as $o): ?>
                    <tr class="hover:bg-sky-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-semibold text-[#0f172a]">#<?= (int)$o['id'] ?></td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['client_name']) ?></td>
                        <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['pack_name']) ?></td>
                        <td class="px-6 py-4">
                            <?php
                            $status = $o['status'] ?? 'pending';
                            $badge = $status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($status === 'in_progress' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800');
                            ?>
                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badge ?>"><?= htmlspecialchars($status) ?></span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="<?= base_url('admin/orders/' . $o['id']) ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">View <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/admin.php';