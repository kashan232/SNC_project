<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Remove AOS attributes from Index
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

$index = str_replace('<section class="small-banner section" data-aos="fade-up">', '<section class="small-banner section">', $index);
$index = str_replace('<div class="product-area section" data-aos="fade-up">', '<div class="product-area section">', $index);
$index = str_replace('<section class="midium-banner" data-aos="fade-up" data-aos-delay="200">', '<section class="midium-banner">', $index);
$index = str_replace('<div class="product-area most-popular section" data-aos="fade-in">', '<div class="product-area most-popular section">', $index);
$index = str_replace('<section class="shop-home-list section" data-aos="fade-up">', '<section class="shop-home-list section">', $index);
$index = str_replace('<section class="shop-blog section" data-aos="fade-up">', '<section class="shop-blog section">', $index);
$index = str_replace('<section class="shop-services section home" data-aos="zoom-in">', '<section class="shop-services section home">', $index);
$index = str_replace('<section class="shop-newsletter section" data-aos="fade-up">', '<section class="shop-newsletter section">', $index);

file_put_contents($index_path, $index);

// 2. Add some custom hover animations instead
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

$hover_animations = <<<CSS
<style>
    /* Premium Hover Effects */
    .single-product {
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .single-product:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .single-product .product-img img {
        transition: transform 0.6s ease;
    }
    .single-product:hover .product-img img {
        transform: scale(1.08);
    }
    
    .single-banner {
        overflow: hidden;
        border-radius: 12px;
        transition: box-shadow 0.4s ease;
    }
    .single-banner img {
        transition: transform 0.6s ease;
    }
    .single-banner:hover img {
        transform: scale(1.05);
    }
    .single-banner:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .shop-services .single-service {
        transition: transform 0.3s ease;
    }
    .shop-services .single-service:hover {
        transform: translateY(-5px);
    }
    .shop-services .single-service:hover i {
        animation: bounce 1s infinite;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
</style>
CSS;

if (strpos($header, 'Premium Hover Effects') === false) {
    $header = str_replace('</head>', $hover_animations . "\n</head>", $header);
    file_put_contents($header_path, $header);
}

echo "AOS removed and hover effects added.\n";
