<?php
$id = $id ?? $name ?? uniqid('input');
$type = $type ?? 'text';
$class = 'block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-slate-900 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition ' . ($extraClass ?? '');
$errorClass = isset($error) && $error ? 'border-red-500 focus:border-red-500 focus:ring-red-500/20' : '';
?>
<div class="<?= $wrapperClass ?? '' ?>">
    <?php if (!empty($label)): ?>
        <label for="<?= $id ?>" class="block text-sm font-medium text-slate-700 mb-1"><?= htmlspecialchars($label) ?></label>
    <?php endif; ?>
    <input type="<?= $type ?>" id="<?= $id ?>" name="<?= $name ?? $id ?>"
           value="<?= htmlspecialchars($value ?? '') ?>"
           class="<?= $class ?> <?= $errorClass ?>"
           <?= $required ?? false ? 'required' : '' ?>
           <?= $attrs ?? '' ?>>
    <?php if (!empty($error)): ?>
        <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</div>
