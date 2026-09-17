<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 3. Add data-aos attributes to inner elements in Index
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// Add to Section Titles
$index = str_replace('<div class="section-title">', '<div class="section-title" data-aos="fade-up">', $index);

// Add to Single Products (with a delay based on loop index if possible, but fade-up is fine)
$index = str_replace('<div class="single-product">', '<div class="single-product" data-aos="fade-up" data-aos-offset="50">', $index);

// Add to Banners
$index = str_replace('<div class="single-banner">', '<div class="single-banner" data-aos="zoom-in" data-aos-offset="50">', $index);

// Add to Blog Posts
$index = str_replace('<div class="shop-single-blog">', '<div class="shop-single-blog" data-aos="fade-up" data-aos-offset="100">', $index);

// Add to Services
$index = str_replace('<div class="single-service">', '<div class="single-service" data-aos="fade-up" data-aos-offset="50">', $index);

file_put_contents($index_path, $index);

echo "AOS Animations added to inner elements successfully.\n";
