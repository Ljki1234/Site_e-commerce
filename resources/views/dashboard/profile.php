<?php
$content = ob_start();
$user = $user ?? [];
$updated = isset($_GET['updated']);
?>
<div class="max-w-4xl mx-auto space-y-6">
    <?php if ($updated): ?>
    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-800">
        <span class="flex-shrink-0 w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </span>
        <p class="font-medium">Profile updated successfully.</p>
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xl shadow-slate-200/50 overflow-hidden">
        <!-- Gradient banner -->
        <div class="h-24 bg-gradient-to-r from-primary-400 via-primary-300 to-amber-300"></div>

        <!-- Profile header: avatar + name + email + Edit -->
        <div class="px-6 lg:px-8 pb-6 -mt-12 relative">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div class="flex items-end gap-4">
                    <div class="w-24 h-24 rounded-full bg-white border-4 border-white shadow-lg flex items-center justify-center text-primary-600 font-bold text-3xl">
                        <?= strtoupper(mb_substr($user['full_name'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div class="pb-1">
                        <h2 class="text-xl font-bold text-[#0f172a]"><?= htmlspecialchars($user['full_name'] ?? 'User') ?></h2>
                        <p class="text-slate-500 text-sm mt-0.5"><?= htmlspecialchars($user['email'] ?? '') ?></p>
                    </div>
                </div>
                <a href="#form" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-white bg-primary-500 hover:bg-primary-600 shadow-lg shadow-primary-500/30 transition-all">
                    Edit
                </a>
            </div>
        </div>

        <!-- Form: two columns + email block -->
        <form id="form" action="<?= base_url('dashboard/profile') ?>" method="POST" class="px-6 lg:px-8 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="full_name" class="block text-sm font-bold text-[#0f172a] mb-2">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name'] ?? '') ?>"
                           placeholder="Your First Name"
                           class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition" required>
                </div>
                <div>
                    <label for="company" class="block text-sm font-bold text-[#0f172a] mb-2">Company</label>
                    <input type="text" id="company" name="company" value="<?= htmlspecialchars($user['company'] ?? '') ?>"
                           placeholder="Your company"
                           class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-bold text-[#0f172a] mb-2">Phone</label>
                    <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>"
                           placeholder="+1 234 567 890"
                           class="block w-full rounded-xl border border-slate-200 px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition">
                </div>
            </div>

            <!-- My email Address block -->
            <div class="mt-8 pt-6 border-t border-slate-100">
                <label class="block text-sm font-bold text-[#0f172a] mb-3">My email Address</label>
                <div class="flex items-center gap-3 p-4 rounded-xl bg-slate-50/80 border border-slate-100">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center text-primary-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <div>
                        <p class="font-medium text-[#0f172a]"><?= htmlspecialchars($user['email'] ?? '') ?></p>
                        <p class="text-xs text-slate-500 mt-0.5">Primary email · Cannot be changed</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 mt-8">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-white bg-primary-500 hover:bg-primary-600 shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 transition-all">
                    Save changes
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
                <a href="<?= base_url('dashboard') ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold border-2 border-slate-200 text-slate-700 hover:bg-slate-50 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/dashboard.php';