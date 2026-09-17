<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$banners = DB::table('banners')->get();
foreach ($banners as $b) {
    echo "ID: {$b->id}, Photo: {$b->photo}\n";
}
