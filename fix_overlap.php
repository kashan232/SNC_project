<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Add right padding to prevent text/price overlapping the absolute button
$old_padding = '    .clean-card .product-content {
        padding: 20px 5px 5px !important;';
        
$new_padding = '    .clean-card .product-content {
        padding: 20px 50px 10px 10px !important;';

$content = str_replace($old_padding, $new_padding, $content);

// Also increase gap to 5px so the strike-through price and main price don't look cramped
$content = str_replace('gap: 8px !important;', 'gap: 6px !important;', $content);

// Move the add to cart button slightly lower and more to the right so it looks perfectly planted
$old_add_cart = '    a.clean-add-cart {
        position: absolute !important;
        bottom: 5px !important;
        right: 5px !important;';
        
$new_add_cart = '    a.clean-add-cart {
        position: absolute !important;
        bottom: 10px !important;
        right: 10px !important;';
        
$content = str_replace($old_add_cart, $new_add_cart, $content);

file_put_contents($file, $content);
echo "Padding fixed to prevent overlap.\n";
