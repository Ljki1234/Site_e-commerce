<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Models\PasswordResetCode;
use App\Models\LoginVerificationCode;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('auth.login', ['pageTitle' => 'Login', 'navbar' => true, 'footer' => true]);
    }

    public function login(Request $request): void
    {
        $errors = [];
        if (recaptcha_enabled()) {
            $token = (string) $request->input('g-recaptcha-response');
            $result = recaptcha_verify($token);
            if (!$result['success']) {
                $errors['recaptcha'] = 'Security check failed. Please try again.';
                $this->view('auth.login', [
                    'pageTitle' => 'Login',
                    'navbar' => true,
                    'footer' => true,
                    'errors' => $errors,
                    'old' => ['email' => (string) $request->input('email')],
                ]);
                return;
            }
        }

        $email = trim((string) $request->input('email'));
        $password = (string) $request->input('password');

        // Simple rate limiting: block after 5 failed attempts for 15 minutes per email+IP
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $key = strtolower($email) . '|' . $ip;
        $attempts = $_SESSION['login_attempts'][$key] ?? ['count' => 0, 'blocked_until' => 0];
        $now = time();
        if ($attempts['blocked_until'] > $now) {
            $errors['email'] = 'Too many login attempts. Please try again later.';
            $this->view('auth.login', [
                'pageTitle' => 'Login',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => ['email' => $email],
            ]);
            return;
        }

        if ($email === '') {
            $errors['email'] = 'Email is required.';
        }
        if ($password === '') {
            $errors['password'] = 'Password is required.';
        }

        if (!empty($errors)) {
            $this->view('auth.login', [
                'pageTitle' => 'Login',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => ['email' => $email],
            ]);
            return;
        }

        $user = User::findByEmail($email);
        if (!$user || !password_verify($password, $user['password'])) {
            $attempts['count']++;
            if ($attempts['count'] >= 5) {
                $attempts['blocked_until'] = $now + 900; // 15 minutes
                error_log(sprintf('Suspicious login activity for %s from IP %s', $email, $ip));
            }
            $_SESSION['login_attempts'][$key] = $attempts;
            $errors['email'] = 'Invalid email or password.';
            $this->view('auth.login', [
                'pageTitle' => 'Login',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => ['email' => $email],
            ]);
            return;
        }

        // Successful password check: reset attempts
        unset($_SESSION['login_attempts'][$key]);

        // MFA: send 6-digit code by email, then require verification
        $code = LoginVerificationCode::create($email, 10);
        send_login_verification_email($email, $code);
        $_SESSION['mfa_pending_email'] = $email;
        $this->redirect(base_url('login/verify'));
    }

    public function showLoginVerify(): void
    {
        $email = $_SESSION['mfa_pending_email'] ?? '';
        if ($email === '') {
            $this->redirect(base_url('login'));
            return;
        }
        $this->view('auth.login-verify', [
            'pageTitle' => 'Verify your login',
            'navbar' => true,
            'footer' => true,
            'email' => $email,
            'errors' => [],
            'old' => [],
        ]);
    }

    public function verifyLogin(Request $request): void
    {
        $email = $_SESSION['mfa_pending_email'] ?? '';
        if ($email === '') {
            $this->redirect(base_url('login'));
            return;
        }

        $code = trim((string) $request->input('code'));
        $errors = [];

        if (strlen($code) !== 6 || !ctype_digit($code)) {
            $errors['code'] = 'Please enter the 6-digit code sent to your email.';
        }

        if (!empty($errors)) {
            $this->view('auth.login-verify', [
                'pageTitle' => 'Verify your login',
                'navbar' => true,
                'footer' => true,
                'email' => $email,
                'errors' => $errors,
                'old' => ['code' => $code],
            ]);
            return;
        }

        if (!LoginVerificationCode::verify($email, $code)) {
            $errors['code'] = 'Invalid or expired code. Please try logging in again.';
            $this->view('auth.login-verify', [
                'pageTitle' => 'Verify your login',
                'navbar' => true,
                'footer' => true,
                'email' => $email,
                'errors' => $errors,
                'old' => ['code' => $code],
            ]);
            return;
        }

        $user = User::findByEmail($email);
        if (!$user) {
            unset($_SESSION['mfa_pending_email']);
            $this->redirect(base_url('login'));
            return;
        }

        unset($_SESSION['mfa_pending_email']);
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        $redirect = $user['role'] === 'admin' ? base_url('admin') : base_url();
        $this->redirect($redirect);
    }

    public function showRegister(): void
    {
        $this->view('auth.register', ['pageTitle' => 'Register', 'navbar' => true, 'footer' => true]);
    }

    public function register(Request $request): void
    {
        $errors = [];
        if (recaptcha_enabled()) {
            $token = (string) $request->input('g-recaptcha-response');
            $result = recaptcha_verify($token);
            if (!$result['success']) {
                $errors['recaptcha'] = 'Security check failed. Please try again.';
                $this->view('auth.register', [
                    'pageTitle' => 'Register',
                    'navbar' => true,
                    'footer' => true,
                    'errors' => $errors,
                    'old' => $request->all(),
                ]);
                return;
            }
        }

        $email = trim((string) $request->input('email'));
        $password = (string) $request->input('password');
        $password_confirmation = (string) $request->input('password_confirmation');
        $full_name = trim((string) $request->input('full_name'));
        $company = trim((string) $request->input('company'));
        $phone = trim((string) $request->input('phone'));

        if ($full_name === '') {
            $errors['full_name'] = 'Full name is required.';
        }
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address.';
        } elseif (User::findByEmail($email)) {
            $errors['email'] = 'This email is already registered.';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        }
        if ($password !== $password_confirmation) {
            $errors['password_confirmation'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $this->view('auth.register', [
                'pageTitle' => 'Register',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => [
                    'email' => $email,
                    'full_name' => $full_name,
                    'company' => $company,
                    'phone' => $phone,
                ],
            ]);
            return;
        }

        User::create([
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'company' => $company ?: null,
            'phone' => $phone ?: null,
            'role' => 'client',
            'status' => 'lead',
        ]);

        $user = User::findByEmail($email);
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];

        $this->redirect(base_url());
    }

    public function logout(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], (bool) $p['secure'], (bool) $p['httponly']);
        }
        session_destroy();
        $this->redirect(base_url('login'));
    }

    public function showForgotPassword(): void
    {
        $this->view('auth.forgot-password', ['pageTitle' => 'Forgot password', 'navbar' => true, 'footer' => true]);
    }

    public function sendResetCode(Request $request): void
    {
        $errors = [];
        if (recaptcha_enabled()) {
            $token = (string) $request->input('g-recaptcha-response');
            $result = recaptcha_verify($token);
            if (!$result['success']) {
                $errors['recaptcha'] = 'Security check failed. Please try again.';
                $this->view('auth.forgot-password', [
                    'pageTitle' => 'Forgot password',
                    'navbar' => true,
                    'footer' => true,
                    'errors' => $errors,
                    'old' => ['email' => (string) $request->input('email')],
                ]);
                return;
            }
        }

        $email = trim((string) $request->input('email'));
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email address.';
        }

        if (!empty($errors)) {
            $this->view('auth.forgot-password', [
                'pageTitle' => 'Forgot password',
                'navbar' => true,
                'footer' => true,
                'errors' => $errors,
                'old' => ['email' => $email],
            ]);
            return;
        }

        $user = User::findByEmail($email);
        if ($user) {
            $code = PasswordResetCode::create($email, 15);
            send_password_reset_email($email, $code);
        }
        // Always show same message for security (don't reveal if email exists)
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_code_sent'] = true;
        $this->redirect(base_url('reset-password'));
    }

    public function showResetPassword(): void
    {
        $email = $_SESSION['reset_email'] ?? '';
        if ($email === '') {
            $this->redirect(base_url('forgot-password'));
            return;
        }
        $codeSent = !empty($_SESSION['reset_code_sent']);
        unset($_SESSION['reset_code_sent']);
        $this->view('auth.reset-password', [
            'pageTitle' => 'Reset password',
            'navbar' => true,
            'footer' => true,
            'email' => $email,
            'codeSent' => $codeSent,
            'errors' => [],
            'old' => [],
        ]);
    }

    public function resetPassword(Request $request): void
    {
        $email = $_SESSION['reset_email'] ?? '';
        if ($email === '') {
            $this->redirect(base_url('forgot-password'));
            return;
        }

        $errors = [];
        if (recaptcha_enabled()) {
            $token = (string) $request->input('g-recaptcha-response');
            $result = recaptcha_verify($token);
            if (!$result['success']) {
                $errors['recaptcha'] = 'Security check failed. Please try again.';
                $this->view('auth.reset-password', [
                    'pageTitle' => 'Reset password',
                    'navbar' => true,
                    'footer' => true,
                    'email' => $email,
                    'errors' => $errors,
                    'old' => ['code' => (string) $request->input('code')],
                ]);
                return;
            }
        }

        $code = trim((string) $request->input('code'));
        $password = (string) $request->input('password');
        $password_confirmation = (string) $request->input('password_confirmation');
        $errors = [];

        if (strlen($code) !== 6 || !ctype_digit($code)) {
            $errors['code'] = 'Please enter the 6-digit code sent to your email.';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
        }
        if ($password !== $password_confirmation) {
            $errors['password_confirmation'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $this->view('auth.reset-password', [
                'pageTitle' => 'Reset password',
                'navbar' => true,
                'footer' => true,
                'email' => $email,
                'errors' => $errors,
                'old' => ['code' => $code],
            ]);
            return;
        }

        if (!PasswordResetCode::verify($email, $code)) {
            $errors['code'] = 'Invalid or expired code. Please request a new one.';
            $this->view('auth.reset-password', [
                'pageTitle' => 'Reset password',
                'navbar' => true,
                'footer' => true,
                'email' => $email,
                'errors' => $errors,
                'old' => ['code' => $code],
            ]);
            return;
        }

        $user = User::findByEmail($email);
        if ($user) {
            User::updatePassword((int) $user['id'], $password);
        }
        unset($_SESSION['reset_email']);
        $this->redirect(base_url('login') . '?reset=1');
    }
}
