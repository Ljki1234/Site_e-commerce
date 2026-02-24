<?php
$content = ob_start();
$errors = $errors ?? [];
$old = $old ?? [];
?>
<div class="min-h-screen bg-white">
    <section class="relative pt-28 pb-20 lg:pt-32 lg:pb-20" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(233,84,125,0.06) 0%, transparent 60%);"></div>
        <div class="relative max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border-2 border-slate-200/80 shadow-xl shadow-slate-200/50 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/30 hover:border-rose-100">
                <div class="p-8 lg:p-10">
                    <h1 class="text-xl font-bold text-[#1e293b] mb-2">Forgot password?</h1>
                    <p class="text-sm text-slate-600 mb-6">Enter your email address and we'll send you a 6-digit code to reset your password.</p>
                    <form action="<?= base_url('forgot-password') ?>" method="POST" class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#1e293b] mb-2">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border px-4 py-3.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#E04E8E]/30 focus:border-[#E04E8E] transition <?= isset($errors['email']) ? 'border-rose-400 bg-rose-50/50' : 'border-slate-200' ?>"
                                   required autofocus>
                            <?php if (!empty($errors['email'])): ?>
                                <p class="mt-1.5 text-sm text-rose-600"><?= htmlspecialchars($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-5 py-3.5 rounded-2xl font-semibold text-white bg-gradient-to-r from-rose-500 via-rose-500 to-pink-500 shadow-lg shadow-rose-500/30 hover:shadow-xl hover:shadow-rose-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            Send code
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </form>
                    <p class="mt-8 text-center text-sm text-slate-600">
                        <a href="<?= base_url('login') ?>" class="font-semibold text-[#E04E8E] hover:text-rose-600 transition-colors">← Back to login</a>
                    </p>
                </div>
                <div class="h-1.5 bg-gradient-to-r from-rose-400 via-rose-500 to-pink-500"></div>
            </div>
            <p class="mt-6 text-center">
                <a href="<?= base_url() ?>" class="text-sm text-slate-500 hover:text-[#E04E8E] transition-colors">← Back to home</a>
            </p>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';
