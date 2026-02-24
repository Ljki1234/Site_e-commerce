<?php
$content = ob_start();
$isEdit = !empty($pack);
$p = $pack ?? [];
$featuresStr = is_array($p['features'] ?? null) ? implode("\n", $p['features']) : (string)($p['features'] ?? '');
?>
<div class="max-w-2xl space-y-6">
    <a href="<?= base_url('admin/packs') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to packs
    </a>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-lg shadow-slate-200/40 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
            <h2 class="text-lg font-bold text-[#0f172a]"><?= $isEdit ? 'Edit pack' : 'New pack' ?></h2>
        </div>
        <form action="<?= $isEdit ? base_url('admin/packs/save/' . $p['id']) : base_url('admin/packs/save') ?>" method="POST" class="p-6 space-y-5">
            <div>
                <label for="name" class="block text-sm font-semibold text-[#1e293b] mb-2">Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($p['name'] ?? '') ?>"
                       placeholder="e.g. Starter Pack"
                       class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition" required>
            </div>
            <div>
                <label for="slug" class="block text-sm font-semibold text-[#1e293b] mb-2">Slug</label>
                <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($p['slug'] ?? '') ?>"
                       placeholder="auto-generated if empty"
                       class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-[#1e293b] mb-2">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Short description of the pack"
                          class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition resize-y"><?= htmlspecialchars($p['description'] ?? '') ?></textarea>
            </div>
            <div>
                <label for="price" class="block text-sm font-semibold text-[#1e293b] mb-2">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" min="0" value="<?= htmlspecialchars($p['price'] ?? '0') ?>"
                       class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition" required>
            </div>
            <div>
                <label for="features" class="block text-sm font-semibold text-[#1e293b] mb-2">Features <span class="font-normal text-slate-500">(one per line)</span></label>
                <textarea id="features" name="features" rows="6" placeholder="Feature 1&#10;Feature 2&#10;..."
                          class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition resize-y font-mono text-sm"><?= htmlspecialchars($featuresStr) ?></textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="is_active" class="block text-sm font-semibold text-[#1e293b] mb-2">Active</label>
                    <select id="is_active" name="is_active" class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
                        <option value="1" <?= ($p['is_active'] ?? 1) ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= !($p['is_active'] ?? 1) ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-[#1e293b] mb-2">Sort order</label>
                    <input type="number" id="sort_order" name="sort_order" value="<?= (int)($p['sort_order'] ?? 0) ?>"
                           class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition">
                </div>
            </div>
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-white bg-gradient-to-r from-sky-500 to-sky-600 shadow-lg shadow-sky-500/30 hover:shadow-sky-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <?= $isEdit ? 'Save changes' : 'Create pack' ?>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
                <a href="<?= base_url('admin/packs') ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold border-2 border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors">Cancel</a>
            </div>
        </form>
        <div class="h-1 bg-gradient-to-r from-sky-400/40 to-transparent"></div>
    </div>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/admin.php';