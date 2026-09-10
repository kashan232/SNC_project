<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Clear old banners
DB::table('banners')->truncate();

// Insert the new banner
DB::table('banners')->insert([
    'title' => 'Welcome to Shoukat Nimco Center',
    'slug' => 'welcome-to-shoukat-nimco-center',
    'photo' => '/images/banners/main_banner.jpg',
    'description' => 'Experience the finest and most delicious Nimco and Sweets in town.',
    'status' => 'active',
    'created_at' => now(),
    'updated_at' => now()
]);

echo "Banners updated successfully!\n";
