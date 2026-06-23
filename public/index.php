<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (! extension_loaded('openssl')) {
    http_response_code(503);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>PHP setup required</title></head><body style="font-family:sans-serif;max-width:520px;margin:3rem auto;padding:0 1rem;">';
    echo '<h1>OpenSSL extension not loaded</h1>';
    echo '<p>Do not use <code>php artisan serve</code> on this machine.</p>';
    echo '<p>Start the app with:</p>';
    echo '<pre style="background:#f5f5f5;padding:1rem;border-radius:8px;">.\\serve.cmd</pre>';
    echo '<p>or</p>';
    echo '<pre style="background:#f5f5f5;padding:1rem;border-radius:8px;">powershell -File serve.ps1</pre>';
    echo '</body></html>';
    exit;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
