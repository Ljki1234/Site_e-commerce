<?php
$content = ob_start();
$client = $client ?? [];
$notes = $notes ?? [];
$orders = $orders ?? [];
?>
<div class="space-y-6">
    <a href="<?= base_url('admin/clients') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to clients
    </a>

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Client card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-[#0f172a]">Client</h2>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</dt>
                        <dd class="mt-1 text-sm font-medium text-[#0f172a]"><?= htmlspecialchars($client['full_name'] ?? '—') ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</dt>
                        <dd class="mt-1 text-sm text-slate-600"><?= htmlspecialchars($client['email'] ?? '—') ?></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</dt>
                        <dd class="mt-1">
                            <form action="<?= base_url('admin/clients/' . $client['id'] . '/status') ?>" method="POST" class="inline">
                                <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
                                    <option value="lead" <?= ($client['status'] ?? '') === 'lead' ? 'selected' : '' ?>>Lead</option>
                                    <option value="active" <?= ($client['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="vip" <?= ($client['status'] ?? '') === 'vip' ? 'selected' : '' ?>>VIP</option>
                                </select>
                            </form>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="h-1 bg-gradient-to-r from-sky-400/40 to-transparent"></div>
        </div>

        <!-- Add note card -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-[#0f172a]">Add note</h2>
            </div>
            <div class="p-6">
                <form action="<?= base_url('admin/clients/' . $client['id'] . '/note') ?>" method="POST" class="space-y-3">
                    <textarea name="note" rows="3" placeholder="Internal note..."
                              class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition resize-y" required></textarea>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-sky-500 to-sky-600 shadow-lg shadow-sky-500/30 hover:shadow-sky-500/40 transition-all">
                        Add note
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </button>
                </form>
                <?php if (!empty($notes)): ?>
                    <div class="mt-6 space-y-3">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Notes</p>
                        <?php foreach ($notes as $n): ?>
                        <div class="p-4 rounded-xl bg-slate-50/80 border border-slate-100 text-sm text-slate-700">
                            <?= nl2br(htmlspecialchars($n['note'] ?? '')) ?>
                            <p class="mt-2 text-xs text-slate-500">— <?= htmlspecialchars($n['author_name'] ?? '') ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="h-1 bg-gradient-to-r from-sky-400/40 to-transparent"></div>
        </div>
    </div>

    <!-- Orders -->
    <div>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-[#0f172a]">Orders</h2>
            <?php if (!empty($orders)): ?>
            <a href="<?= base_url('admin/orders') ?>" class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">View all orders →</a>
            <?php endif; ?>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
            <?php if (empty($orders)): ?>
                <div class="p-10 text-center text-slate-500">No orders.</div>
            <?php else: ?>
                <table class="min-w-full">
                    <thead><tr class="bg-slate-50/80 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pack</th>
                        <th class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr></thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($orders as $o): ?>
                        <tr class="hover:bg-sky-50/30 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-[#0f172a]">#<?= (int)$o['id'] ?></td>
                            <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['pack_name'] ?? '') ?></td>
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
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/admin.php';