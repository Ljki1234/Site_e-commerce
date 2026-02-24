<?php
$content = ob_start();

// Build display items: use DB items if any, else default showcase (same as home)
$categories = ['all' => 'All', 'web' => 'Web Application', 'app' => 'Mobile App', 'branding' => 'Branding'];
$defaults = [
    ['title' => 'Ecommerce Development', 'subtitle' => 'Web Application', 'image' => asset('assets/image9.jfif'), 'url' => '#', 'category' => 'web'],
    ['title' => 'Creative App', 'subtitle' => 'iOS, Android', 'image' => asset('assets/image11.jfif'), 'url' => '#', 'category' => 'app'],
    ['title' => 'Brochure Design', 'subtitle' => 'Graphic, Print', 'image' => asset('assets/image12.jfif'), 'url' => '#', 'category' => 'branding'],
    ['title' => 'Icon Pack', 'subtitle' => 'iOS, Android', 'image' => asset('assets/image13.jfif'), 'url' => '#', 'category' => 'app'],
];
$display_items = [];
if (!empty($items)) {
    foreach ($items as $item) {
        $cat = isset($item['category']) ? strtolower(preg_replace('/\s+/', '-', (string)$item['category'])) : 'all';
        if (!isset($categories[$cat])) $cat = 'all';
        $display_items[] = [
            'title' => $item['title'] ?? '',
            'subtitle' => $item['description'] ?? 'Project',
            'image' => $item['image_url'] ?? asset('assets/image9.jfif'),
            'url' => $item['project_url'] ?? '#',
            'category' => $cat,
        ];
    }
}
if (empty($display_items)) {
    $display_items = $defaults;
}
?>
<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative pt-28 pb-16 lg:pt-32 lg:pb-20 overflow-hidden bg-gradient-to-b from-sky-50/80 via-white to-white">
        <div class="absolute inset-0 pointer-events-none opacity-40" style="background-image: radial-gradient(circle at 30% 20%, rgba(224,78,142,0.06) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(99,102,241,0.05) 0%, transparent 50%);"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] mb-3" style="color: #E73F80;">Our Work</p>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-[#0f172a] tracking-tight">Portfolio</h1>
            <p class="mt-5 text-lg text-slate-600 max-w-2xl mx-auto">A selection of projects we've delivered—web apps, mobile experiences, and brand identity.</p>
        </div>
    </section>

    <!-- Filters + Grid -->
    <section class="relative py-12 lg:py-16" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(233,84,125,0.06) 0%, transparent 60%);"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ active: 'all' }">
            <!-- Filter tabs -->
            <div class="flex flex-wrap justify-center gap-2 mb-12">
                <?php foreach ($categories as $slug => $label): ?>
                <button type="button" @click="active = '<?= $slug ?>'" class="px-5 py-2.5 rounded-full text-sm font-medium transition-all duration-300"
                    :class="active === '<?= $slug ?>' ? 'bg-[#E04E8E] text-white shadow-lg shadow-rose-500/30' : 'bg-white/80 text-slate-600 hover:bg-white hover:text-[#1e293b] border border-slate-200/80'">
                    <?= htmlspecialchars($label) ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php foreach ($display_items as $i => $item): ?>
                <a href="<?= htmlspecialchars($item['url']) ?>"
                   x-show="active === 'all' || active === '<?= $item['category'] ?>'"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 transform scale-95"
                   x-transition:enter-end="opacity-100 transform scale-100" target="_blank" rel="noopener" class="group block relative bg-white rounded-2xl overflow-hidden border border-slate-100/80 shadow-[0_4px_24px_rgba(0,0,0,0.05)] hover:shadow-[0_24px_48px_rgba(0,0,0,0.12)] hover:border-slate-200 hover:-translate-y-2 transition-all duration-500 ease-out">
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-t from-black/70 via-black/25 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 z-10 flex items-end justify-center pb-8">
                        <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/95 backdrop-blur text-sm font-semibold text-slate-800 shadow-xl group-hover:gap-3 transition-all duration-300">
                            View project
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                    <div class="aspect-[4/3] overflow-hidden bg-slate-100 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-rose-500/0 to-violet-500/0 group-hover:from-rose-500/10 group-hover:to-violet-500/10 transition-all duration-500 mix-blend-overlay"></div>
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    </div>
                    <div class="p-5 lg:p-6 border-t border-slate-100/60 group-hover:border-rose-200/60 transition-colors duration-300">
                        <span class="text-xs font-semibold uppercase tracking-wider" style="color: #E04E8E;"><?= htmlspecialchars($item['subtitle']) ?></span>
                        <h3 class="mt-2 text-lg font-bold text-[#1e293b] leading-tight group-hover:text-[#E04E8E] transition-colors duration-300"><?= htmlspecialchars($item['title']) ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- CTA strip -->
            <div class="mt-16 lg:mt-20 text-center">
                <p class="text-slate-600 mb-6">Have a project in mind?</p>
                <a href="<?= base_url('contact') ?>" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 hover:scale-[1.02] transition-all duration-300">
                    Get in touch
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';
