<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    /** @param callable|array $handler */
    public function get(string $path, $handler, array $middleware = []): self
    {
        return $this->add('GET', $path, $handler, $middleware);
    }

    /** @param callable|array $handler */
    public function post(string $path, $handler, array $middleware = []): self
    {
        return $this->add('POST', $path, $handler, $middleware);
    }

    /** @param callable|array $handler */
    private function add(string $method, string $path, $handler, array $middleware): self
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware,
        ];
        return $this;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        $basePath = dirname($_SERVER['SCRIPT_NAME'] ?? '');
        if ($basePath !== '/' && $basePath !== '' && substr($uri, 0, strlen($basePath)) === $basePath) {
            $uri = substr($uri, strlen($basePath)) ?: '/';
        }
        $uri = '/' . trim($uri, '/');

        foreach ($this->routes as $route) {
            $pattern = $this->pathToRegex($route['path']);
            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $params = $matches;

                foreach ($route['middleware'] as $m) {
                    $middleware = is_string($m) ? [new $m(), 'handle'] : $m;
                    if (is_callable($middleware)) {
                        $result = $middleware(new Request(), function () { return true; });
                        if ($result === false) {
                            return;
                        }
                    }
                }

                $handler = $route['handler'];
                $request = new Request();
                if (is_array($handler)) {
                    $controller = new $handler[0]();
                    $method = new \ReflectionMethod($controller, $handler[1]);
                    $args = [];
                    foreach ($method->getParameters() as $param) {
                        $type = $param->getType();
                        if ($type && $type->getName() === \App\Core\Request::class) {
                            $args[] = $request;
                        } elseif (count($params) > 0) {
                            $args[] = array_shift($params);
                        }
                    }
                    $method->invokeArgs($controller, $args);
                } else {
                    call_user_func_array($handler, array_merge([$request], $params));
                }
                return;
            }
        }

        http_response_code(404);
        echo '404 Not Found';
    }

    private function pathToRegex(string $path): string
    {
        $path = preg_replace('/\{([a-zA-Z_]+)\}/', '([^/]+)', $path);
        return '#^' . $path . '$#';
    }
}
