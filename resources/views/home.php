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
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M264 112L376 112C380.4 112 384 115.6 384 120L384 160L256 160L256 120C256 115.6 259.6 112 264 112zM208 120L208 160L128 160C92.7 160 64 188.7 64 224L64 320L369 320C402.8 290.1 447.3 272 496 272C524.6 272 551.6 278.2 576 289.4L576 224C576 188.7 547.3 160 512 160L432 160L432 120C432 89.1 406.9 64 376 64L264 64C233.1 64 208 89.1 208 120zM288 416C270.3 416 256 401.7 256 384L256 368L64 368L64 480C64 515.3 92.7 544 128 544L321.4 544C310.2 519.6 304 492.6 304 464C304 447.4 306.1 431.3 310 416L288 416zM640 464C640 384.5 575.5 320 496 320C416.5 320 352 384.5 352 464C352 543.5 416.5 608 496 608C575.5 608 640 543.5 640 464zM496 384C504.8 384 512 391.2 512 400L512 448L544 448C552.8 448 560 455.2 560 464C560 472.8 552.8 480 544 480L496 480C487.2 480 480 472.8 480 464L480 400C480 391.2 487.2 384 496 384z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">15+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Year In Business</p>
                    </div>
                </div>
                <div class="flex items-center gap-5 lg:gap-6">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M320 80C377.4 80 424 126.6 424 184C424 241.4 377.4 288 320 288C262.6 288 216 241.4 216 184C216 126.6 262.6 80 320 80zM96 152C135.8 152 168 184.2 168 224C168 263.8 135.8 296 96 296C56.2 296 24 263.8 24 224C24 184.2 56.2 152 96 152zM0 480C0 409.3 57.3 352 128 352C140.8 352 153.2 353.9 164.9 357.4C132 394.2 112 442.8 112 496L112 512C112 523.4 114.4 534.2 118.7 544L32 544C14.3 544 0 529.7 0 512L0 480zM521.3 544C525.6 534.2 528 523.4 528 512L528 496C528 442.8 508 394.2 475.1 357.4C486.8 353.9 499.2 352 512 352C582.7 352 640 409.3 640 480L640 512C640 529.7 625.7 544 608 544L521.3 544zM472 224C472 184.2 504.2 152 544 152C583.8 152 616 184.2 616 224C616 263.8 583.8 296 544 296C504.2 296 472 263.8 472 224zM160 496C160 407.6 231.6 336 320 336C408.4 336 480 407.6 480 496L480 512C480 529.7 465.7 544 448 544L192 544C174.3 544 160 529.7 160 512L160 496z"/>
                        </svg>
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
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M273 151.1L288 171.8L303 151.1C328 116.5 368.2 96 410.9 96C484.4 96 544 155.6 544 229.1L544 231.7C544 249.3 540.6 267.3 534.5 285.4C512.7 276.8 488.9 272 464 272C358 272 272 358 272 464C272 492.5 278.2 519.6 289.4 544C288.9 544 288.5 544 288 544C272.5 544 257.2 539.4 244.9 529.9C171.9 474.2 32 343.9 32 231.7L32 229.1C32 155.6 91.6 96 165.1 96C207.8 96 248 116.5 273 151.1zM320 464C320 384.5 384.5 320 464 320C543.5 320 608 384.5 608 464C608 543.5 543.5 608 464 608C384.5 608 320 543.5 320 464zM521.4 403.1C514.3 397.9 504.2 399.5 499 406.6L446 479.5L419.2 452.7C413 446.5 402.8 446.5 396.6 452.7C390.4 458.9 390.4 469.1 396.6 475.3L436.6 515.3C439.9 518.6 444.5 520.3 449.2 519.9C453.9 519.5 458.1 517.1 460.9 513.4L524.9 425.4C530.1 418.3 528.5 408.2 521.4 403.1z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">450</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Happy Clients</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M197.8 100.3C208.7 107.9 211.3 122.9 203.7 133.7L147.7 213.7C143.6 219.5 137.2 223.2 130.1 223.8C123 224.4 116 222 111 217L71 177C61.7 167.6 61.7 152.4 71 143C80.3 133.6 95.6 133.7 105 143L124.8 162.8L164.4 106.2C172 95.3 187 92.7 197.8 100.3zM197.8 260.3C208.7 267.9 211.3 282.9 203.7 293.7L147.7 373.7C143.6 379.5 137.2 383.2 130.1 383.8C123 384.4 116 382 111 377L71 337C61.6 327.6 61.6 312.4 71 303.1C80.4 293.8 95.6 293.7 104.9 303.1L124.7 322.9L164.3 266.3C171.9 255.4 186.9 252.8 197.7 260.4zM288 160C288 142.3 302.3 128 320 128L544 128C561.7 128 576 142.3 576 160C576 177.7 561.7 192 544 192L320 192C302.3 192 288 177.7 288 160zM288 320C288 302.3 302.3 288 320 288L544 288C561.7 288 576 302.3 576 320C576 337.7 561.7 352 544 352L320 352C302.3 352 288 337.7 288 320zM224 480C224 462.3 238.3 448 256 448L544 448C561.7 448 576 462.3 576 480C576 497.7 561.7 512 544 512L256 512C238.3 512 224 497.7 224 480zM128 440C150.1 440 168 457.9 168 480C168 502.1 150.1 520 128 520C105.9 520 88 502.1 88 480C88 457.9 105.9 440 128 440z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">150+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Projects Done</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight" style="color: #1a202c;">8+</p>
                        <p class="text-sm lg:text-base mt-0.5" style="color: #718096;">Years Experience</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 lg:gap-5">
                    <div class="flex-shrink-0 w-20 h-20 lg:w-24 lg:h-24 rounded-[1.25rem] bg-white shadow-[0_4px_14px_rgba(0,0,0,0.08)] flex items-center justify-center p-3" style="border-radius: 1.25rem 1.25rem 1rem 1.5rem;">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#1a202c]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor" aria-hidden="true">
                            <path d="M320 128C241 128 175.3 185.3 162.3 260.7C171.6 257.7 181.6 256 192 256L208 256C234.5 256 256 277.5 256 304L256 400C256 426.5 234.5 448 208 448L192 448C139 448 96 405 96 352L96 288C96 164.3 196.3 64 320 64C443.7 64 544 164.3 544 288L544 456.1C544 522.4 490.2 576.1 423.9 576.1L336 576L304 576C277.5 576 256 554.5 256 528C256 501.5 277.5 480 304 480L336 480C362.5 480 384 501.5 384 528L384 528L424 528C463.8 528 496 495.8 496 456L496 435.1C481.9 443.3 465.5 447.9 448 447.9L432 447.9C405.5 447.9 384 426.4 384 399.9L384 303.9C384 277.4 405.5 255.9 432 255.9L448 255.9C458.4 255.9 468.3 257.5 477.7 260.6C464.7 185.3 399.1 127.9 320 127.9z"/>
                        </svg>
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

    <!-- Clients Testimonial -->
    <section id="testimonials-section" class="py-12 lg:py-16 relative overflow-hidden bg-white">
        <!-- Motifs ondulés bleu-gris à gauche -->
        <div class="absolute bottom-0 left-0 w-80 h-80 opacity-[0.08]" aria-hidden="true" style="color: #94a3b8;">
            <svg viewBox="0 0 200 200" class="w-full h-full" fill="none" stroke="currentColor" stroke-width="0.6">
                <path d="M0 30 Q30 10 60 30 T120 30 T180 30
                         M0 60 Q30 40 60 60 T120 60 T180 60
                         M0 90 Q30 70 60 90 T120 90 T180 90
                         M0 120 Q30 100 60 120 T120 120 T180 120
                         M0 150 Q30 130 60 150 T120 150 T180 150
                         M0 180 Q30 160 60 180 T120 180 T180 180" />
            </svg>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                <!-- Colonne gauche : titre -->
                <div class="lg:col-span-5">
                    <span class="inline-block text-xs font-bold uppercase tracking-[0.25em] mb-2" style="color: #E91E63;">
                        Clients Testimonial
                    </span>
                    <h2 class="text-3xl sm:text-4xl lg:text-[2.5rem] xl:text-[2.75rem] font-bold leading-tight text-black">
                        What our clients say<br>about our Company.
                    </h2>
                </div>

                <!-- Colonne droite : slider simple en JS vanilla -->
                <div class="lg:col-span-7 relative pl-6 lg:pl-10">
                    <div class="relative min-h-[200px]">
                        <!-- Témoignage 1 -->
                        <div class="testimonial-slide text-left pr-4" data-index="0">
                            <p class="text-[15px] lg:text-[17px] leading-relaxed text-slate-600">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Lorem Ipsum has been the industry's standard dummy text ever since.
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop"
                                     alt="Moana Smile" class="w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover
                                     border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg text-[#1A237E]">Moana Smile</p>
                                    <p class="text-sm mt-0.5 text-[#444444]">CEO of Niwax, Jaipur, India</p>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 2 -->
                        <div class="testimonial-slide text-left pr-4 hidden" data-index="1">
                            <p class="text-[15px] lg:text-[17px] leading-relaxed text-slate-600">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                It has survived not only five centuries, but also the leap into electronic typesetting, 
                                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 
                                sheets containing Lorem Ipsum passages.
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1544723795-3fb6469f5b39?w=150&h=150&fit=crop"
                                     alt="David M." class="w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover
                                     border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg text-[#1A237E]">David M.</p>
                                    <p class="text-sm mt-0.5 text-[#444444]">Head of Product, Finexa</p>
                                </div>
                            </div>
                        </div>

                        <!-- Témoignage 3 -->
                        <div class="testimonial-slide text-left pr-4 hidden" data-index="2">
                            <p class="text-[15px] lg:text-[17px] leading-relaxed text-slate-600">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, 
                                and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
                            </p>
                            <div class="mt-4 flex items-center gap-4">
                                <img src="<?= asset('assets/image01.jpeg') ?>"
                                     alt="Emma R." class="w-16 h-16 lg:w-[72px] lg:h-[72px] rounded-full object-cover
                                     border-2 border-white shadow-md ring-1 ring-slate-200/50">
                                <div>
                                    <p class="font-bold text-lg text-[#1A237E]">Emma R.</p>
                                    <p class="text-sm mt-0.5 text-[#444444]">Operations Manager, BrightHome</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dots de navigation -->
                    <div class="flex justify-end gap-3 mt-5 lg:mt-6">
                        <button type="button" class="testimonial-dot w-3 h-3 rounded-full border-2 border-slate-300 hover:border-slate-400 transition-all duration-300 flex-shrink-0" data-target="0" aria-label="Client 1"></button>
                        <button type="button" class="testimonial-dot w-3 h-3 rounded-full border-2 border-slate-300 hover:border-slate-400 transition-all duration-300 flex-shrink-0" data-target="1" aria-label="Client 2"></button>
                        <button type="button" class="testimonial-dot w-3 h-3 rounded-full border-2 border-slate-300 hover:border-slate-400 transition-all duration-300 flex-shrink-0" data-target="2" aria-label="Client 3"></button>
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
