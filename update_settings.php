<?php
// Script to update settings in Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

DB::table('settings')->update([
    'description' => 'Shoukat Nimco Center offers the best quality Nimco, bakery items, and biscuits.',
    'short_des' => 'Shoukat Nimco Center offers the best quality Nimco and bakery items.',
    'logo' => 'logo.png', // Assuming it's going to be replaced
    'photo' => 'logo.png',
    'address' => 'urdu bazar, Hyderabad, Pakistan',
    'phone' => '(022) 3641641',
    'email' => 'Hafizansari@yahoo.com'
]);

echo "Settings updated successfully.\n";
