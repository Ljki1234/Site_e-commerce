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
