<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// Deactivate all old products
DB::table('products')->update(['status' => 'inactive', 'condition' => 'default']);

// Get the first active category to link to (like Mix Nimco)
$category = DB::table('categories')->where('status', 'active')->first();
$cat_id = $category ? $category->id : 1;

$new_products = [
    [
        'title' => 'Shoukat Special Mix Nimco',
        'photo' => '/images/products/mix_nimco.jpg',
        'price' => 450,
        'discount' => 10,
        'stock' => 100
    ],
    [
        'title' => 'Crunchy Chana Daal',
        'photo' => '/images/products/chana_daal.jpg',
        'price' => 300,
        'discount' => 0,
        'stock' => 150
    ],
    [
        'title' => 'Special Daal Sev Mix',
        'photo' => '/images/products/daal_sev.jpg',
        'price' => 350,
        'discount' => 5,
        'stock' => 120
    ],
    [
        'title' => 'Spicy Potato Sticks',
        'photo' => '/images/products/potato_sticks.jpg',
        'price' => 250,
        'discount' => 0,
        'stock' => 200
    ],
    [
        'title' => 'Crispy Chewra Mix',
        'photo' => '/images/products/chewra.jpg',
        'price' => 400,
        'discount' => 15,
        'stock' => 80
    ]
];

foreach ($new_products as $prod) {
    DB::table('products')->insert([
        'title' => $prod['title'],
        'slug' => Str::slug($prod['title']) . '-' . rand(1000, 9999),
        'summary' => 'Delicious and crunchy ' . $prod['title'] . ' made with premium ingredients.',
        'description' => '<p>Enjoy the best quality snacks from Shoukat Nimco Center. Perfect for teatime and guests.</p>',
        'photo' => $prod['photo'],
        'stock' => $prod['stock'],
        'size' => 'M',
        'condition' => 'hot', // 'hot' makes it show in featured
        'status' => 'active',
        'price' => $prod['price'],
        'discount' => $prod['discount'],
        'is_featured' => 1,
        'cat_id' => $cat_id,
        'child_cat_id' => null,
        'brand_id' => null,
        'created_at' => now(),
        'updated_at' => now()
    ]);
}

echo "Old products deactivated and 5 new Nimco products added!\n";
