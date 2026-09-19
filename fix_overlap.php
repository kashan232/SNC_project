<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// 1. Rename the custom block class from .product-area to .our-products-area
// We will do a strict replace only inside the custom CSS block I added.
// The block started with /* === OUR PRODUCTS DARK/GOLD DESIGN === */

$pattern = '/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is';
if (preg_match($pattern, $c, $matches)) {
    $css_block = $matches[1];
    
    // Replace .product-area with .our-products-area
    $css_block = str_replace('.product-area ', '.our-products-area ', $css_block);
    
    // Remove the Isotope flex rules that broke the layout
    $css_block = preg_replace('/\.isotope-item\s*\{.*?\}/is', '', $css_block);
    $css_block = preg_replace('/\.isotope-grid\s*\{.*?\}/is', '', $css_block);
    
    // Remove flex related properties from .our-products-area .single-product that might cause issues
    $css_block = str_replace('display: flex !important;', '', $css_block);
    $css_block = str_replace('flex-direction: column !important;', '', $css_block);
    $css_block = str_replace('height: 100% !important;', '', $css_block);
    
    // Put back flex for product-action and button-head since they need it
    $css_block = str_replace('.our-products-area .single-product .product-action {', ".our-products-area .single-product .product-action {\n    display: flex !important;", $css_block);
    $css_block = str_replace('.our-products-area .single-product .product-action a {', ".our-products-area .single-product .product-action a {\n    display: flex !important;", $css_block);
    
    // For product image, we also removed display:flex when we stripped it above, let's restore it
    $css_block = str_replace('.our-products-area .single-product .product-img {', ".our-products-area .single-product .product-img {\n    display: flex !important;", $css_block);
    
    $c = preg_replace($pattern, '/* === OUR PRODUCTS DARK/GOLD DESIGN === */' . $css_block . '</style>', $c);
}

// 2. Add the class our-products-area to the correct div
// The old title is right inside it, let's look for:
// <div class="product-area section">
//       <div class="container">
//   <div class="row">
//               <div class="col-12">
//                   <div class="section-title text-center" style="margin-bottom: 25px;">
//                       <span style="color: #a49175; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 13px; display:block; margin-bottom: 10px;">FEATURED PRODUCTS</span>

$c = preg_replace('/\<div class="product-area section"\>\s*\<div class="container"\>\s*\<div class="row"\>\s*\<div class="col-12"\>\s*\<div class="section-title text-center" style="margin-bottom: 25px;"\>\s*\<span style="color: #a49175/is', '<div class="product-area section our-products-area">
      <div class="container">
  <div class="row">
              <div class="col-12">
                  <div class="section-title text-center" style="margin-bottom: 25px;">
                      <span style="color: #a49175', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed overlap and background bleeding.";
