<?php
$content = ob_start();

$main_services = [
    ['title' => 'Logo & Branding Service', 'description' => 'Consistent visual identity for your business. From logo design to brand guidelines and style guides—we help you stand out.', 'image' => asset('assets/image3.jfif'), 'icon_bg' => 'bg-amber-50', 'link' => base_url('contact')],
    ['title' => 'Website Design & Development', 'description' => 'Custom, responsive websites built with modern standards. Clean code, performance and accessibility at the core.', 'image' => asset('assets/image4.jfif'), 'icon_bg' => 'bg-sky-50', 'link' => base_url('portfolio')],
    ['title' => 'Mobile App Development', 'description' => 'Native and cross-platform apps for iOS and Android. From concept to launch—sites and apps for every device.', 'image' => asset('assets/image5.jfif'), 'icon_bg' => 'bg-emerald-50', 'link' => base_url('portfolio')],
    ['title' => 'Digital Marketing Service', 'description' => 'SEO, content strategy and ongoing support. We help your digital presence grow and convert.', 'image' => asset('assets/image6.jfif'), 'icon_bg' => 'bg-violet-50', 'link' => base_url('contact')],
];

$more_services = [
    ['title' => 'CMS & e‑commerce', 'description' => 'Blogs, portfolios and online stores. We integrate and customize CMS and e‑commerce so you can manage content and orders easily.', 'link' => base_url('packs')],
    ['title' => 'Maintenance & support', 'description' => 'Ongoing updates, security patches and small changes. We keep your site fast and secure so you can focus on your business.', 'link' => base_url('contact')],
];
?>
<div class="min-h-screen bg-white">
    <!-- Hero -->
    <section class="relative pt-28 pb-16 lg:pt-32 lg:pb-20 overflow-hidden bg-gradient-to-b from-sky-50/80 via-white to-white">
        <div class="absolute inset-0 pointer-events-none opacity-40" style="background-image: radial-gradient(circle at 30% 20%, rgba(224,78,142,0.06) 0%, transparent 50%), radial-gradient(circle at 70% 80%, rgba(99,102,241,0.05) 0%, transparent 50%);"></div>
        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] mb-3" style="color: #E73F80;">What we do</p>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-[#0f172a] tracking-tight">Our Services</h1>
            <p class="mt-5 text-lg text-slate-600 max-w-2xl mx-auto">From branding to websites, mobile-ready design and digital presence—we cover what you need.</p>
        </div>
    </section>

    <!-- Main services grid -->
    <section class="relative py-12 lg:py-16" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.08) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(233,84,125,0.06) 0%, transparent 60%);"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] mb-2" style="color: #E73F80;">Services we're providing</p>
                <h2 class="text-2xl lg:text-3xl font-bold text-[#0f172a] tracking-tight">Design &amp; Development</h2>
                <p class="mt-3 text-slate-600 max-w-2xl mx-auto">From strategy to design, development and launch—we keep you in the loop and deliver on time.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
                <?php foreach ($main_services as $i => $s): ?>
                <a href="<?= htmlspecialchars($s['link']) ?>" class="group group/card flex flex-col bg-white rounded-2xl border border-slate-100/80 shadow-lg shadow-slate-200/40 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-slate-300/30 hover:-translate-y-1 hover:border-rose-100">
                    <div class="relative pt-8 pb-5 px-5 lg:px-6 flex flex-col flex-1">
                        <div class="absolute top-0 right-0 w-32 h-32 opacity-[0.04]" style="background: radial-gradient(circle at 80% 20%, #64748b 1px, transparent 1px); background-size: 12px 12px;"></div>
                        <div class="relative w-16 h-16 rounded-2xl <?= $s['icon_bg'] ?> flex items-center justify-center flex-shrink-0 overflow-hidden self-center ring-2 ring-white shadow-md group-hover/card:scale-105 transition-transform duration-300">
                            <img src="<?= htmlspecialchars($s['image']) ?>" alt="<?= htmlspecialchars($s['title']) ?>" class="w-full h-full object-contain object-center" />
                        </div>
                        <h3 class="mt-5 text-base font-bold text-[#1e293b] leading-snug group-hover/card:text-[#E04E8E] transition-colors duration-300"><?= htmlspecialchars($s['title']) ?></h3>
                        <p class="mt-2 text-slate-600 text-sm leading-relaxed flex-1"><?= htmlspecialchars($s['description']) ?></p>
                        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-[#1e293b] group-hover/card:text-[#E04E8E] transition-colors">
                            Learn more
                            <svg class="w-4 h-4 group-hover/card:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- More we offer -->
            <div class="mt-14 lg:mt-16">
                <p class="text-center text-sm font-semibold text-slate-500 uppercase tracking-wider mb-6">More we offer</p>
                <div class="grid md:grid-cols-2 gap-5 lg:gap-6">
                    <?php foreach ($more_services as $s): ?>
                    <a href="<?= htmlspecialchars($s['link']) ?>" class="group flex items-start gap-4 p-6 lg:p-7 bg-white/90 rounded-2xl border border-slate-200/80 shadow-md hover:shadow-lg hover:border-rose-100 hover:bg-white transition-all duration-300">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-gradient-to-br from-rose-50 to-pink-50 flex items-center justify-center group-hover:from-rose-100 group-hover:to-pink-100 transition-colors">
                            <svg class="w-6 h-6 text-[#E04E8E]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-lg font-bold text-[#1e293b] group-hover:text-[#E04E8E] transition-colors"><?= htmlspecialchars($s['title']) ?></h3>
                            <p class="mt-2 text-slate-600 text-sm leading-relaxed"><?= htmlspecialchars($s['description']) ?></p>
                            <span class="mt-3 inline-flex items-center gap-1 text-sm font-semibold text-[#E04E8E]">
                                View details
                                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- CTA strip -->
            <div class="mt-16 lg:mt-20 text-center">
                <p class="text-slate-600 mb-6">Fixed scope, clear pricing. Pick the pack that fits your project.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?= base_url('packs') ?>" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 hover:scale-[1.02] transition-all duration-300">
                        View website packs &amp; pricing
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="<?= base_url('contact') ?>" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold text-[#0f172a] bg-white border-2 border-slate-200 hover:border-[#E04E8E] hover:text-[#E04E8E] transition-all duration-300">
                        Get in touch
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';