<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// 1. Replace Featured Products heading
// Old HTML typically looks like:
// <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #222; margin-top: 10px;">Featured <span style="color: var(--primary-color);">Products</span></h2>
$new_featured = '<h2 style="font-family: \'Orbitron\', sans-serif;font-size: 32px;font-weight: 800;color: #fff!important;margin-top: 10px;">Featured <span style="/* color: var(--primary-color); */">Products</span></h2>';

$c = preg_replace('/\<h2 style="[^"]*?"\>Featured \<span style="[^"]*?"\>Products\<\/span\>\<\/h2\>/is', $new_featured, $c);

// 2. Replace Our Products heading
// Wait, Our Products currently has:
// <h2 style="font-family: 'Orbitron', sans-serif; font-size: 36px; font-weight: 800; color: #111;">Our <span style="color: var(--primary-color);">Products</span></h2>
$new_our_products = '<h2 style="font-family: \'Orbitron\', sans-serif;font-size: 32px;font-weight: 800;color: #fff!important;margin-top: 10px;">Our <span style="/* color: var(--primary-color); */">Products</span></h2>';

$c = preg_replace('/\<h2 style="[^"]*?"\>Our \<span style="[^"]*?"\>Products\<\/span\>\<\/h2\>/is', $new_our_products, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Headings applied.";
