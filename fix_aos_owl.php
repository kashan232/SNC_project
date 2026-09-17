<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);

// We need to fix the JS script so it doesn't animate items inside owl-carousel which breaks them
$old_js = "const elementsToAnimate = document.querySelectorAll('.single-product, .section-title, .single-banner, .shop-single-blog, .single-service, .product-content, .contact-us .form-main, .contact-us .single-info, .about-us .about-content, .about-us .about-img, .shopping-cart, .checkout .checkout-form, .checkout .order-details, .product-des .short, .product-des .color, .product-des .size, .reviews .single-rating');";

$new_js = "const elementsToAnimate = document.querySelectorAll('.section-title, .single-banner, .shop-single-blog, .single-service, .contact-us .form-main, .contact-us .single-info, .about-us .about-content, .about-us .about-img, .shopping-cart, .checkout .checkout-form, .checkout .order-details, .product-des .short, .product-des .color, .product-des .size, .reviews .single-rating, .single-product:not(.owl-carousel .single-product), .owl-carousel');";

if (strpos($footer, 'const elementsToAnimate') !== false) {
    $footer = str_replace($old_js, $new_js, $footer);
    file_put_contents($footer_path, $footer);
    echo "Fixed JS to exclude owl carousel inner items from AOS.\n";
} else {
    echo "Could not find JS block.\n";
}
