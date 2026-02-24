<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin') ?> | AtlasTech Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#f0f9ff', 100: '#e0f2fe', 500: '#0ea5e9', 600: '#0284c7' },
                        admin: { sky: '#0ea5e9', 'sky-light': '#f0f9ff' }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <style> body { font-family: 'DM Sans', system-ui, sans-serif; } </style>
</head>
<body class="bg-[#f6f6f7] text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <?php
        $items = [
            ['url' => base_url('admin'), 'label' => 'Dashboard', 'match' => 'admin'],
            ['url' => base_url('admin/packs'), 'label' => 'Service Packs', 'match' => 'packs'],
            ['url' => base_url('admin/clients'), 'label' => 'Clients', 'match' => 'clients'],
            ['url' => base_url('admin/orders'), 'label' => 'Orders', 'match' => 'orders'],
            ['url' => base_url('admin/messages'), 'label' => 'Messages', 'match' => 'messages'],
        ];
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $current = 'admin';
        if (strpos($uri, '/admin/packs') !== false) $current = 'packs';
        elseif (strpos($uri, '/admin/clients') !== false) $current = 'clients';
        elseif (strpos($uri, '/admin/orders') !== false) $current = 'orders';
        elseif (strpos($uri, '/admin/messages') !== false) $current = 'messages';
        $homeUrl = base_url('admin');
        ?>
        <?php require ROOT_PATH . '/resources/views/components/sidebar.php'; ?>
        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 flex-shrink-0 bg-white/90 backdrop-blur border-b border-slate-200/80 flex items-center justify-between px-6 lg:px-8 shadow-sm">
                <?php if (!empty($pageTitle)): ?><h1 class="text-xl font-bold text-[#0f172a] tracking-tight"><?= htmlspecialchars($pageTitle) ?></h1><?php endif; ?>
                <div class="flex items-center gap-3 ml-auto">
                    <a href="<?= base_url() ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-colors">View site</a>
                    <a href="<?= base_url('logout') ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-red-50 transition-colors">Logout</a>
                </div>
            </header>
            <main class="flex-1 p-6 lg:p-8 overflow-auto" style="background-color: #f6f6f7; background-image: radial-gradient(circle, rgba(0,0,0,0.06) 1px, transparent 1px); background-size: 20px 20px;">
                <div class="relative"><?= $content ?? '' ?></div>
            </main>
        </div>
    </div>
</body>
</html>
