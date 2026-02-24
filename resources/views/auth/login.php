<?php
$content = ob_start();
$errors = $errors ?? [];
$old = $old ?? [];
$resetSuccess = isset($_GET['reset']) && $_GET['reset'] === '1';
?>
<div class="min-h-screen bg-white">
    <!-- Login form -->
    <section class="relative pt-28 pb-20 lg:pt-32 lg:pb-20" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(233,84,125,0.06) 0%, transparent 60%);"></div>
        <div class="relative max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border-2 border-slate-200/80 shadow-xl shadow-slate-200/50 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/30 hover:border-rose-100">
                <div class="p-8 lg:p-10">
                    <?php if ($resetSuccess): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80">
                        <p class="text-sm font-medium text-emerald-800">Your password has been changed. You can now sign in with your new password.</p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($errors['email']) && (strpos($errors['email'] ?? '', 'Invalid') !== false)): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200/80">
                        <p class="text-sm font-medium text-rose-800"><?= htmlspecialchars($errors['email']) ?></p>
                    </div>
                    <?php endif; ?>
                    <form action="<?= base_url('login') ?>" method="POST" class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-[#1e293b] mb-2">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border px-4 py-3.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#E04E8E]/30 focus:border-[#E04E8E] transition <?= isset($errors['email']) ? 'border-rose-400 bg-rose-50/50' : 'border-slate-200' ?>"
                                   required autofocus>
                            <?php if (!empty($errors['email']) && strpos($errors['email'], 'Invalid') === false): ?>
                                <p class="mt-1.5 text-sm text-rose-600"><?= htmlspecialchars($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-semibold text-[#1e293b] mb-2">Password</label>
                            <input type="password" id="password" name="password"
                                   placeholder="••••••••"
                                   class="block w-full rounded-xl border px-4 py-3.5 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#E04E8E]/30 focus:border-[#E04E8E] transition <?= isset($errors['password']) ? 'border-rose-400 bg-rose-50/50' : 'border-slate-200' ?>"
                                   required>
                            <?php if (!empty($errors['password'])): ?>
                                <p class="mt-1.5 text-sm text-rose-600"><?= htmlspecialchars($errors['password']) ?></p>
                            <?php endif; ?>
                            <p class="mt-2 text-right">
                                <a href="<?= base_url('forgot-password') ?>" class="text-sm font-medium text-[#E04E8E] hover:text-rose-600 transition-colors">Forgot password?</a>
                            </p>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-5 py-3.5 rounded-2xl font-semibold text-white bg-gradient-to-r from-rose-500 via-rose-500 to-pink-500 shadow-lg shadow-rose-500/30 hover:shadow-xl hover:shadow-rose-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            Sign in
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </button>
                    </form>
                    <p class="mt-8 text-center text-sm text-slate-600">
                        Don't have an account?
                        <a href="<?= base_url('register') ?>" class="font-semibold text-[#E04E8E] hover:text-rose-600 transition-colors">Register</a>
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