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
function base_path(): string
{
    $doc = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\','/', rtrim($_SERVER['DOCUMENT_ROOT'], '/')) : '';
    $root = str_replace('\\','/', dirname(__DIR__)); // filesystem path to project root
    if ($doc && strpos($root, $doc) === 0) {
        $rel = substr($root, strlen($doc));
        $rel = $rel === false ? '' : $rel;
        return ($rel === '' ? '/' : $rel . '/') ;
    }
    // Fallback: assume project is at web root
    return '/';
}

function url(string $path): string
{
    $path = ltrim($path, '/');
    return base_path() . $path;
}

function redirect(string $location)
{
    // If not absolute, prefix with base path
    if (!preg_match('#^https?://#i', $location)) {
        $location = url($location);
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
