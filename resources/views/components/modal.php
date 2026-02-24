<div x-data="{ open: false }" x-init="open = <?= !empty($open) ? 'true' : 'false' ?>"
     @keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="fixed inset-0 z-50 overflow-y-auto"
     x-transition:enter="ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="open = false"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div x-show="open"
             @click.stop
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="relative w-full max-w-lg rounded-2xl bg-white shadow-2xl border border-slate-100 p-6">
            <?php if (!empty($title)): ?>
                <h3 class="text-lg font-semibold text-slate-900 mb-4"><?= htmlspecialchars($title) ?></h3>
            <?php endif; ?>
            <?= $slot ?? $content ?? '' ?>
            <?php if (!empty($dismissible)): ?>
                <button type="button" @click="open = false" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>
