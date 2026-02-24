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
</body>
</html>
