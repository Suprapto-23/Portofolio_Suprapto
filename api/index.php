<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

register_shutdown_function(function () {
    $e = error_get_last();
    if ($e) {
        error_log('FATAL: ' . json_encode($e));
        echo '<pre>FATAL: ' . htmlspecialchars(print_r($e, true)) . '</pre>';
    }
});

foreach (['views', 'cache', 'sessions'] as $d) {
    @mkdir("/tmp/storage/framework/$d", 0777, true);
}

if (isset($_GET['step'])) {
    echo 'PHP ' . PHP_VERSION . '<br>';
    require __DIR__ . '/../vendor/autoload.php';
    echo 'autoload OK<br>';
    if ($_GET['step'] >= 2) {
        $app = require __DIR__ . '/../bootstrap/app.php';
        echo 'bootstrap OK<br>';
    }
    exit;
}

require __DIR__ . '/../public/index.php';