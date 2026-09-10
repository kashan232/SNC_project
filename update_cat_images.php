<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$updates = [
    'Mix Nimco' => '/images/products/mix_nimco.jpg',
    'Biscuits' => '/images/products/chewra.jpg',
    'Pastries' => '/images/products/daal_sev.jpg',
    'Sweets' => '/images/products/chana_daal.jpg',
    'Daal Nimco' => '/images/products/chana_daal.jpg',
    'Chips & Snacks' => '/images/products/potato_sticks.jpg',
    'Dry Fruits' => '/images/products/daal_sev.jpg',
];

foreach ($updates as $title => $photo) {
    DB::table('categories')->where('title', $title)->update(['photo' => $photo]);
}

echo "Categories updated with new images!\n";
