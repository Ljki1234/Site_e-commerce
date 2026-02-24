<?php $content = ob_start(); ?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-bold text-[#0f172a]">Service packs</h2>
    <a href="<?= base_url('admin/packs/new') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-sky-500 to-sky-600 shadow-lg shadow-sky-500/30 hover:shadow-sky-500/40 transition-all">Add pack</a>
</div>
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
<?php if (empty($packs)): ?>
    <div class="p-10 text-center text-slate-500">No packs yet. <a href="<?= base_url('admin/packs/new') ?>" class="font-semibold text-sky-600 hover:text-sky-700">Add one</a>.</div>
<?php else: ?>
    <table class="min-w-full">
        <thead><tr class="bg-slate-50/80 border-b border-slate-200">
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Slug</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Price</th>
            <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Active</th>
            <th class="px-6 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-slate-100">
            <?php foreach ($packs as $p): ?>
            <tr class="hover:bg-sky-50/50 transition-colors">
                <td class="px-6 py-4 text-sm font-semibold text-[#0f172a]"><?= htmlspecialchars($p['name']) ?></td>
                <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($p['slug']) ?></td>
                <td class="px-6 py-4 text-sm text-slate-600">$<?= number_format((float)$p['price'], 2) ?></td>
                <td class="px-6 py-4">
                    <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-semibold <?= $p['is_active'] ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' ?>"><?= $p['is_active'] ? 'Yes' : 'No' ?></span>
                </td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="<?= base_url('admin/packs/' . $p['id']) ?>" class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">Edit</a>
                    <form action="<?= base_url('admin/packs/delete/' . $p['id']) ?>" method="POST" class="inline" onsubmit="return confirm('Delete this pack?');">
                        <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700 transition-colors">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>
<?php $content = ob_get_clean(); require ROOT_PATH . '/resources/views/layouts/admin.php'; ?>
