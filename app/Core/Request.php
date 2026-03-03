<?php
declare(strict_types=1);

namespace App\Core;

class Request
{
    private bool $csrfValidated = false;

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    /**
     * @param mixed $default
     * @return mixed
     */
    public function input(string $key, $default = null)
    {
        $this->ensureValidCsrf();
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    public function all(): array
    {
        $this->ensureValidCsrf();
        return array_merge($_GET, $_POST);
    }

    /**
     * @return array|null
     */
    public function file(string $key)
    {
        $this->ensureValidCsrf();
        return $_FILES[$key] ?? null;
    }

    public function has(string $key): bool
    {
        $this->ensureValidCsrf();
        return isset($_POST[$key]) || isset($_GET[$key]);
    }

    public function isPost(): bool
    {
        $this->ensureValidCsrf();
        return $this->method() === 'POST';
    }

    public function isGet(): bool
    {
        return $this->method() === 'GET';
    }

    private function ensureValidCsrf(): void
    {
        if ($this->csrfValidated) {
            return;
        }

        if ($this->method() !== 'POST') {
            return;
        }

        $formToken = $_POST['_csrf'] ?? null;
        $path = $this->getCurrentPath();
        // Do not regenerate token on POST /login so the same token works for MFA verify step
        $regenerate = !($path === '/login' || rtrim($path, '/') === '/login');
        \verify_csrf_token(is_string($formToken) ? $formToken : null, $regenerate);
        $this->csrfValidated = true;
    }

    /** Normalized request path (matches Router logic) for CSRF regeneration rules. */
    private function getCurrentPath(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $basePath = dirname($_SERVER['SCRIPT_NAME'] ?? '');
        if ($basePath !== '/' && $basePath !== '' && substr($uri, 0, strlen($basePath)) === $basePath) {
            $uri = substr($uri, strlen($basePath)) ?: '/';
        }
        return '/' . trim($uri, '/');
    }
}
