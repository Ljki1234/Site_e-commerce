<?php
$content = ob_start();
$sent = isset($_GET['sent']);
?>
<div class="pt-24 pb-16 px-4 min-h-screen bg-gradient-to-br from-sky-50 via-white to-indigo-50">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1">
                <span class="inline-block text-sm font-semibold text-rose-500 uppercase tracking-widest mb-3">Contact now</span>
                <h1 class="text-3xl lg:text-4xl font-bold text-navy-800">Have Question? Write a Message</h1>
                <?php if ($sent): ?>
                <div class="mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800">
                    Thank you. Your message has been sent. We'll be in touch soon.
                </div>
                <?php endif; ?>
                <form action="<?= base_url('contact') ?>" method="POST" class="mt-8 space-y-5">
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>"
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 <?= isset($errors['name']) ? 'border-red-500' : '' ?>"
                                   placeholder="Your full name" required>
                            <?php if (!empty($errors['name'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['name']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 <?= isset($errors['email']) ? 'border-red-500' : '' ?>"
                                   placeholder="your@email.com" required>
                            <?php if (!empty($errors['email'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Contact Number</label>
                            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20"
                                   placeholder="+1 000 000 0000">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                            <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($old['subject'] ?? '') ?>"
                                   class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 <?= isset($errors['subject']) ? 'border-red-500' : '' ?>"
                                   placeholder="Subject" required>
                            <?php if (!empty($errors['subject'])): ?>
                                <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['subject']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5"
                                  class="block w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 <?= isset($errors['message']) ? 'border-red-500' : '' ?>"
                                  placeholder="Your message..." required><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                        <?php if (!empty($errors['message'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?= htmlspecialchars($errors['message']) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="flex items-start gap-3">
                        <input type="checkbox" id="terms" name="terms" value="1" class="mt-1 rounded border-slate-300 text-rose-500 focus:ring-rose-500">
                        <label for="terms" class="text-sm text-slate-600">I agree to the <strong>Terms &amp; Conditions</strong> of AtlasTech Solutions.</label>
                    </div>
                    <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-semibold bg-gradient-to-r from-orange-400 via-rose-400 to-rose-500 text-white shadow-xl shadow-rose-500/30 hover:shadow-rose-500/40 transition">Submit <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg></button>
                </form>
            </div>
            <div class="order-1 lg:order-2 relative hidden lg:block">
                <div class="relative w-full aspect-square max-w-lg mx-auto rounded-3xl border border-white/80 shadow-2xl overflow-hidden">
                    <img src="<?= asset('assets/image14.jfif') ?>" alt="Contact" class="w-full h-full object-cover object-center">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require ROOT_PATH . '/resources/views/layouts/app.php';
