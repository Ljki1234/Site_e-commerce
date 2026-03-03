<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'AtlasTech Solutions') ?> | AtlasTech Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa', 500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a' },
                        accent: { 400: '#c084fc', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9' },
                        rose: { 400: '#fb7185', 500: '#f43f5e', 600: '#e11d48' },
                        navy: { 700: '#2d3748', 800: '#1a202c', 900: '#0f172a' }
                    },
                    fontFamily: { sans: ['DM Sans', 'Inter', 'system-ui', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', system-ui, sans-serif; }
    </style>
    <link rel="stylesheet" href="<?= asset('css/chatbot.css') ?>">
    <?php
    $recaptchaOk = function_exists('recaptcha_enabled') && recaptcha_enabled();
    $recaptchaSiteKey = function_exists('recaptcha_site_key') ? recaptcha_site_key() : '';
    if ($recaptchaOk): ?>
    <meta id="recaptcha-site-key" content="<?= htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8') ?>">
    <?= recaptcha_script() ?>
    <?php endif; ?>
    <!-- recaptcha: <?= $recaptchaOk ? 'enabled' : 'disabled (site_key or secret_key empty in config/app.php)' ?> -->
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <?php if (isset($navbar) && $navbar): ?>
    <nav class="fixed top-0 left-0 right-0 z-50 bg-sky-100/95 border-b border-sky-200/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-[72px] gap-6">
                <a href="<?= base_url() ?>" class="text-[1.35rem] font-bold text-black tracking-tight uppercase flex-shrink-0">AtlasTech Solutions</a>
                <div class="hidden md:flex items-center justify-end gap-5 flex-shrink-0 flex-1 min-w-0">
                    <a href="<?= base_url() ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Home</a>
                    <a href="<?= base_url('services') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Services</a>
                    <a href="<?= base_url('packs') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Pricing</a>
                    <a href="<?= base_url('portfolio') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Portfolio</a>
                    <a href="<?= base_url('team') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Our Team</a>
                    <?php $user = auth(); if ($user): ?>
                        <?php if ($user['role'] === 'admin'): ?>
                            <a href="<?= base_url('admin') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Admin</a>
                        <?php else: ?>
                            <a href="<?= base_url('dashboard') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Dashboard</a>
                        <?php endif; ?>
                        <a href="<?= base_url('logout') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 transition">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_url('login') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Login</a>
                        <a href="<?= base_url('contact') ?>" class="inline-flex items-center justify-center h-10 px-6 rounded-full text-[13px] font-medium text-white bg-gradient-to-r from-blue-500 to-violet-500 shadow-md hover:shadow-lg transition flex-shrink-0">Request A Quote</a>
                    <?php endif; ?>
                </div>
                <button type="button" class="md:hidden p-2 text-black" @click="$refs.mobileMenu.classList.toggle('hidden')" x-ref="mobileMenuBtn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            <div class="hidden md:hidden pb-4" x-ref="mobileMenu">
                <a href="<?= base_url() ?>" class="block py-2 text-black font-medium">Home</a>
                <a href="<?= base_url('services') ?>" class="block py-2 text-black font-medium">Services</a>
                <a href="<?= base_url('packs') ?>" class="block py-2 text-black font-medium">Pricing</a>
                <a href="<?= base_url('portfolio') ?>" class="block py-2 text-black font-medium">Portfolio</a>
                <a href="<?= base_url('team') ?>" class="block py-2 text-black font-medium">Our Team</a>
                <?php if ($user ?? null): ?>
                    <a href="<?= ($user['role'] ?? '') === 'admin' ? base_url('admin') : base_url('dashboard') ?>" class="block py-2 text-black font-medium">Dashboard</a>
                    <a href="<?= base_url('logout') ?>" class="block py-2 text-rose-600 font-medium">Logout</a>
                <?php else: ?>
                    <a href="<?= base_url('login') ?>" class="block py-2 text-black font-medium">Login</a>
                    <a href="<?= base_url('contact') ?>" class="block py-2 text-violet-600 font-semibold">Request A Quote</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    <main class="<?= htmlspecialchars($mainClass ?? 'min-h-screen') ?>">
        <?= $content ?? '' ?>
    </main>
    <?php if (isset($footer) && $footer): ?>
        <?php require ROOT_PATH . '/resources/views/components/footer.php'; ?>
    <?php endif; ?>

    <!-- Chatbot widget -->
    <div id="chatbot-widget">
        <button id="chatbot-toggle" aria-label="Open chat">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" aria-hidden="true">
                <path fill="currentColor" d="M108.2 322.7C114.3 307.5 112.2 290.1 102.6 276.8C88.1 256.7 80 233.1 80 208C80 141.2 140.5 80 224 80C307.5 80 368 141.2 368 208C368 274.8 307.5 336 224 336C208.1 336 192.9 333.7 178.7 329.5C168.4 326.4 157.3 327 147.3 331L96.9 351.2L108.3 322.7zM32 208C32 243.8 43.6 277.1 63.7 304.8L33.9 379.2C32.6 382.4 32 385.8 32 389.2C32 404 44 416 58.8 416C62.2 416 65.6 415.3 68.8 414.1L165.1 375.6C183.7 381.1 203.5 384 224 384C330 384 416 305.2 416 208C416 110.8 330 32 224 32C118 32 32 110.8 32 208zM416 576C436.6 576 456.3 573 474.9 567.6L571.2 606.1C574.4 607.4 577.8 608 581.2 608C596 608 608 596 608 581.2C608 577.8 607.3 574.4 606.1 571.2L576.4 496.8C596.4 469 608.1 435.7 608.1 400C608.1 317.6 546.4 248.5 463.1 229.3C461.5 245.6 458 261.2 453 276.2C516.9 291 560.2 343.5 560.2 400.1C560.2 425.2 552.1 448.8 537.6 468.9C528 482.2 525.9 499.5 532 514.8L543.4 543.3L493 523.1C483 519.1 471.9 518.6 461.6 521.6C447.4 525.8 432.2 528.1 416.3 528.1C344.1 528.1 289.2 482.4 275.6 426.9C260 430.1 243.9 431.9 227.5 432.1C243.9 514 322.2 576.1 416.3 576.1z"/>
            </svg>
        </button>
        <div id="chatbot-panel" class="chatbot-hidden">
            <div class="chatbot-header">
                <div>
                    <div class="chatbot-title">AtlasTech Assistant</div>
                    <div class="chatbot-subtitle">Ask us anything</div>
                </div>
                <button id="chatbot-close" class="chatbot-close" aria-label="Close chat">×</button>
            </div>
            <div id="chatbot-messages" class="chatbot-messages">
                <div class="chatbot-message chatbot-bot">
                    <div class="bubble">
                        Hi 👋 I’m the AtlasTech chatbot.
                        Ask me about services, packages, pricing or how to contact us.
                    </div>
                </div>
            </div>
            <div class="chatbot-footer">
                <div class="chatbot-quick-actions">
                    <button class="chatbot-quick" data-text="Tell me about your services">Our Services</button>
                    <button class="chatbot-quick" data-text="What packages and pricing do you offer?">Our Pricing</button>
                    <button class="chatbot-quick" data-text="How can I contact AtlasTech?">Contact</button>
                </div>
                <form id="chatbot-form" autocomplete="off">
                    <input type="text" id="chatbot-input" name="message" maxlength="255" placeholder="Type your question..." required>
                    <button type="submit" id="chatbot-send">➤</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= asset('js/testimonials.js') ?>"></script>
    <script src="<?= asset('js/chatbot.js') ?>" defer></script>
    <?php if (!empty($recaptchaOk)): ?>
    <script src="<?= asset('js/recaptcha-v3.js') ?>" defer></script>
    <?php endif; ?>
</body>
</html>
