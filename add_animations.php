<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Add AOS CSS to Head
$head_path = $base_dir . 'resources/views/frontend/layouts/head.blade.php';
$head = file_get_contents($head_path);
if(strpos($head, 'aos.css') === false) {
    $head = str_replace('<!-- Animate CSS -->', '<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">' . "\n" . '<!-- Animate CSS -->', $head);
    file_put_contents($head_path, $head);
}

// 2. Add AOS JS to Footer
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);
if(strpos($footer, 'aos.js') === false) {
    $aos_script = <<<JS
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  if(typeof AOS !== 'undefined') {
      AOS.init({
          duration: 800,
          once: true,
          offset: 100
      });
  }
</script>
JS;
    $footer = str_replace('@stack(\'scripts\')', $aos_script . "\n@stack('scripts')", $footer);
    file_put_contents($footer_path, $footer);
}

// 3. Add data-aos attributes to Index
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// Add to Small Banners
$index = str_replace('<section class="small-banner section">', '<section class="small-banner section" data-aos="fade-up">', $index);
// Add to Product Area
$index = str_replace('<div class="product-area section">', '<div class="product-area section" data-aos="fade-up">', $index);
// Add to Midium Banners
$index = str_replace('<section class="midium-banner">', '<section class="midium-banner" data-aos="fade-up" data-aos-delay="200">', $index);
// Add to Most Popular
$index = str_replace('<div class="product-area most-popular section">', '<div class="product-area most-popular section" data-aos="fade-in">', $index);
// Add to Shop Home List
$index = str_replace('<section class="shop-home-list section">', '<section class="shop-home-list section" data-aos="fade-up">', $index);
// Add to Shop Blog
$index = str_replace('<section class="shop-blog section">', '<section class="shop-blog section" data-aos="fade-up">', $index);
// Add to Shop Services
$index = str_replace('<section class="shop-services section home">', '<section class="shop-services section home" data-aos="zoom-in">', $index);
// Add to Newsletter
$index = str_replace('<section class="shop-newsletter section">', '<section class="shop-newsletter section" data-aos="fade-up">', $index);

file_put_contents($index_path, $index);

echo "AOS Animations added successfully.\n";
