<?php
$type = $type ?? 'button';
$variant = $variant ?? 'primary';
$class = 'inline-flex items-center justify-center px-5 py-2.5 rounded-lg font-medium transition focus:outline-none focus:ring-2 focus:ring-offset-2 ';
$class .= match($variant) {
    'primary' => 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-lg shadow-primary-500/30 hover:shadow-primary-500/40 focus:ring-primary-500',
    'secondary' => 'bg-slate-200 text-slate-800 hover:bg-slate-300 focus:ring-slate-400',
    'outline' => 'border-2 border-primary-500 text-primary-600 hover:bg-primary-50 focus:ring-primary-500',
    'danger' => 'bg-red-500 text-white hover:bg-red-600 focus:ring-red-500',
    'ghost' => 'text-slate-600 hover:bg-slate-100 focus:ring-slate-300',
    default => 'bg-primary-500 text-white hover:bg-primary-600 focus:ring-primary-500',
};
?>
<button type="<?= $type ?>" <?= isset($attrs) ? $attrs : '' ?> class="<?= trim($class . ' ' . ($extraClass ?? '')) ?>">
    <?= $slot ?? $label ?? '' ?>
</button>
