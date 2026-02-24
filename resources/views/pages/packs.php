<?php
$content = ob_start();
$packs = $packs ?? [];
?>
<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative pt-28 pb-16 lg:pt-32 lg:pb-20 overflow-hidden bg-gradient-to-b from-sky-50/80 via-white to-white">
        <div class="absolute inset-0 pointer-events-none opacity-40" style="background-image: radial-gradient(circle at 30% 20%, rgba(224,78,142,0.06) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(99,102,241,0.05) 0%, transparent 50%);"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] mb-3" style="color: #E73F80;">Pricing</p>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-[#0f172a] tracking-tight">Website Packs &amp; Pricing</h1>
            <p class="mt-5 text-lg text-slate-600 max-w-2xl mx-auto">Fixed scope, clear pricing. Pick the pack that fits your project and order in a few clicks.</p>
        </div>
    </section>

    <!-- Packs grid -->
    <section class="relative py-12 lg:py-16" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(233,84,125,0.06) 0%, transparent 60%);"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php if (!empty($_SESSION['paypal_error'])): $err = $_SESSION['paypal_error']; unset($_SESSION['paypal_error']); ?>
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                <?= htmlspecialchars($err) ?>
            </div>
            <?php endif; ?>
            <?php if (empty($packs)): ?>
            <div class="text-center py-16">
                <p class="text-slate-600">No packs available at the moment. Check back soon.</p>
                <a href="<?= base_url('contact') ?>" class="mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-[#E04E8E] hover:underline">Get in touch</a>
            </div>
            <?php else: ?>
            <div class="grid md:grid-cols-3 gap-5 lg:gap-6 items-stretch">
                <?php $pack_index = 0; foreach ($packs as $pack): $is_popular = (count($packs) >= 2 && $pack_index === 1); $pack_index++; ?>
                <div id="pack-<?= (int)$pack['id'] ?>" class="group relative flex flex-col <?= $is_popular ? 'md:-mt-2 md:mb-2' : '' ?> scroll-mt-28">
                    <?php if ($is_popular): ?>
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-10 px-4 py-1.5 rounded-full bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-rose-500/30">Most Popular</div>
                    <?php endif; ?>
                    <div class="flex-1 rounded-3xl border-2 <?= $is_popular ? 'border-rose-200 bg-white shadow-xl shadow-slate-200/50 shadow-rose-500/5' : 'border-slate-200/80 bg-white shadow-lg shadow-slate-200/40' ?> p-6 lg:p-7 flex flex-col transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/30 <?= $is_popular ? 'hover:border-rose-300 hover:shadow-rose-500/10' : 'hover:border-slate-300' ?>">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-xl lg:text-2xl font-bold text-[#0f172a]"><?= htmlspecialchars($pack['name']) ?></h2>
                                <p class="mt-1.5 text-slate-600 text-sm leading-relaxed"><?= htmlspecialchars($pack['description']) ?></p>
                            </div>
                            <?php if ($is_popular): ?>
                            <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="mt-5 flex items-baseline gap-1">
                            <span class="text-slate-500 text-base font-medium">$</span>
                            <span class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-rose-600 to-pink-600 bg-clip-text text-transparent"><?= number_format((float)$pack['price'], 0) ?></span>
                        </div>
                        <ul class="mt-5 space-y-3 flex-1">
                            <?php foreach ($pack['features'] ?? [] as $f): ?>
                            <li class="flex items-center gap-3 text-slate-700">
                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-rose-50 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="text-sm"><?= htmlspecialchars($f) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php $user = auth(); if ($user): ?>
                        <form action="<?= base_url('order/initiate') ?>" method="POST" class="mt-6 space-y-4" enctype="multipart/form-data">
                            <input type="hidden" name="pack_id" value="<?= (int)$pack['id'] ?>">
                            <div class="space-y-2 text-left">
                                <label class="block text-sm font-medium text-slate-700">Project notes (optional)</label>
                                <textarea name="notes" rows="2" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:border-[#E04E8E] focus:ring-2 focus:ring-rose-500/20 transition" placeholder="Brief description"></textarea>
                            </div>
                            <div class="space-y-2 text-left">
                                <label class="block text-sm font-medium text-slate-700">Upload requirements (optional)</label>
                                <input type="file" name="requirements_file" accept=".pdf,.doc,.docx,.txt,.zip" class="block w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-rose-50 file:text-rose-700 file:font-medium">
                            </div>
                            <button type="submit" class="w-full inline-flex justify-center items-center gap-2 px-5 py-3.5 rounded-2xl font-semibold text-white bg-gradient-to-r from-rose-500 via-rose-500 to-pink-500 shadow-lg shadow-rose-500/30 hover:shadow-xl hover:shadow-rose-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                                Order now
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                        </form>
                        <?php else: ?>
                        <a href="<?= base_url('register') ?>" class="mt-6 w-full inline-flex justify-center items-center gap-2 px-5 py-3.5 rounded-2xl font-semibold text-white bg-gradient-to-r from-rose-500 via-rose-500 to-pink-500 shadow-lg shadow-rose-500/30 hover:shadow-xl hover:shadow-rose-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            Register to order
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- CTA strip -->
            <div class="mt-16 lg:mt-20 text-center">
                <p class="text-slate-600 mb-6">Need a custom scope or have questions?</p>
                <a href="<?= base_url('contact') ?>" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 hover:scale-[1.02] transition-all duration-300">
                    Get in touch
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';