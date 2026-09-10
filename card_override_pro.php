<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$custom_css = '
<!-- START PRO PRODUCT CARD OVERRIDE -->
<style>
    /* Reset Product Card */
    div.single-product {
        background: #fff !important;
        border: 1px solid #f0f0f0 !important;
        border-radius: 16px !important;
        margin: 15px !important;
        padding: 15px !important;
        text-align: left !important;
        position: relative !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        transition: box-shadow 0.3s ease !important;
    }
    
    div.single-product:hover {
        box-shadow: 0 8px 25px rgba(230,32,32,0.1) !important;
    }

    /* Product Image Box */
    div.single-product .product-img {
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

    div.single-product .product-img a:first-child {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Blend mode to remove white backgrounds */
    div.single-product .product-img img.default-img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.4s ease !important;
    }
    div.single-product:hover .product-img img.default-img {
        transform: scale(1.08) !important;
    }
    
    /* Hide the secondary hover image to avoid flickering */
    div.single-product .hover-img {
        display: none !important;
    }

    /* Action Buttons Area (Cart, Wishlist, Quick View) */
    div.single-product .button-head {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        pointer-events: none !important; /* Let clicks pass through to image */
        z-index: 10 !important;
        background: transparent !important;
        display: block !important;
    }
    
    div.single-product .product-action {
        width: 100% !important;
        height: 100% !important;
        position: relative !important;
        display: block !important;
    }

    /* Reset anchor tags inside product action */
    div.single-product .product-action a {
        position: absolute !important;
        pointer-events: auto !important; /* Enable clicks on buttons */
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
    }

    /* Hide the text labels (span) */
    div.single-product .product-action a span {
        display: none !important;
    }

    /* 1. WISH LIST BUTTON (Top Right) */
    div.single-product .product-action a[title="Wishlist"] {
        top: 10px !important;
        right: 10px !important;
        width: 35px !important;
        height: 35px !important;
        background: #fff !important;
        color: #888 !important;
        font-size: 16px !important;
    }
    div.single-product .product-action a[title="Wishlist"]:hover {
        background: #e62020 !important;
        color: #fff !important;
    }

    /* 2. ADD TO CART BUTTON (Bottom Right, large red button) */
    div.single-product .product-action a[title="Add to cart"] {
        bottom: -20px !important; /* Hangs slightly over the bottom of the image */
        right: 15px !important;
        width: 45px !important;
        height: 45px !important;
        background: #e62020 !important;
        color: #fff !important;
        font-size: 20px !important;
        box-shadow: 0 5px 15px rgba(230,32,32,0.3) !important;
    }
    div.single-product .product-action a[title="Add to cart"]:hover {
        background: #cc1818 !important;
        transform: scale(1.1) !important;
    }

    /* 3. QUICK SHOP BUTTON (Hidden or placed at Top Left) */
    div.single-product .product-action a[title="Quick View"] {
        top: 10px !important;
        left: 10px !important;
        width: 35px !important;
        height: 35px !important;
        background: #fff !important;
        color: #888 !important;
        font-size: 16px !important;
    }
    div.single-product .product-action a[title="Quick View"]:hover {
        background: #e62020 !important;
        color: #fff !important;
    }

    /* Product Content Area */
    div.single-product .product-content {
        padding: 25px 5px 5px !important;
        background: transparent !important;
        text-align: left !important;
    }

    /* Title */
    div.single-product .product-content h3 {
        margin: 0 0 8px 0 !important;
    }
    div.single-product .product-content h3 a {
        font-family: \'Orbitron\', sans-serif !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #111 !important;
        text-transform: uppercase !important;
        line-height: 1.3 !important;
        display: block !important;
    }

    /* Price */
    div.single-product .product-price {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        margin: 0 !important;
    }
    div.single-product .product-price span {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: #e62020 !important; /* Red price stands out */
    }
    div.single-product .product-price del {
        font-size: 13px !important;
        color: #999 !important;
        text-decoration: line-through !important;
    }

    /* Fix Carousel Arrows overlapping */
    .owl-carousel .owl-nav div {
        background: #fff !important;
        color: #e62020 !important;
        border: 1px solid #e62020 !important;
        border-radius: 50% !important;
        width: 40px !important;
        height: 40px !important;
        line-height: 38px !important;
        text-align: center !important;
        font-size: 18px !important;
        position: absolute !important;
        top: 40% !important;
        transform: translateY(-50%) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }
    .popular-slider .owl-prev { left: -20px !important; }
    .popular-slider .owl-next { right: -20px !important; }

    @media (max-width: 768px) {
        .popular-slider .owl-nav { display: none !important; } /* Hide arrows on mobile */
        div.single-product .product-img { height: 180px !important; }
        div.single-product .product-content h3 a { font-size: 14px !important; }
        div.single-product .product-price span { font-size: 14px !important; }
    }
</style>
<!-- END PRO PRODUCT CARD OVERRIDE -->
';

// Replace old override if exists
if (strpos($content, 'START PRO PRODUCT CARD OVERRIDE') !== false) {
    $content = preg_replace('/<!-- START PRO PRODUCT CARD OVERRIDE -->.*?<!-- END PRO PRODUCT CARD OVERRIDE -->/s', $custom_css, $content);
    file_put_contents($file, $content);
    echo "Pro CSS override updated successfully.\n";
} else {
    if (strpos($content, '@endsection') !== false) {
        $content = str_replace('@endsection', $custom_css . "\n@endsection", $content);
    } else {
        $content .= "\n" . $custom_css;
    }
    file_put_contents($file, $content);
    echo "Pro CSS override added successfully.\n";
}
