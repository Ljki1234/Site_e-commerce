# Google reCAPTCHA v3 Integration

This project uses **Google reCAPTCHA v3** (invisible) to secure forms. No checkbox is shown; the score is computed in the background and verified on the server.

---

## 1. Where to set Site Key and Secret Key

**File:** `config/app.php`

In the `recaptcha` array, set your keys:

```php
'recaptcha' => [
    'site_key' => 'YOUR_RECAPTCHA_V3_SITE_KEY',   // Public – safe in HTML/JS
    'secret_key' => 'YOUR_RECAPTCHA_V3_SECRET_KEY', // Private – server only
    'min_score' => 0.5,  // Reject if score < 0.5 (0.0 = bot, 1.0 = human)
],
```

- **Site key:** Used in the browser (included in the page). Get it from the [reCAPTCHA admin console](https://www.google.com/recaptcha/admin).
- **Secret key:** Used only in PHP for server-side verification. **Never** expose it in HTML or JavaScript.
- **min_score:** Requests with a score below this value are rejected (default `0.5`).

If both keys are empty, reCAPTCHA is **disabled**: no script is loaded and no server check is performed. Forms work as before.

---

## 2. Getting keys

1. Go to [https://www.google.com/recaptcha/admin](https://www.google.com/recaptcha/admin).
2. Register a new site:
   - **Label:** e.g. "AtlasTech Solutions"
   - **reCAPTCHA type:** **reCAPTCHA v3**
   - **Domains:** add your domain(s), e.g. `localhost`, `yourdomain.com`
3. Submit and copy the **Site Key** and **Secret Key** into `config/app.php` as above.

---

## 2b. Debugging: script not loading / grecaptcha undefined

If the reCAPTCHA script does not appear in DevTools → Network and `grecaptcha` is undefined:

### 1. Check the HTML comment (View Source)

In the page **View Source** (Ctrl+U / Cmd+U), search for `recaptcha`. You should see a comment like:

- `<!-- recaptcha: enabled -->` → Script should be present; check step 3–4 below.
- `<!-- recaptcha: disabled (site_key or secret_key empty in config/app.php) -->` → **Keys are missing.** The script is only included when **both** `site_key` and `secret_key` are non-empty in `config/app.php`.

**Fix:** Open `config/app.php`, find the `recaptcha` array, and set both:

```php
'recaptcha' => [
    'site_key' => 'your_actual_site_key_here',
    'secret_key' => 'your_actual_secret_key_here',
    'min_score' => 0.5,
],
```

Save and reload the page. View Source again; the comment should say `enabled` and you should see:

- `<meta id="recaptcha-site-key" content="...">`
- `<script src="https://www.google.com/recaptcha/api.js?render=...">`

### 2. Verify config with recaptcha_debug() (optional)

Temporarily add this in a view (e.g. at the top of `resources/views/pages/contact.php`) or on a test page:

```php
<?php if (isset($_GET['recaptcha_debug']) && ($_GET['recaptcha_debug'] === '1')): ?>
<pre><?php print_r(recaptcha_debug()); ?></pre>
<?php endif; ?>
```

Visit e.g. `https://yoursite/contact?recaptcha_debug=1`. You should see:

- `enabled` => true only when both keys are set
- `site_key_set` / `secret_key_set` => true when each is non-empty
- `site_key_preview` => first 6 and last 4 chars (never the full key)
- `script_would_load` => true when the script is output

Remove the debug block when done.

### 3. Confirm the script tag in View Source

Search for `google.com/recaptcha` or `api.js`. You should see:

```html
<script src="https://www.google.com/recaptcha/api.js?render=YOUR_SITE_KEY" async defer></script>
```

If this line is missing, the PHP condition is false (keys empty or `recaptcha_enabled()` false). Fix config as in step 1.

### 4. CSP or headers blocking the script

- In DevTools → **Network**, reload and check if the request to `https://www.google.com/recaptcha/api.js?...` appears. If it’s **blocked** or **red**, check the **Console** for CSP errors (e.g. “Refused to load the script…”).
- Your server or framework may send a **Content-Security-Policy** header that blocks `https://www.google.com`. If you use CSP, add:
  - `script-src https://www.google.com https://www.gstatic.com`
  - `frame-src https://www.recaptcha.net https://www.google.com`
- In **PHP**, check for `header('Content-Security-Policy: ...')` or similar; ensure Google’s domains are allowed.

### 5. Script load order

The reCAPTCHA API script is loaded with `async defer`, so it can finish loading after the page. Our `recaptcha-v3.js` waits for `grecaptcha` to be defined (with a short timeout) before getting a token. If the script tag is present and not blocked, `grecaptcha` should be defined shortly after load. If it’s still undefined in the console, wait a couple of seconds and type `grecaptcha` again, or run it after submitting the form (our script runs on submit).

---

## 3. Forms protected

| Form              | Action name        | View / Controller                    |
|-------------------|--------------------|--------------------------------------|
| Contact           | `contact`          | `pages/contact.php` → `PageController::submitContact` |
| Login             | `login`            | `auth/login.php` → `AuthController::login` |
| Register          | `register`         | `auth/register.php` → `AuthController::register` |
| Forgot password   | `forgot_password`  | `auth/forgot-password.php` → `AuthController::sendResetCode` |
| Reset password    | `reset_password`   | `auth/reset-password.php` → `AuthController::resetPassword` |
| Order (packs)     | `order`            | `pages/packs.php` → `OrderController::initiate` |

---

## 4. How it works

### Client-side

1. The layout (`resources/views/layouts/app.php`) loads the reCAPTCHA script and `recaptcha-v3.js` only when keys are set.
2. Each protected form has:
   - `data-recaptcha-action="action_name"` (e.g. `contact`, `login`)
   - A hidden input for the token: `<?= recaptcha_field() ?>`
3. On submit, `recaptcha-v3.js`:
   - Prevents immediate submit
   - Requests a token from Google with the form’s action name
   - Puts the token in the hidden input `g-recaptcha-response`
   - Submits the form

### Server-side

1. Controllers call `recaptcha_enabled()` to see if reCAPTCHA is configured.
2. If enabled, they read `g-recaptcha-response` from the request and call `recaptcha_verify($token)`.
3. `recaptcha_verify()`:
   - Sends the token to Google’s verification API
   - Checks `success` and `score >= min_score` (default 0.5)
4. If verification fails, the request is rejected with a generic message (“Security check failed. Please try again.”) and the form is re-displayed. Existing validation (required fields, email format, etc.) is unchanged and runs after reCAPTCHA passes.

---

## 5. Adding reCAPTCHA to another form

**In the view:**

1. Add the reCAPTCHA hidden field and action on the form:

```php
<form action="<?= base_url('your/route') ?>" method="POST" data-recaptcha-action="your_action_name">
    <?= csrf_field() ?>
    <?= recaptcha_field() ?>
    <!-- rest of fields -->
</form>
```

2. If the form can show errors, display the reCAPTCHA error like other errors:

```php
<?php if (!empty($errors['recaptcha'])): ?>
<div class="..."><?= htmlspecialchars($errors['recaptcha']) ?></div>
<?php endif; ?>
```

**In the controller (POST handler):**

1. At the start of the handler, before other validation:

```php
if (recaptcha_enabled()) {
    $token = (string) $request->input('g-recaptcha-response');
    $result = recaptcha_verify($token);
    if (!$result['success']) {
        $errors['recaptcha'] = 'Security check failed. Please try again.';
        // Re-render form with $errors and $old, then return
        return;
    }
}
```

---

## 6. Security notes

- **Secret key:** Only in `config/app.php` (or env). Never in views, JS, or client-accessible files.
- **Score:** Default `0.5` is a reasonable balance. Lower (e.g. 0.3) allows more traffic; higher (e.g. 0.7) is stricter and may block some real users.
- **CSRF:** reCAPTCHA runs in addition to your existing CSRF protection; it does not replace it.
