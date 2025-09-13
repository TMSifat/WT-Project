<?php
// Start session globally for controllers
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple autoloader
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/controllers/$class.php",
        __DIR__ . "/models/$class.php",
        __DIR__ . "/../core/$class.php",
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Common helper
function view(string $path, array $data = [])
{
    extract($data);
    require __DIR__ . '/views/' . $path . '.php';
}

// Compute web base path to the project (e.g., /WTproject/)
// Never return a filesystem path; only a URL path starting with '/'
function base_path(): string
{
    // Prefer SCRIPT_NAME which contains the executed script path (e.g., /WTproject/login.php)
    $script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\', '/', $_SERVER['SCRIPT_NAME']) : '';
    if ($script !== '') {
        $dir = rtrim(str_replace('\\', '/', dirname($script)), '/');
        return ($dir === '' ? '/' : $dir . '/');
    }

    // Fallback to REQUEST_URI without query string
    if (!empty($_SERVER['REQUEST_URI'])) {
        $uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
        $dir = rtrim(str_replace('\\', '/', dirname($uri)), '/');
        return ($dir === '' ? '/' : $dir . '/');
    }

    // Last resort
    return '/';
}

function url(string $path): string
{
    $path = ltrim($path, '/');
    $base = base_path();
    // Ensure we don't accidentally build filesystem-looking paths
    if ($base === '' || $base[0] !== '/') {
        $base = '/';
    }
    return rtrim($base, '/') . '/' . $path;
}

function redirect(string $location)
{
    // Build absolute URL to be robust across browsers and proxies
    if (!preg_match('#^https?://#i', $location)) {
        $scheme = (!empty($_SERVER['HTTPS']) && strtolower((string)$_SERVER['HTTPS']) !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $location = $scheme . '://' . $host . url($location);
    }
    header('Location: ' . $location);
    exit();
}

// Asset helper: prefer files under public/ if present
function asset(string $path): string
{
    $rel = ltrim($path, '/');
    $publicRel = 'public/' . $rel;
    $fs = __DIR__ . '/../' . $publicRel;
    if (file_exists($fs)) {
        return url($publicRel);
    }
    return url($rel);
}

// Normalize upload path stored as either 'uploads/...' or 'public/uploads/...'
function upload_url(string $stored): string
{
    $p = ltrim($stored, '/');
    if (strpos($p, 'public/uploads/') === 0) {
        // drop leading 'public/' so asset() can decide
        $p = substr($p, 7);
    }
    if (strpos($p, 'uploads/') !== 0) {
        $p = 'uploads/' . $p;
    }
    return asset($p);
}

// Send no-cache headers (prevents back button showing protected pages after logout)
function no_cache(): void
{
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    header('Expires: 0');
}
