<?php
$content = ob_start();
?>
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
    <?php if (empty($messages)): ?>
        <div class="p-10 text-center text-slate-500">No messages yet.</div>
    <?php else: ?>
        <table class="min-w-full">
            <thead><tr class="bg-slate-50/80 border-b border-slate-200">
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">From</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Subject</th>
                <th class="px-6 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
            </tr></thead>
            <tbody class="divide-y divide-slate-100">
                <?php foreach ($messages as $m): ?>
                <tr class="hover:bg-sky-50/50 transition-colors">
                    <td class="px-6 py-4 text-sm">
                        <span class="font-semibold text-[#0f172a]"><?= htmlspecialchars($m['name']) ?></span>
                        <span class="text-slate-500 block mt-0.5"><?= htmlspecialchars($m['email']) ?></span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600"><?= htmlspecialchars($m['subject']) ?></td>
                    <td class="px-6 py-4 text-sm text-slate-500"><?= date('M j, Y H:i', strtotime($m['created_at'])) ?></td>
                </tr>
                <tr><td colspan="3" class="px-6 py-4 text-sm text-slate-600 bg-slate-50/50 border-b border-slate-100"><?= nl2br(htmlspecialchars($m['body'])) ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/admin.php';
