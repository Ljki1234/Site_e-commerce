<?php
declare(strict_types=1);

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $base = rtrim($GLOBALS['config']['url'] ?? '', '/');
        $path = ltrim($path, '/');
        return $path ? $base . '/' . $path : $base;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return base_url(ltrim($path, '/'));
    }
}

if (!function_exists('auth')) {
    function auth(): ?array
    {
        if (empty($_SESSION['user_id'])) {
            return null;
        }
        return [
            'id' => (int) $_SESSION['user_id'],
            'email' => $_SESSION['email'] ?? '',
            'full_name' => $_SESSION['full_name'] ?? '',
            'role' => $_SESSION['role'] ?? 'client',
        ];
    }
}

if (!function_exists('generate_csrf_token')) {
    function generate_csrf_token(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time();

        return $token;
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token']) || !is_string($_SESSION['csrf_token'])) {
            return generate_csrf_token();
        }

        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        $token = htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8');
        return '<input type="hidden" name="_csrf" value="' . $token . '">';
    }
}

if (!function_exists('verify_csrf_token')) {
    /**
     * Verify CSRF token from the request. Use $regenerate = false for intermediate
     * steps (e.g. login POST) so the same token can be used on the next step (MFA verify).
     *
     * @param string|null $tokenFromRequest Token from POST['_csrf']
     * @param bool $regenerate If true, issue a new token after validation (default true)
     */
    function verify_csrf_token(?string $tokenFromRequest, bool $regenerate = true): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $sessionToken = $_SESSION['csrf_token'] ?? null;

        if (!is_string($sessionToken) || !is_string($tokenFromRequest) || $tokenFromRequest === '') {
            block_csrf_request();
        }

        if (!hash_equals($sessionToken, $tokenFromRequest)) {
            block_csrf_request();
        }

        if ($regenerate) {
            unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);
            generate_csrf_token();
        }
    }
}

if (!function_exists('block_csrf_request')) {
    function block_csrf_request(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['csrf_token'], $_SESSION['csrf_token_time']);

        http_response_code(403);
        die('Session expired or invalid form');
    }
}

if (!function_exists('send_login_verification_email')) {
    /** Send the 6-digit MFA code by email. Returns true on success. */
    function send_login_verification_email(string $to, string $code): bool
    {
        $fromEmail = config('mail.from_email', 'noreply@example.com');
        $fromName = config('mail.from_name', 'V Agency');
        $subject = 'Code de vérification - ' . ($GLOBALS['config']['name'] ?? 'V Agency');
        $body = "Bonjour,\n\n"
            . "Voici votre code de vérification pour vous connecter : " . $code . "\n\n"
            . "Ce code est valide 10 minutes. Ne le partagez avec personne.\n\n"
            . "Si vous n'êtes pas à l'origine de cette connexion, ignorez cet e-mail et changez votre mot de passe.\n\n"
            . "Cordialement,\n" . $fromName;

        if (!class_exists(\PHPMailer\PHPMailer\PHPMailer::class)) {
            return (bool) @mail($to, $subject, $body, 'Content-Type: text/plain; charset=UTF-8');
        }

        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->isHTML(false);

            $smtpHost = config('mail.smtp_host', '');
            if ($smtpHost !== '') {
                $mail->isSMTP();
                $mail->Host = $smtpHost;
                $mail->Port = (int) config('mail.smtp_port', 587);
                $mail->SMTPAuth = true;
                $mail->Username = config('mail.smtp_username', '');
                $mail->Password = config('mail.smtp_password', '');
                $enc = config('mail.smtp_encryption', 'tls');
                if ($enc === 'ssl') {
                    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                } elseif ($enc === 'tls') {
                    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                } else {
                    $mail->SMTPSecure = false;
                    $mail->SMTPAutoTLS = false;
                }
            } else {
                $mail->isMail();
            }

            $mail->send();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('send_password_reset_email')) {
    /** Send the 6-digit reset code by email using PHPMailer. Returns true on success. */
    function send_password_reset_email(string $to, string $code): bool
    {
        $fromEmail = config('mail.from_email', 'noreply@example.com');
        $fromName = config('mail.from_name', 'V Agency');
        $subject = 'Réinitialisation de votre mot de passe - ' . ($GLOBALS['config']['name'] ?? 'V Agency');
        $body = "Bonjour,\n\n"
            . "Vous avez demandé la réinitialisation de votre mot de passe.\n\n"
            . "Votre code à 6 chiffres : " . $code . "\n\n"
            . "Ce code est valide 15 minutes. Ne le partagez avec personne.\n\n"
            . "Si vous n'êtes pas à l'origine de cette demande, ignorez cet e-mail.\n\n"
            . "Cordialement,\n" . $fromName;

        if (!class_exists(\PHPMailer\PHPMailer\PHPMailer::class)) {
            return (bool) @mail($to, $subject, $body, 'Content-Type: text/plain; charset=UTF-8');
        }

        try {
            $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->isHTML(false);

            $smtpHost = config('mail.smtp_host', '');
            if ($smtpHost !== '') {
                $mail->isSMTP();
                $mail->Host = $smtpHost;
                $mail->Port = (int) config('mail.smtp_port', 587);
                $mail->SMTPAuth = true;
                $mail->Username = config('mail.smtp_username', '');
                $mail->Password = config('mail.smtp_password', '');
                $enc = config('mail.smtp_encryption', 'tls');
                if ($enc === 'ssl') {
                    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                } elseif ($enc === 'tls') {
                    $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                } else {
                    $mail->SMTPSecure = false;
                    $mail->SMTPAutoTLS = false;
                }
            } else {
                $mail->isMail();
            }

            $mail->send();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

if (!function_exists('recaptcha_enabled')) {
    /** Whether reCAPTCHA v3 is configured (both keys set). */
    function recaptcha_enabled(): bool
    {
        $siteKey = config('recaptcha.site_key', '');
        $secretKey = config('recaptcha.secret_key', '');
        return is_string($siteKey) && $siteKey !== '' && is_string($secretKey) && $secretKey !== '';
    }
}

if (!function_exists('recaptcha_site_key')) {
    /** reCAPTCHA v3 site key for the frontend. Use only in HTML/JS. */
    function recaptcha_site_key(): string
    {
        return (string) config('recaptcha.site_key', '');
    }
}

if (!function_exists('recaptcha_verify')) {
    /**
     * Verify reCAPTCHA v3 token with Google. Returns result array.
     *
     * @param string $token The g-recaptcha-response token from the form
     * @param float|null $minScore Minimum score (0.0–1.0). If null, uses config recaptcha.min_score
     * @return array{success: bool, score: float, action: string, error: string|null}
     */
    function recaptcha_verify(string $token, ?float $minScore = null): array
    {
        $secret = config('recaptcha.secret_key', '');
        if ($secret === '') {
            return ['success' => false, 'score' => 0.0, 'action' => '', 'error' => 'reCAPTCHA not configured'];
        }

        $minScore = $minScore ?? (float) config('recaptcha.min_score', 0.5);
        $out = ['success' => false, 'score' => 0.0, 'action' => '', 'error' => null];

        if ($token === '') {
            $out['error'] = 'missing-input-response';
            return $out;
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ];

        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query($data),
                'timeout' => 10,
            ],
        ];
        $ctx = stream_context_create($opts);
        $response = @file_get_contents($url, false, $ctx);
        if ($response === false) {
            $out['error'] = 'verification-request-failed';
            return $out;
        }

        $json = json_decode($response, true);
        if (!is_array($json)) {
            $out['error'] = 'invalid-json';
            return $out;
        }

        $out['success'] = !empty($json['success']);
        $out['score'] = isset($json['score']) ? (float) $json['score'] : 0.0;
        $out['action'] = isset($json['action']) ? (string) $json['action'] : '';
        if (!empty($json['error-codes']) && is_array($json['error-codes'])) {
            $out['error'] = implode(',', $json['error-codes']);
        }

        if ($out['success'] && ($out['score'] < $minScore)) {
            $out['success'] = false;
            $out['error'] = 'score-too-low';
        }

        return $out;
    }
}

if (!function_exists('recaptcha_script')) {
    /**
     * Output the reCAPTCHA v3 script tag. Call once per page if the page has a form using reCAPTCHA.
     */
    function recaptcha_script(): string
    {
        if (!recaptcha_enabled()) {
            return '';
        }
        $siteKey = htmlspecialchars(recaptcha_site_key(), ENT_QUOTES, 'UTF-8');
        $scriptUrl = htmlspecialchars('https://www.google.com/recaptcha/api.js?render=' . $siteKey, ENT_QUOTES, 'UTF-8');
        return '<script src="' . $scriptUrl . '" async defer></script>';
    }
}

if (!function_exists('recaptcha_field')) {
    /**
     * Hidden input for the reCAPTCHA token. Place inside the form.
     * JS will fill this before submit when recaptcha is enabled.
     */
    function recaptcha_field(): string
    {
        if (!recaptcha_enabled()) {
            return '';
        }
        return '<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">';
    }
}

if (!function_exists('recaptcha_debug')) {
    /**
     * Safe debug info for reCAPTCHA (no secret key). Use temporarily to verify config.
     * Remove or avoid output in production.
     *
     * @return array{enabled: bool, site_key_set: bool, secret_key_set: bool, site_key_preview: string, script_would_load: bool}
     */
    function recaptcha_debug(): array
    {
        $siteKey = config('recaptcha.site_key', '');
        $secretKey = config('recaptcha.secret_key', '');
        $siteKeyStr = is_string($siteKey) ? $siteKey : '';
        $secretKeyStr = is_string($secretKey) ? $secretKey : '';
        $enabled = $siteKeyStr !== '' && $secretKeyStr !== '';
        $preview = $siteKeyStr === '' ? '(empty)' : (substr($siteKeyStr, 0, 6) . '...' . substr($siteKeyStr, -4));
        return [
            'enabled' => $enabled,
            'site_key_set' => $siteKeyStr !== '',
            'secret_key_set' => $secretKeyStr !== '',
            'site_key_preview' => $preview,
            'script_would_load' => $enabled,
        ];
    }
}

if (!function_exists('config')) {
    /**
     * @param string $key Dot-notation key (e.g. 'paypal.client_id')
     * @param mixed $default
     * @return mixed
     */
    function config(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $v = $GLOBALS['config'] ?? [];
        foreach ($keys as $k) {
            $v = $v[$k] ?? $default;
            if (!is_array($v) && $v !== $default) {
                return $v;
            }
        }
        return $v;
    }
}
