<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$custom_css = '
<!-- START KABABJEES STYLE PRODUCT CARD OVERRIDE -->
<style>
    /* Reset and Override Previous Styles */
    .single-product {
        display: flex !important;
        flex-direction: column !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        margin-bottom: 30px !important;
        box-shadow: none !important;
        position: relative !important;
        text-align: left !important;
    }
    
    /* Image Area (Light Grey Background) */
    .single-product .product-img {
        background: #f5f5f5 !important; /* Light grey as requested */
        border-radius: 25px !important;
        overflow: hidden !important;
        padding: 20px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        position: relative !important;
        height: 280px !important;
        border: none !important;
        transition: transform 0.3s ease !important;
    }
    
    .single-product:hover .product-img {
        transform: translateY(-5px) !important;
    }

    .single-product .product-img a {
        display: block !important;
        width: 100% !important;
        height: 100% !important;
        position: relative !important;
    }

    .single-product .product-img img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important;
        transition: transform 0.4s ease !important;
    }
    
    .single-product:hover .product-img img {
        transform: scale(1.08) !important;
    }

    /* Hide the old hover action buttons */
    .single-product .button-head {
        display: none !important;
    }

    /* Content Area */
    .single-product .product-content {
        padding: 15px 5px 5px !important;
        background: transparent !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        position: relative !important;
        margin-top: 5px !important;
    }

    /* Title */
    .single-product .product-content h3 {
        margin: 0 0 5px 0 !important;
    }
    .single-product .product-content h3 a {
        font-family: \'Orbitron\', sans-serif !important; /* Bold condensed look */
        font-size: 17px !important;
        font-weight: 900 !important;
        color: #111 !important;
        text-transform: uppercase !important;
        text-decoration: none !important;
        letter-spacing: 0.5px !important;
    }

    /* Price */
    .single-product .product-price {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .single-product .product-price span {
        font-size: 15px !important;
        font-weight: 800 !important;
        color: #777 !important;
        text-transform: uppercase !important;
    }
    
    .single-product .product-price del {
        font-size: 13px !important;
        color: #aaa !important;
    }

    /* Red Add Button */
    .single-product .product-add-btn {
        position: absolute !important;
        bottom: 5px !important;
        right: 5px !important;
        width: 40px !important;
        height: 40px !important;
        background: #e62020 !important;
        color: #fff !important;
        border-radius: 12px !important; /* Squircle button */
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        font-size: 20px !important;
        font-weight: bold !important;
        text-decoration: none !important;
        box-shadow: 0 4px 10px rgba(230,32,32,0.3) !important;
        transition: all 0.3s ease !important;
    }
    
    .single-product .product-add-btn:hover {
        background: #cc1818 !important;
        transform: scale(1.1) !important;
        color: #fff !important;
    }
    
    @media (max-width: 768px) {
        .single-product .product-img { height: 220px !important; border-radius: 20px !important; }
        .single-product .product-content h3 a { font-size: 15px !important; }
        .single-product .product-price span { font-size: 14px !important; }
        .single-product .product-add-btn { width: 35px !important; height: 35px !important; font-size: 18px !important; border-radius: 10px !important; }
    }
</style>
<script>
    $(document).ready(function() {
        $(".single-product").each(function() {
            if ($(this).find(".product-add-btn").length === 0) {
                var cartLink = $(this).find(\'.product-action a[title="Add to cart"]\').attr("href") || "#";
                $(this).find(".product-content").append(\'<a href="\' + cartLink + \'" class="product-add-btn"><i class="ti-plus"></i></a>\');
            }
        });
    });
</script>
<!-- END KABABJEES STYLE PRODUCT CARD OVERRIDE -->
';

if (strpos($content, 'KABABJEES STYLE PRODUCT CARD OVERRIDE') === false) {
    // Inject at the end, right before @endsection if it exists, otherwise just append
    if (strpos($content, '@endsection') !== false) {
        $content = str_replace('@endsection', $custom_css . "\n@endsection", $content);
    } else {
        $content .= "\n" . $custom_css;
    }
    file_put_contents($file, $content);
    echo "CSS override added successfully.\n";
} else {
    // If it exists, replace it
    $content = preg_replace('/<!-- START KABABJEES STYLE PRODUCT CARD OVERRIDE -->.*?<!-- END KABABJEES STYLE PRODUCT CARD OVERRIDE -->/s', $custom_css, $content);
    file_put_contents($file, $content);
    echo "CSS override updated successfully.\n";
}
