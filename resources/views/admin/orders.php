<?php $content = ob_start(); ?>
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
<?php if (empty($orders)): ?>
<div class="p-10 text-center text-slate-500">No orders yet.</div>
<?php else: ?>
<table class="min-w-full">
<thead><tr class="bg-slate-50/80 border-b border-slate-200">
<th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Order</th>
<th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Client</th>
<th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pack</th>
<th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
<th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
<th class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
</tr></thead>
<tbody class="divide-y divide-slate-100">
<?php foreach ($orders as $o):
    $status = $o['status'] ?? 'pending';
    $badge = $status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($status === 'in_progress' ? 'bg-sky-100 text-sky-800' : 'bg-amber-100 text-amber-800');
?>
<tr class="hover:bg-sky-50/50 transition-colors">
<td class="px-6 py-4 text-sm font-semibold text-[#0f172a]">#<?= (int)$o['id'] ?></td>
<td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['client_name']) ?></td>
<td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($o['pack_name']) ?></td>
<td class="px-6 py-4 text-sm text-slate-600">$<?= number_format((float)$o['total_amount'], 2) ?></td>
<td class="px-6 py-4"><span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badge ?>"><?= htmlspecialchars($o['status']) ?></span></td>
<td class="px-6 py-4 text-right"><a href="<?= base_url('admin/orders/' . $o['id']) ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">View <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></a></td>
</tr>
<?php endforeach; ?>
</tbody></table>
<?php endif; ?>
</div>
<?php $content = ob_get_clean(); require ROOT_PATH . '/resources/views/layouts/admin.php'; ?>
