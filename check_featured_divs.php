<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match('/\<div class="product-area most-popular section"\>(.*?)\<section class="shop-home-list section"\>/s', $c, $m);
if(isset($m[1])) {
    $open = substr_count($m[1], '<div');
    $close = substr_count($m[1], '</div');
    echo "Featured Arrivals -> Open: $open, Close: $close\n";
} else {
    echo "Not found\n";
}
