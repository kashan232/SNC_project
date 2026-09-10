<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$custom_css = '
<!-- START CLEAN CARD CSS OVERRIDE -->
<style>
    /* Reset Clean Card */
    .clean-card {
        background: #fff !important;
        border: 1px solid #f0f0f0 !important;
        border-radius: 16px !important;
        margin: 15px !important;
        padding: 15px !important;
        text-align: left !important;
        position: relative !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        transition: box-shadow 0.3s ease, transform 0.3s ease !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .clean-card:hover {
        box-shadow: 0 8px 25px rgba(230,32,32,0.1) !important;
        transform: translateY(-5px) !important;
    }

    /* Product Image Box */
    .clean-card .product-img {
        background: #f4f4f4 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        padding: 0 !important;
        height: 220px !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .clean-card .product-img a {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Blend mode to remove white backgrounds */
    .clean-card .product-img img.default-img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.4s ease !important;
    }
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.08) !important;
    }

    /* Wishlist Button */
    a.clean-wishlist {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        width: 35px !important;
        height: 35px !important;
        background: #fff !important;
        color: #888 !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        transition: all 0.2s ease !important;
        z-index: 5 !important;
    }
    a.clean-wishlist:hover {
        background: #e62020 !important;
        color: #fff !important;
        transform: scale(1.1) !important;
    }

    /* Product Content Area */
    .clean-card .product-content {
        padding: 20px 5px 5px !important;
        background: transparent !important;
        text-align: left !important;
        position: relative !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    /* Title */
    .clean-card .product-content h3 {
        margin: 0 0 8px 0 !important;
    }
    .clean-card .product-content h3 a {
        font-family: \'Orbitron\', sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        color: #111 !important;
        text-transform: uppercase !important;
        line-height: 1.3 !important;
        display: block !important;
    }

    /* Price Container */
    .clean-card .price-container {
        display: flex !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 8px !important;
        margin-top: auto !important; /* Push to bottom if title is short */
    }
    .clean-card .current-price {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #e62020 !important;
    }
    .clean-card del {
        font-size: 13px !important;
        color: #999 !important;
        text-decoration: line-through !important;
    }

    /* Add to Cart Button (Bottom Right) */
    a.clean-add-cart {
        position: absolute !important;
        bottom: 5px !important;
        right: 5px !important;
        width: 40px !important;
        height: 40px !important;
        background: #e62020 !important;
        color: #fff !important;
        border-radius: 12px !important; /* Squircle */
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 18px !important;
        box-shadow: 0 4px 10px rgba(230,32,32,0.3) !important;
        transition: all 0.2s ease !important;
        z-index: 5 !important;
        text-decoration: none !important;
    }
    a.clean-add-cart:hover {
        background: #cc1818 !important;
        transform: scale(1.1) !important;
        color: #fff !important;
    }

    /* Fix Carousel Arrows overlapping */
    .popular-slider .owl-nav div {
        background: #fff !important;
        color: #e62020 !important;
        border: 1px solid #e62020 !important;
        border-radius: 50% !important;
        width: 35px !important;
        height: 35px !important;
        line-height: 33px !important;
        text-align: center !important;
        font-size: 16px !important;
        position: absolute !important;
        top: 35% !important;
        transform: translateY(-50%) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .popular-slider .owl-prev { left: -10px !important; }
    .popular-slider .owl-next { right: -10px !important; }

</style>
<!-- END CLEAN CARD CSS OVERRIDE -->
';

// Remove old overrides
$content = preg_replace('/<!-- START PRO PRODUCT CARD OVERRIDE -->.*?<!-- END PRO PRODUCT CARD OVERRIDE -->/s', '', $content);
$content = preg_replace('/<!-- START KABABJEES STYLE PRODUCT CARD OVERRIDE -->.*?<!-- END KABABJEES STYLE PRODUCT CARD OVERRIDE -->/s', '', $content);

// Insert new CSS
if (strpos($content, 'START CLEAN CARD CSS OVERRIDE') !== false) {
    $content = preg_replace('/<!-- START CLEAN CARD CSS OVERRIDE -->.*?<!-- END CLEAN CARD CSS OVERRIDE -->/s', $custom_css, $content);
} else {
    if (strpos($content, '@endsection') !== false) {
        $content = str_replace('@endsection', $custom_css . "\n@endsection", $content);
    } else {
        $content .= "\n" . $custom_css;
    }
}

file_put_contents($file, $content);
echo "Clean CSS override applied.\n";
