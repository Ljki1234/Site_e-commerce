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
                    <a href="<?= base_url('contact') ?>" class="text-[13px] font-normal text-black hover:text-gray-800 uppercase tracking-[0.02em] transition">Contact</a>
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
                <a href="<?= base_url('contact') ?>" class="block py-2 text-black font-medium">Contact</a>
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
    <main class="<?= $mainClass ?? 'min-h-screen' ?>">
        <?= $content ?? '' ?>
    </main>
    <?php if (isset($footer) && $footer): ?>
        <?php require ROOT_PATH . '/resources/views/components/footer.php'; ?>
    <?php endif; ?>
</body>
</html>
