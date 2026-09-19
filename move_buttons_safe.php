<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, '<!-- Start Product Area -->');
$end = strpos($c, '<!-- End Product Area -->');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    // Pattern to match the structure inside Our Products
    // $1 = from <div class="single-product" up to </a> (inclusive)
    // $2 = <div class="button-head">...</div> (the buttons)
    // $3 = </div> (closes product-img)
    // $4 = <div class="product-content">...</div> (the content)
    //
    // Then we replace with: $1 . $3 . $4 . $2
    
    $pattern = '/(\<div class="single-product"[^\>]*\>.*?\<div class="product-img"\>.*?\<\/a\>\s*)(\<div class="button-head"\>.*?\<\/div\>\s*\<\/div\>\s*)(\<\/div\>\s*)(\<div class="product-content"\>.*?\<\/div\>\s*\<\/div\>\s*)/is';
    
    $block = preg_replace_callback($pattern, function($matches) {
        return $matches[1] . $matches[3] . $matches[4] . $matches[2];
    }, $block);
    
    $c = $before . $block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Moved buttons below price.";
} else {
    echo "Could not find Product Area.";
}
