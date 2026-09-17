<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Fix Banners
$banners = DB::table('banners')->get();
foreach ($banners as $b) {
    $newPhoto = str_replace(['http://localhost/storage/app/public/', 'http://127.0.0.1:8000/storage/app/public/'], 'http://127.0.0.1:8000/storage/', $b->photo);
    DB::table('banners')->where('id', $b->id)->update(['photo' => $newPhoto]);
}

// Fix Products
$products = DB::table('products')->get();
foreach ($products as $p) {
    $newPhoto = str_replace(['http://localhost/storage/app/public/', 'http://127.0.0.1:8000/storage/app/public/'], 'http://127.0.0.1:8000/storage/', $p->photo);
    DB::table('products')->where('id', $p->id)->update(['photo' => $newPhoto]);
}

// Fix Categories
$categories = DB::table('categories')->get();
foreach ($categories as $c) {
    $newPhoto = str_replace(['http://localhost/storage/app/public/', 'http://127.0.0.1:8000/storage/app/public/'], 'http://127.0.0.1:8000/storage/', $c->photo);
    DB::table('categories')->where('id', $c->id)->update(['photo' => $newPhoto]);
}

echo "Database URLs fixed.\n";
