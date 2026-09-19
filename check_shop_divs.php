<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match('/\<section class="shop-home-list section"\>(.*?)\<div class="product-area section our-products-area"\>/s', $c, $m);
if(isset($m[1])) {
    $open = substr_count($m[1], '<div');
    $close = substr_count($m[1], '</div');
    echo "Shop Home List -> Open: $open, Close: $close\n";
} else {
    echo "Not found\n";
}
