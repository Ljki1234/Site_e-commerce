<?php
$content = ob_start();
$packs = $packs ?? [];
$portfolio = $portfolio ?? [];
?>
<div class="pt-0">
    <!-- Hero -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-to-br from-sky-100 via-white to-indigo-100">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-20 w-24 h-24 rounded-full bg-sky-200/50 blur-2xl"></div>
            <div class="absolute top-1/3 right-1/4 w-16 h-16 rounded-full bg-rose-200/40 blur-xl"></div>
            <div class="absolute bottom-1/4 left-1/3 w-20 h-20 rounded-full bg-amber-200/40 blur-xl"></div>
            <div class="absolute top-40 right-40 w-3 h-3 rounded-full bg-sky-400/60"></div>
            <div class="absolute bottom-60 left-60 w-4 h-4 rounded-full bg-rose-400/50"></div>
            <div class="absolute top-1/2 right-20 w-2 h-2 rounded-full bg-indigo-400/60"></div>
            <svg class="absolute bottom-0 right-0 w-1/2 h-1/2 text-slate-200/50" viewBox="0 0 200 200" fill="currentColor"><circle cx="150" cy="150" r="80" fill="none" stroke="currentColor" stroke-width="1"/><circle cx="150" cy="150" r="50" fill="none" stroke="currentColor" stroke-width="0.5"/></svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-navy-800 leading-tight">Creative Web Development Company</h1>
                    <p class="mt-6 text-lg text-slate-600 max-w-xl leading-relaxed">We build modern, fast websites tailored to your business. From landing pages to full web applications—clean code, clear process, and on-time delivery.</p>
                    <a href="<?= base_url('portfolio') ?>" class="mt-10 inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 transition">View Case Studies &gt;</a>
                </div>
                <div class="relative hidden lg:block">
                    <div class="relative w-full aspect-square max-w-md mx-auto rounded-3xl bg-gradient-to-br from-sky-50 to-rose-50 border border-white/80 shadow-2xl flex items-center justify-center overflow-hidden p-6">
                        <img src="<?= asset('assets/image1.jfif') ?>" alt="Web development & digital solutions" class="w-full h-full object-contain object-center" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Agency -->
    <section class="py-20 lg:py-28 bg-white relative">
        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative w-full aspect-[4/3] max-w-lg rounded-3xl bg-gradient-to-br from-sky-50 to-indigo-50 border border-slate-100 shadow-xl overflow-hidden flex items-center justify-center p-4">
                        <img src="<?= asset('assets/image2.jfif') ?>" alt="About Agency - Web development team" class="w-full h-full object-contain object-center" />
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <span class="inline-block text-sm font-semibold text-rose-500 uppercase tracking-widest mb-3">We are creative agency</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-navy-800">About Agency</h2>
                    <p class="mt-6 text-slate-600 leading-relaxed">We are a team of designers and developers who love building websites that look great and perform even better. Every project starts with understanding your goals and your audience.</p>
                    <p class="mt-4 text-slate-600 leading-relaxed">From strategy to design, development, and launch—we keep you in the loop and deliver on time.</p>
                    <div class="mt-6 pl-4 border-l-4 border-rose-500 bg-slate-50/80 rounded-r-lg py-3 pr-4">
                        <p class="text-slate-600 text-sm leading-relaxed">We provide you best and creative consulting service. Your success is our priority—we combine design and technology to deliver results that grow your business.</p>
                    </div>
                    <div class="mt-8 flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-sky-400 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">WD</div>
                        <div>
                            <p class="font-semibold text-navy-800">WebDev Team</p>
                            <p class="text-sm text-slate-500">Founder of AtlasTech Solutions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="py-14 lg:py-20 bg-[#e0f2f7] relative overflow-hidden">
        <div class="absolute inset-0 opacity-60" style="background-image: radial-gradient(circle, #94a3b8 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <p class="text-xs font-semibold text-rose-500 uppercase tracking-[0.2em] mb-2">Services we're providing</p>
                <h2 class="text-2xl lg:text-3xl font-bold text-[#1e293b]">Our Design &amp; Development Services</h2>
                <p class="mt-3 text-slate-600 text-sm max-w-2xl mx-auto leading-relaxed">From branding to websites, mobile-ready design, and digital presence—we cover what you need.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">
                <a href="<?= base_url('services') ?>" class="bg-white rounded-2xl p-5 lg:p-6 shadow-md border border-slate-100/80 flex flex-col hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0 overflow-hidden self-center">
                        <img src="<?= asset('assets/image3.jfif') ?>" alt="Logo & Branding" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-[#1e293b] leading-snug">Logo &amp; Branding</h3>
                    <p class="mt-2 text-slate-600 text-xs leading-relaxed flex-1">Consistent visual identity for your business.</p>
                    <span class="mt-3 text-[#1e293b] font-medium text-xs hover:text-rose-500 transition inline-flex items-center gap-1">Learn More &gt;</span>
                </a>
                <a href="<?= base_url('portfolio') ?>" class="bg-white rounded-2xl p-5 lg:p-6 shadow-md border border-slate-100/80 flex flex-col hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-sky-50 flex items-center justify-center flex-shrink-0 overflow-hidden self-center">
                        <img src="<?= asset('assets/image4.jfif') ?>" alt="Website Design" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-[#1e293b] leading-snug">Website Design &amp; Development</h3>
                    <p class="mt-2 text-slate-600 text-xs leading-relaxed flex-1">Modern, responsive websites.</p>
                    <span class="mt-3 text-[#1e293b] font-medium text-xs hover:text-rose-500 transition inline-flex items-center gap-1">Learn More &gt;</span>
                </a>
                <a href="<?= base_url('portfolio') ?>" class="bg-white rounded-2xl p-5 lg:p-6 shadow-md border border-slate-100/80 flex flex-col hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0 overflow-hidden self-center">
                        <img src="<?= asset('assets/image5.jfif') ?>" alt="Mobile App" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-[#1e293b] leading-snug">Mobile App Development</h3>
                    <p class="mt-2 text-slate-600 text-xs leading-relaxed flex-1">Sites and apps for every device.</p>
                    <span class="mt-3 text-[#1e293b] font-medium text-xs hover:text-rose-500 transition inline-flex items-center gap-1">Learn More &gt;</span>
                </a>
                <a href="<?= base_url('contact') ?>" class="bg-white rounded-2xl p-5 lg:p-6 shadow-md border border-slate-100/80 flex flex-col hover:shadow-lg transition">
                    <div class="w-14 h-14 rounded-xl bg-violet-50 flex items-center justify-center flex-shrink-0 overflow-hidden self-center">
                        <img src="<?= asset('assets/image6.jfif') ?>" alt="Digital Marketing" class="w-full h-full object-contain" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-[#1e293b] leading-snug">Digital Marketing</h3>
                    <p class="mt-2 text-slate-600 text-xs leading-relaxed flex-1">SEO and ongoing support.</p>
                    <span class="mt-3 text-[#1e293b] font-medium text-xs hover:text-rose-500 transition inline-flex items-center gap-1">Learn More &gt;</span>
                </a>
            </div>
        </div>
    </section>

    <?php if (!empty($packs)): ?>
    <!-- Website Packs -->
    <section class="py-14 lg:py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-rose-50/40"></div>
        <div class="absolute top-0 left-0 w-[80%] h-[70%] rounded-full bg-gradient-to-br from-rose-200/25 to-pink-200/20 blur-3xl -translate-x-1/4 -translate-y-1/4"></div>
        <div class="absolute bottom-0 right-0 w-[60%] h-[50%] rounded-full bg-gradient-to-tl from-violet-200/20 to-slate-200/25 blur-3xl translate-x-1/4 translate-y-1/4"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl lg:text-4xl font-bold text-[#0f172a] tracking-tight">Website Packs</h2>
                <p class="mt-3 text-slate-600 text-base leading-relaxed">Fixed scope, clear pricing. Pick the pack that fits your project.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-4 lg:gap-6 items-stretch">
                <?php $pack_index = 0; foreach ($packs as $pack): $is_popular = (count($packs) >= 2 && $pack_index === 1); $pack_index++; ?>
                <div class="group relative flex flex-col <?= $is_popular ? 'md:-mt-2 md:mb-2' : '' ?>">
                    <?php if ($is_popular): ?>
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-10 px-4 py-1 rounded-full bg-gradient-to-r from-rose-500 to-pink-500 text-white text-xs font-bold uppercase tracking-wider shadow-lg shadow-rose-500/30">Most Popular</div>
                    <?php endif; ?>
                    <div class="flex-1 rounded-3xl border-2 <?= $is_popular ? 'border-rose-200 bg-white shadow-xl shadow-slate-200/50 shadow-rose-500/5' : 'border-slate-200/80 bg-white shadow-lg shadow-slate-200/40' ?> p-6 lg:p-7 flex flex-col transition-all duration-300 hover:shadow-2xl hover:shadow-slate-300/30 <?= $is_popular ? 'hover:border-rose-300 hover:shadow-rose-500/10' : 'hover:border-slate-300' ?>">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl lg:text-2xl font-bold text-[#0f172a]"><?= htmlspecialchars($pack['name']) ?></h3>
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
                            <span class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-rose-600 to-pink-600 bg-clip-text text-transparent"><?= number_format((float)($pack['price'] ?? 0), 0) ?></span>
                        </div>
                        <ul class="mt-5 space-y-3 flex-1">
                            <?php foreach (($pack['features'] ?? []) as $f): ?>
                            <li class="flex items-center gap-3 text-slate-700">
                                <span class="flex-shrink-0 w-5 h-5 rounded-full bg-rose-50 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="text-sm"><?= htmlspecialchars($f) ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="<?= base_url('packs') ?>#pack-<?= (int)($pack['id'] ?? 0) ?>" class="mt-6 inline-flex justify-center items-center gap-2 px-5 py-3 rounded-2xl font-semibold text-white bg-gradient-to-r from-rose-500 via-rose-500 to-pink-500 shadow-lg shadow-rose-500/30 hover:shadow-xl hover:shadow-rose-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
                            View details
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-8">
                <a href="<?= base_url('packs') ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-[#0f172a] bg-slate-100/80 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                    See all packs &amp; pricing
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Stats -->
    <section class="py-14 lg:py-20 relative overflow-hidden" style="background: linear-gradient(to bottom right, #E0F2F7 0%, #e5f0f5 40%, #f0eef8 70%, #F5F0FA 100%);">
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center items-center gap-6 lg:gap-8 mb-12 lg:mb-16">
                <div class="flex items-center gap-5 lg:gap-6">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">15+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Year In Business</p>
                    </div>
                </div>
                <div class="flex items-center gap-5 lg:gap-6">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">80+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Team Members</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">450</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Happy Clients</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">150+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Projects Done</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">8+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Years Experience</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 0a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">24/7</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Support Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Latest Creative Work -->
    <section class="py-14 lg:py-20 relative overflow-hidden" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.06) 1px, transparent 1px); background-size: 24px 24px;">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-[#0f172a] tracking-tight">Our Latest Creative Work</h2>
                <p class="mt-3 text-slate-600 leading-relaxed">A selection of projects we've delivered—web apps, mobile experiences, and brand identity.</p>
            </div>
            <?php
            $work_items = $portfolio;
            if (empty($work_items)) {
                $work_items = [
                    ['title' => 'Ecommerce Development', 'description' => 'Web Application', 'image_url' => asset('assets/image9.jfif'), 'project_url' => base_url('portfolio')],
                    ['title' => 'Creative App', 'description' => 'iOS, Android', 'image_url' => asset('assets/image11.jfif'), 'project_url' => base_url('portfolio')],
                    ['title' => 'Brochure Design', 'description' => 'Graphic, Print', 'image_url' => asset('assets/image12.jfif'), 'project_url' => base_url('portfolio')],
                ];
            }
            $work_items = array_slice($work_items, 0, 3);
            ?>
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <?php foreach ($work_items as $item): ?>
                <a href="<?= htmlspecialchars($item['project_url'] ?? base_url('portfolio')) ?>" class="group group block rounded-2xl border-2 border-slate-200/80 bg-white shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-rose-200 hover:-translate-y-1">
                    <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                        <img src="<?= htmlspecialchars($item['image_url'] ?? asset('assets/image9.jfif')) ?>" alt="<?= htmlspecialchars($item['title'] ?? 'Project') ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                    </div>
                    <div class="p-5 lg:p-6">
                        <p class="text-xs font-semibold text-rose-500 uppercase tracking-wider"><?= htmlspecialchars($item['description'] ?? $item['subtitle'] ?? 'Project') ?></p>
                        <h3 class="mt-2 text-lg font-bold text-[#0f172a] group-hover:text-rose-600 transition-colors"><?= htmlspecialchars($item['title'] ?? '') ?></h3>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-10">
                <a href="<?= base_url('portfolio') ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-full font-semibold text-[#0f172a] bg-white border-2 border-slate-200 hover:border-rose-300 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                    View full portfolio
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Industries We Work For (fond comme image2 : crème/rose lavande bas-gauche → blanc) -->
    <section class="py-14 lg:py-20 relative overflow-hidden" style="background: linear-gradient(to top right, #fef9e7 0%, #fdf2f8 35%, #faf5ff 70%, #ffffff 100%);">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                <!-- Left: heading + description -->
                <div class="lg:col-span-4 lg:pr-4">
                    <span class="inline-block text-xs font-bold uppercase tracking-[0.2em] mb-4" style="color: #E74C3C;">Industries We Work For</span>
                    <h2 class="text-3xl lg:text-4xl xl:text-[2.5rem] font-bold leading-tight" style="color: #1A202C;">
                        Helping<br>Businesses in All<br>Domains
                    </h2>
                    <p class="mt-5 text-sm leading-relaxed" style="color: #6C757D;">Successfully delivered digital products Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <!-- Right: grid of 12 cards (pastels comme l'image) -->
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 lg:gap-4">
                        <?php
                        $industries = [
                            ['name' => 'Social Networking', 'bg' => '#b6e3f0', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                            ['name' => 'Digital Marketing', 'bg' => '#fffacd', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
                            ['name' => 'Ecommerce Development', 'bg' => '#c8f0c8', 'icon' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ['name' => 'Video Service', 'bg' => '#ffdab9', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                            ['name' => 'Banking Service', 'bg' => '#e8e8b8', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            ['name' => 'Enterprise Service', 'bg' => '#ffb6c1', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                            ['name' => 'Education Service', 'bg' => '#e0bbe4', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'],
                            ['name' => 'Tour and Travels', 'bg' => '#90ee90', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0h.5a2.5 2.5 0 002.5-2.5V3.935M12 20.065V18a2 2 0 012-2h.5a2.5 2.5 0 002.5 2.5v1.065M3.055 11V18a2 2 0 002 2h.5a2.5 2.5 0 002.5-2.5v-7.065M3.055 11V6a2 2 0 012-2h.5a2.5 2.5 0 002.5 2.5v7.065'],
                            ['name' => 'Health Service', 'bg' => '#add8e6', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                            ['name' => 'Event & Ticket', 'bg' => '#b0e0e6', 'icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
                            ['name' => 'Restaurant Service', 'bg' => '#fdfd96', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                            ['name' => 'Business Consultant', 'bg' => '#c1e1c1', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                        ];
                        foreach ($industries as $ind): ?>
                        <div class="rounded-[1.25rem] p-4 lg:p-5 text-center transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col items-center justify-center min-h-[100px]" style="background-color: <?= $ind['bg'] ?>;">
                            <svg class="w-8 h-8 flex-shrink-0 mb-2" style="color: #1A202C;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="<?= $ind['icon'] ?>"/></svg>
                            <p class="text-xs lg:text-sm font-semibold leading-tight" style="color: #1A202C;"><?= htmlspecialchars($ind['name']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Clients Testimonial (style exact image: 2 colonnes, photo circulaire, vagues bleu-gris, dots rose) -->
    <section class="py-8 lg:py-10 relative overflow-hidden bg-white">
        <!-- Motifs ondulés bleu-gris à gauche (comme l'image) -->
        <div class="absolute bottom-0 left-0 w-80 h-80 opacity-[0.08]" aria-hidden="true" style="color: #94a3b8;">
            <svg viewBox="0 0 200 200" class="w-full h-full" fill="none" stroke="currentColor" stroke-width="0.6"><path d="M0 30 Q30 10 60 30 T120 30 T180 30 M0 60 Q30 40 60 60 T120 60 T180 60 M0 90 Q30 70 60 90 T120 90 T180 90 M0 120 Q30 100 60 120 T120 120 T180 120 M0 150 Q30 130 60 150 T120 150 T180 150 M0 180 Q30 160 60 180 T120 180 T180 180"/></svg>
        </div>
        <div class="absolute top-0 left-0 w-64 h-64 opacity-[0.06]" aria-hidden="true" style="color: #94a3b8;">
            <svg viewBox="0 0 200 200" class="w-full h-full" fill="none" stroke="currentColor" stroke-width="0.6"><path d="M0 50 Q40 30 80 50 T160 50 M0 90 Q40 70 80 90 T160 90 M0 130 Q40 110 80 130 T160 130"/></svg>
        </div>
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ current: 0, total: 3, startAuto() { setInterval(() => { this.current = (this.current + 1) % this.total }, 3000) } }" x-init="startAuto()">
            <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                <!-- Colonne gauche : titre (style exact) -->
                <div class="lg:col-span-5">
                    <span class="inline-block text-xs font-bold uppercase tracking-[0.25em] mb-2" style="color: #E91E63;">Clients Testimonial</span>
                    <h2 class="text-3xl sm:text-4xl lg:text-[2.5rem] xl:text-[2.75rem] font-bold leading-tight text-black">What our clients say<br>about our Company</h2>
                </div>
                <!-- Colonne droite : slider horizontal (décalé un peu à droite) -->
                <div class="lg:col-span-7 relative pl-6 lg:pl-10">
                    <div class="relative overflow-hidden min-h-[180px]">
                        <!-- Slides en position absolue pour glissement horizontal (pas de saut vertical) -->
                        <!-- Slide 1 -->
                        <div x-show="current === 0" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full" class="absolute inset-0 text-left w-full pr-4" style="display: none;">
                            <p class="leading-relaxed text-base lg:text-lg" style="color: #333333;">AtlasTech Solutions delivered our new site on time and within budget. The team was responsive and the result exceeded our expectations.</p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop" alt="Jane K." class="flex-shrink-0 w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg" style="color: #1A237E;">Jane K.</p>
                                    <p class="text-sm mt-0.5" style="color: #444444;">Marketing Director, TechCo</p>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div x-show="current === 1" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full" class="absolute inset-0 text-left w-full pr-4" style="display: none;">
                            <p class="leading-relaxed text-base lg:text-lg" style="color: #333333;">Professional, creative, and easy to work with. Our e-commerce platform launched smoothly and sales have grown since day one.</p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&h=150&fit=crop" alt="Mike R." class="flex-shrink-0 w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg" style="color: #1A237E;">Mike R.</p>
                                    <p class="text-sm mt-0.5" style="color: #444444;">Founder, ShopFlow</p>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div x-show="current === 2" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 -translate-x-full" class="absolute inset-0 text-left w-full pr-4" style="display: none;">
                            <p class="leading-relaxed text-base lg:text-lg" style="color: #333333;">Clear communication and a modern, fast website. We recommend AtlasTech Solutions to any business looking to level up their online presence.</p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&h=150&fit=crop" alt="Sarah L." class="flex-shrink-0 w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg" style="color: #1A237E;">Sarah L.</p>
                                    <p class="text-sm mt-0.5" style="color: #444444;">CEO, GreenStart</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dots en bas à droite : actif = rose plein + contour rose, inactif = contour gris -->
                    <div class="flex justify-end gap-3 mt-5 lg:mt-6">
                        <button type="button" @click="current = 0" class="w-3 h-3 rounded-full transition-all duration-300 flex-shrink-0" :class="current === 0 ? 'bg-[#E91E63] ring-2 ring-[#E91E63] ring-offset-2 scale-110' : 'bg-transparent border-2 border-slate-300 hover:border-slate-400'" aria-label="Slide 1"></button>
                        <button type="button" @click="current = 1" class="w-3 h-3 rounded-full transition-all duration-300 flex-shrink-0" :class="current === 1 ? 'bg-[#E91E63] ring-2 ring-[#E91E63] ring-offset-2 scale-110' : 'bg-transparent border-2 border-slate-300 hover:border-slate-400'" aria-label="Slide 2"></button>
                        <button type="button" @click="current = 2" class="w-3 h-3 rounded-full transition-all duration-300 flex-shrink-0" :class="current === 2 ? 'bg-[#E91E63] ring-2 ring-[#E91E63] ring-offset-2 scale-110' : 'bg-transparent border-2 border-slate-300 hover:border-slate-400'" aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA (fond dégradé doux comme image2 : crème → rose/lavande) -->
    <section class="relative py-14 lg:py-20 overflow-hidden border-t border-slate-200/50" style="background: linear-gradient(to bottom right, #fefce8 0%, #fef9e7 30%, #fdf2f8 60%, #faf5ff 100%);">
        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl lg:text-3xl font-bold text-[#1e293b]">Ready to start your project?</h2>
            <p class="mt-3 text-slate-600 max-w-xl mx-auto">Tell us about your goals and we'll get back with a clear proposal.</p>
            <a href="<?= base_url('contact') ?>" class="mt-8 inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 transition">
                Get in touch
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';
