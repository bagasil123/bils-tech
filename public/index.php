<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
// --- FINFO POLYFILL BYPASS FOR CHEAP HOSTING ---
if (!class_exists('finfo')) {
    if (!defined('FILEINFO_MIME_TYPE')) {
        define('FILEINFO_MIME_TYPE', 16);
    }
    class finfo {
        public function __construct() {}
        public function file($filename = null, $options = 0, $context = null) { return false; }
        public function buffer($string = null, $options = 0, $context = null) { return false; }
    }
}
// ---------------------------------------------

require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
