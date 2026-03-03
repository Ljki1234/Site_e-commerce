<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> | AtlasTech Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: { 50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 300: '#7dd3fc', 400: '#38bdf8', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1', 800: '#075985', 900: '#0c4a6e' }, accent: { 500: '#8b5cf6', 600: '#7c3aed' } } } } }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', system-ui, sans-serif; } </style>
    <link rel="stylesheet" href="<?= asset('css/chatbot.css') ?>">
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <?php
        $items = [
            ['url' => base_url('dashboard'), 'label' => 'Dashboard', 'match' => 'dashboard'],
            ['url' => base_url('dashboard/profile'), 'label' => 'Profile', 'match' => 'profile'],
        ];
        $homeUrl = base_url('dashboard');
        $current = 'dashboard';
        if (strpos($_SERVER['REQUEST_URI'] ?? '', 'profile') !== false) $current = 'profile';
        if (strpos($_SERVER['REQUEST_URI'] ?? '', 'orders') !== false) $current = 'orders';
        ?>
        <?php require ROOT_PATH . '/resources/views/components/sidebar.php'; ?>
        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-14 flex-shrink-0 bg-white border-b border-slate-200 flex items-center justify-between px-6">
                <div></div>
                <div class="flex items-center gap-4 ml-auto">
                    <a href="<?= base_url() ?>" class="text-sm text-slate-500 hover:text-slate-700 transition-colors">View site</a>
                    <a href="<?= base_url('logout') ?>" class="text-sm text-slate-500 hover:text-slate-700 transition-colors">Logout</a>
                </div>
            </header>
            <main class="flex-1 p-6 lg:p-8 overflow-auto bg-slate-50/50">
                <?= $content ?? '' ?>
            </main>
        </div>
    </div>
    <!-- Chatbot widget (dashboard) -->
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
    <script src="<?= asset('js/chatbot.js') ?>" defer></script>
</body>
</html>
