<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Remove Bestseller badge HTML
$c = preg_replace('/@if\(\$product->condition==\'hot\'\)\s*<span class="badge-bestseller">.*?<\/span>\s*@endif/s', '', $c);

// 2. Change "{{$product->discount}}% OFF" to "{{$product->discount}}%"
$c = str_replace('<span class="badge-discount">{{$product->discount}}% OFF</span>', '<span class="badge-discount">{{$product->discount}}%</span>', $c);

// 3. Update CSS for badges and wishlist
$cssOverride = '
    /* Ribbon & Wishlist Overrides */
    .card-badges {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        gap: 0 !important;
        margin: 0 !important;
    }
    .badge-discount {
        background: #111 !important;
        color: #fff !important;
        border-radius: 12px 0 12px 0 !important;
        padding: 6px 15px !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        box-shadow: 2px 2px 10px rgba(0,0,0,0.2) !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }
    .btn-wishlist-modern {
        background: #fff0f0 !important;
        border: none !important;
        color: #ff4757 !important;
        box-shadow: 0 4px 12px rgba(255, 71, 87, 0.15) !important;
        border-radius: 50% !important;
    }
    .btn-wishlist-modern:hover {
        background: #ff4757 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 15px rgba(255, 71, 87, 0.3) !important;
    }
';

$c = str_replace('</style>', $cssOverride . "\n</style>", $c);

file_put_contents($f, $c);
echo "Badges and wishlist updated!";
?>
