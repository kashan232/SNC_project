<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Find the first banner or all active banners and update them
$banners = DB::table('banners')->get();

foreach ($banners as $banner) {
    DB::table('banners')->where('id', $banner->id)->update([
        'title' => 'Welcome to Shoukat Nimco Center',
        'description' => 'Experience the rich taste of tradition with our freshly made nimco, bakery items, and sweet delights. Order now and enjoy crispiness in every bite!',
        'photo' => '/banner_nimco.jpg'
    ]);
}
echo "Banners updated in DB.\n";
