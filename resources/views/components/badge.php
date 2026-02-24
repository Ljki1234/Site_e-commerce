<?php
$variant = $variant ?? 'default';
$class = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ';
$class .= match($variant) {
    'success' => 'bg-emerald-100 text-emerald-800',
    'warning' => 'bg-amber-100 text-amber-800',
    'danger' => 'bg-red-100 text-red-800',
    'info' => 'bg-primary-100 text-primary-800',
    'pending' => 'bg-slate-100 text-slate-700',
    'in_progress' => 'bg-blue-100 text-blue-800',
    'completed' => 'bg-emerald-100 text-emerald-800',
    'cancelled' => 'bg-red-100 text-red-800',
    default => 'bg-slate-100 text-slate-700',
};
?>
<span class="<?= trim($class . ' ' . ($class ?? '')) ?>"><?= htmlspecialchars($text ?? $label ?? '') ?></span>
