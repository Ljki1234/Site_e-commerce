<?php
$current = $current ?? '';
$items = $items ?? [];
$homeUrl = $homeUrl ?? base_url();
$icons = [
    'admin' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6h6v6a2 2 0 01-2 2h-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14h2a2 2 0 002-2v-2"/></svg>',
    'dashboard' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6h6v6a2 2 0 01-2 2h-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14h2a2 2 0 002-2v-2"/></svg>',
    'profile' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>',
    'packs' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
    'clients' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
    'orders' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>',
    'messages' => '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
];
?>
<aside class="w-64 min-h-screen flex-shrink-0 bg-white border-r border-slate-200/80 shadow-lg flex flex-col">
    <div class="p-5 border-b border-slate-100">
        <a href="<?= $homeUrl ?>" class="text-lg font-bold tracking-tight bg-gradient-to-r from-sky-500 to-sky-600 bg-clip-text text-transparent"><?= $brand ?? 'AtlasTech Solutions' ?></a>
    </div>
    <nav class="p-3 flex-1 overflow-y-auto">
        <!-- OVERVIEW -->
        <p class="px-3 pt-2 pb-1.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Overview</p>
        <div class="space-y-0.5">
            <?php
            $dashboard = $items[0] ?? null;
            if ($dashboard):
                $url = $dashboard['url'] ?? '#';
                $match = $dashboard['match'] ?? '';
                $active = $match === $current;
            ?>
            <a href="<?= htmlspecialchars($url) ?>" class="flex items-center justify-between gap-2 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 <?= $active ? 'bg-sky-50 text-sky-600 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                <span class="flex items-center gap-3">
                    <?= $icons[$dashboard['match'] ?? 'admin'] ?? $icons['admin'] ?? '' ?>
                    <?= htmlspecialchars($dashboard['label'] ?? 'Dashboard') ?>
                </span>
                <svg class="w-4 h-4 flex-shrink-0 <?= $active ? 'text-sky-500' : 'text-slate-400' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </a>
            <?php endif; ?>
        </div>

        <!-- MANAGEMENT -->
        <p class="px-3 pt-4 pb-1.5 text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Management</p>
        <div class="space-y-0.5">
            <?php for ($i = 1; $i < count($items); $i++): $item = $items[$i];
                $url = $item['url'] ?? '#';
                $label = $item['label'] ?? '';
                $match = $item['match'] ?? '';
                $active = $match === $current || ($current !== '' && strpos($url, $current) !== false);
                $icon = $icons[$match] ?? '';
            ?>
            <a href="<?= htmlspecialchars($url) ?>" class="flex items-center justify-between gap-2 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 <?= $active ? 'bg-sky-50 text-sky-600 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' ?>">
                <span class="flex items-center gap-3">
                    <?= $icon ?>
                    <?= htmlspecialchars($label) ?>
                </span>
                <svg class="w-4 h-4 flex-shrink-0 <?= $active ? 'text-sky-500' : 'text-slate-400' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <?php endfor; ?>
        </div>
    </nav>
    <div class="p-3 border-t border-slate-100">
        <div class="h-1 rounded-full bg-gradient-to-r from-sky-300 to-sky-400 opacity-60"></div>
    </div>
</aside>
