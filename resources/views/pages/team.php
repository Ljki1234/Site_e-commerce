<?php
$content = ob_start();
/** @var array $team */
$team = $team ?? [];
?>

<div class="pt-0">
    <!-- Hero / Intro -->
    <section class="relative overflow-hidden py-16 lg:py-24 bg-gradient-to-br from-sky-100 via-white to-rose-50">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-32 -left-24 w-72 h-72 rounded-full bg-sky-200/40 blur-3xl"></div>
            <div class="absolute -bottom-40 right-10 w-80 h-80 rounded-full bg-rose-200/35 blur-3xl"></div>
            <div class="absolute top-1/3 left-10 w-40 h-40 rounded-full border border-sky-300/40"></div>
            <div class="absolute bottom-10 right-1/3 w-24 h-24 rounded-full border border-rose-300/40"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-center">
                <div class="lg:col-span-6">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.22em] text-rose-500">
                        <span class="w-6 h-[1px] bg-rose-400"></span>
                        AtlasTech Team
                    </span>
                    <h1 class="mt-4 text-3xl sm:text-4xl lg:text-[2.7rem] font-bold tracking-tight text-navy-800">
                        The people behind<br class="hidden sm:block" /> your next digital project.
                    </h1>
                    <p class="mt-5 text-sm sm:text-base leading-relaxed text-slate-600 max-w-xl">
                        We are a small, focused team of designers, developers and strategists who love
                        shipping clean, fast and purposeful experiences to the web. Every project gets direct
                        attention from our core team – no hand‑offs, no chaos.
                    </p>
                    <p class="mt-3 text-sm sm:text-base leading-relaxed text-slate-600 max-w-xl">
                        From the first wireframe to deployment and ongoing optimisation, we stay close to you
                        and your users so that each release feels intentional and on‑brand.
                    </p>
                </div>
                <div class="lg:col-span-6">
                    <div class="relative max-w-xl mx-auto">
                        <div class="absolute -top-6 -left-4 w-28 h-28 rounded-3xl bg-white/70 border border-slate-100 shadow-lg shadow-slate-200/80 flex items-center justify-center">
                            <div class="text-center">
                                <p class="text-xs font-semibold text-slate-500 uppercase tracking-[0.18em]"></p>
                                <p class="mt-1 text-2xl font-bold text-navy-800">5</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-4 w-32 h-32 rounded-3xl bg-gradient-to-br from-rose-500 to-orange-400 text-white shadow-xl shadow-rose-400/40 flex items-center justify-center">
                            <div class="text-sm font-semibold leading-snug text-center px-3">
                                <br/>
                            </div>
                        </div>
                        <div class="rounded-[2rem] border border-white/80 bg-white/80 backdrop-blur shadow-xl shadow-slate-200/80 p-6 sm:p-8">
                            <div class="grid grid-cols-3 gap-4">
                                <?php foreach (array_slice($team, 0, 3) as $member): ?>
                                    <div class="flex flex-col items-center text-center">
                                        <?php if (!empty($member['avatar'])): ?>
                                            <img src="<?= htmlspecialchars($member['avatar']) ?>" alt="<?= htmlspecialchars($member['name']) ?>"
                                                 class="w-16 h-16 sm:w-18 sm:h-18 rounded-full object-cover border-2 border-white shadow-md ring-1 ring-sky-200/60">
                                        <?php else: ?>
                                            <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-full bg-gradient-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center text-lg font-semibold shadow-md ring-1 ring-sky-300/70">
                                                <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                            </div>
                                        <?php endif; ?>
                                        <p class="mt-2 text-xs font-semibold text-navy-800 truncate max-w-[7rem]"><?= htmlspecialchars($member['name']) ?></p>
                                        <p class="mt-0.5 text-[11px] text-slate-500 truncate max-w-[7rem]"><?= htmlspecialchars($member['role']) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mt-5 flex items-center justify-between text-xs text-slate-500">
                                <span>Product, design & engineering aligned.</span>
                                <span class="inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Available for new projects
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team grid -->
    <section class="py-14 lg:py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none"
             style="background-image: radial-gradient(circle, rgba(148,163,184,0.18) 1px, transparent 1px); background-size: 22px 22px; opacity: 0.35;"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-rose-500">Meet the core team</p>
                    <h2 class="mt-2 text-2xl sm:text-3xl lg:text-[2rem] font-bold tracking-tight text-navy-800">
                        Designers, developers &amp; makers.
                    </h2>
                    <p class="mt-3 text-sm sm:text-base text-slate-600 max-w-xl">
                        Every project is handled by this core group – we keep communication short, decisions quick
                        and hand‑offs minimal so you always know who is building your product.
                    </p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex -space-x-3">
                        <?php foreach (array_slice($team, 0, 3) as $member): ?>
                            <?php if (!empty($member['avatar'])): ?>
                                <img src="<?= htmlspecialchars($member['avatar']) ?>" alt="<?= htmlspecialchars($member['name']) ?>"
                                     class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm">
                            <?php else: ?>
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center text-[11px] font-semibold border-2 border-white shadow-sm">
                                    <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= base_url('contact') ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-full text-xs sm:text-sm font-semibold text-white bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 shadow-md shadow-rose-400/40 hover:shadow-lg hover:shadow-rose-400/40 transition">
                        Start a project with us
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Première ligne : 3 cartes -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-7">
                <?php foreach (array_slice($team, 0, 3) as $member): ?>
                    <article class="group relative rounded-[2rem] bg-gradient-to-b from-sky-50 via-white to-rose-50 border border-slate-100/80 shadow-md shadow-slate-200/80 hover:shadow-2xl hover:shadow-rose-200/80 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <?php if (!empty($member['avatar'])): ?>
                                <img src="<?= htmlspecialchars($member['avatar']) ?>" alt="<?= htmlspecialchars($member['name']) ?>"
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-semibold">
                                    <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-x-4 bottom-4 rounded-2xl bg-white/90 backdrop-blur shadow-lg shadow-slate-300/70 px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center text-xs font-semibold shadow-md ring-1 ring-sky-300/70">
                                        <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-sm sm:text-[15px] font-semibold text-navy-800 truncate"><?= htmlspecialchars($member['name']) ?></h3>
                                        <p class="text-[11px] font-medium text-rose-500 uppercase tracking-[0.16em] truncate"><?= htmlspecialchars($member['role']) ?></p>
                                    </div>
                                </div>
                                <p class="mt-2 text-[11px] leading-relaxed text-slate-600 line-clamp-3"><?= htmlspecialchars($member['bio'] ?? 'Focused on shipping thoughtful digital products, blending clean design with reliable engineering for every release.') ?></p>
                                <div class="mt-2 flex items-center justify-between text-[10px] text-slate-500">
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span>Available for calls</span></span>
                                    <span class="uppercase tracking-[0.18em] text-slate-400">AtlasTech</span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Deuxième ligne : 2 cartes centrées -->
            <?php if (count($team) > 3): ?>
            <div class="flex flex-wrap justify-center gap-6 lg:gap-7 mt-6 lg:mt-7">
                <?php foreach (array_slice($team, 3, 2) as $member): ?>
                    <article class="group relative w-full sm:w-[280px] lg:w-[320px] rounded-[2rem] bg-gradient-to-b from-sky-50 via-white to-rose-50 border border-slate-100/80 shadow-md shadow-slate-200/80 hover:shadow-2xl hover:shadow-rose-200/80 hover:-translate-y-1.5 transition-all duration-300 overflow-hidden">
                        <div class="relative aspect-[3/4] overflow-hidden">
                            <?php if (!empty($member['avatar'])): ?>
                                <img src="<?= htmlspecialchars($member['avatar']) ?>" alt="<?= htmlspecialchars($member['name']) ?>"
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center text-white text-3xl font-semibold">
                                    <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                </div>
                            <?php endif; ?>
                            <div class="absolute inset-x-4 bottom-4 rounded-2xl bg-white/90 backdrop-blur shadow-lg shadow-slate-300/70 px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center text-xs font-semibold shadow-md ring-1 ring-sky-300/70">
                                        <?= htmlspecialchars($member['initials'] ?? substr($member['name'] ?? 'A', 0, 2)) ?>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="text-sm sm:text-[15px] font-semibold text-navy-800 truncate"><?= htmlspecialchars($member['name']) ?></h3>
                                        <p class="text-[11px] font-medium text-rose-500 uppercase tracking-[0.16em] truncate"><?= htmlspecialchars($member['role']) ?></p>
                                    </div>
                                </div>
                                <p class="mt-2 text-[11px] leading-relaxed text-slate-600 line-clamp-3"><?= htmlspecialchars($member['bio'] ?? 'Focused on shipping thoughtful digital products, blending clean design with reliable engineering for every release.') ?></p>
                                <div class="mt-2 flex items-center justify-between text-[10px] text-slate-500">
                                    <span class="inline-flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span><span>Available for calls</span></span>
                                    <span class="uppercase tracking-[0.18em] text-slate-400">AtlasTech</span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';
