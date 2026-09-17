<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);

$footer = preg_replace(
    '/(const elementsToAnimate = document\.querySelectorAll\(\')(.*?)(\'\);)/', 
    '$1.section-title, .single-banner, .shop-single-blog, .single-service, .contact-us .form-main, .contact-us .single-info, .about-us .about-content, .about-us .about-img, .shopping-cart, .checkout .checkout-form, .checkout .order-details, .product-des .short, .product-des .color, .product-des .size, .reviews .single-rating, .single-product:not(.owl-carousel .single-product), .owl-carousel$3', 
    $footer
);

file_put_contents($footer_path, $footer);
echo "Fixed JS.\n";
