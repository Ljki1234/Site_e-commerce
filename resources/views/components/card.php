<div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden <?= $class ?? '' ?>">
    <?php if (!empty($title)): ?>
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="text-lg font-semibold text-slate-800"><?= htmlspecialchars($title) ?></h3>
        </div>
    <?php endif; ?>
    <div class="<?= isset($title) ? 'p-6' : 'p-6' ?>">
        <?= $slot ?? $content ?? '' ?>
    </div>
</div>
