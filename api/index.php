<?php

// Entry point Laravel untuk Vercel.
// Vercel hanya mengizinkan penulisan di /tmp, jadi storage dipindah ke sana.

require __DIR__ . '/../vendor/autoload.php';

$storage = '/tmp/storage';

foreach (['framework/views', 'framework/cache', 'framework/sessions', 'logs'] as $dir) {
    if (! is_dir("$storage/$dir")) {
        mkdir("$storage/$dir", 0775, true);
    }
}

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($storage);

$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request  = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);