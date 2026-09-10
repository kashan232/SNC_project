<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Fix the greedy CSS rule
$old_css_rule = '.clean-card .product-img a {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }';

$new_css_rule = '.clean-card .product-img a:not(.clean-wishlist) {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    a.clean-wishlist {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        width: 35px !important;
        height: 35px !important;
        background: #fff !important;
        color: #e62020 !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.2s ease !important;
        z-index: 5 !important;
    }';

// The replace might be tricky if formatting differs, let's just do a str_replace on the first line
$content = str_replace('.clean-card .product-img a {', '.clean-card .product-img a:not(.clean-wishlist) {', $content);

file_put_contents($file, $content);
echo "CSS specificity fixed.\n";
