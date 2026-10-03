<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;

$images = [
    '/storage/photos/nimco_1.jpg',
    '/storage/photos/nimco_2.jpg',
    '/storage/photos/nimco_3.jpg',
    '/storage/photos/nimco_4.jpg'
];

$categories = Category::all();
$i = 0;
foreach($categories as $category) {
    $category->photo = $images[$i % count($images)];
    $category->save();
    $i++;
}
echo "Updated " . count($categories) . " categories.\n";

$products = Product::all();
$j = 0;
foreach($products as $product) {
    $product->photo = $images[$j % count($images)];
    $product->save();
    $j++;
}
echo "Updated " . count($products) . " products.\n";

?>
