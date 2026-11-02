<?php
require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

$base = 'https://suprapto-portfolio-web.vercel.app';
$out  = __DIR__ . '/static-site';

$paths = ['/', '/about', '/skills', '/projects', '/contact'];
foreach (config('portfolio.projects') as $p) {
    $paths[] = '/project/' . $p['slug'];
}

foreach ($paths as $path) {
    $response = $kernel->handle(Illuminate\Http\Request::create($base . $path, 'GET'));

    if ($response->getStatusCode() !== 200) {
        echo "GAGAL {$response->getStatusCode()} $path\n";
        continue;
    }

    $file = $out . ($path === '/' ? '/index' : $path) . '.html';
    @mkdir(dirname($file), 0777, true);
    file_put_contents($file, $response->getContent());
    echo "OK $path\n";
}