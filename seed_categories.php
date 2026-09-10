<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$nimco_categories = [
    'Mix Nimco',
    'Biscuits',
    'Pastries',
    'Sweets',
    'Daal Nimco',
    'Chips & Snacks',
    'Dry Fruits'
];

$existing = DB::table('categories')->where('is_parent', 1)->orderBy('id')->get();

foreach ($nimco_categories as $index => $catName) {
    if (isset($existing[$index])) {
        DB::table('categories')->where('id', $existing[$index]->id)->update([
            'title' => $catName,
            'slug' => Str::slug($catName)
        ]);
    } else {
        DB::table('categories')->insert([
            'title' => $catName,
            'slug' => Str::slug($catName),
            'summary' => 'Delicious ' . $catName . ' freshly prepared.',
            'photo' => '',
            'is_parent' => 1,
            'parent_id' => null,
            'added_by' => 1,
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

// Set status to inactive for any extra old categories
if (count($existing) > count($nimco_categories)) {
    for ($i = count($nimco_categories); $i < count($existing); $i++) {
        DB::table('categories')->where('id', $existing[$i]->id)->update(['status' => 'inactive']);
    }
}

echo "Nimco categories updated successfully!\n";
