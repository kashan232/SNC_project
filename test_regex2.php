<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, '<!-- Start Product Area -->');
$end = strpos($c, '<!-- End Product Area -->');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    // We want to find:
    // <div class="button-head">
    //     <div class="product-action d-flex justify-content-center align-items-center w-100">
    //         ...
    //     </div>
    // </div>
    // </div>
    // <div class="product-content">
    //     ...
    // </div>
    // And swap them!
    
    // Let's use a simpler, more precise regex for just the swapping part
    $pattern = '/(\<div class="button-head"\>.*?\<\/div\>\s*\<\/div\>\s*)(\<\/div\>\s*)(\<div class="product-content"\>.*?\<\/div\>\s*\<\/div\>\s*)/is';
    
    // But wait, the `</div>` after product-content might not be exactly two if there are other tags!
    // Instead, let's just look for the button-head block, remove it, and insert it after product-content.
    
    // Or simpler:
    // $1 = <div class="button-head"> ... </div></div>
    // $2 = </div>
    // $3 = <div class="product-content">
    
    $block = preg_replace_callback('/(\<div class="button-head"\>.*?\<\/div\>\s*\<\/div\>\s*)(\<\/div\>\s*)(\<div class="product-content"\>)/is', function($matches) {
        $button_head = $matches[1];
        $closing_img = $matches[2];
        $product_content_open = $matches[3];
        
        // We want: closing_img, product_content_open, (skip over product-content), then insert button_head.
        // Wait, regex doesn't know where product-content ends if we don't match it.
        return $matches[0]; // just return as is for now
    }, $block);
    
    echo "This is hard with regex.";
}
