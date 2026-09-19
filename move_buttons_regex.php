<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// We want to move <div class="button-head">...</div> out of <div class="product-img">
// Let's just find the exact structure and replace it.
// Structure:
// <div class="button-head">
//     <div class="product-action d-flex justify-content-center align-items-center w-100">
//         <a title="Add to cart" ...><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
//         <a data-toggle="modal" ...><i class="ti-eye"></i><span>Quick Shop</span></a>
//         <a title="Wishlist" ...><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
//     </div>
// </div>
// </div> <!-- end of product-img -->
// <div class="product-content">
//     <h3>...</h3>
//     <div class="product-price">
//         ...
//     </div>
// </div>

// Instead of matching the whole button-head, let's just match the closing div of product-img!
// Wait! If I just swap the closing div of product-img!
// Original:
// <div class="button-head"> ... </div>
// </div> <!-- end product-img -->
// <div class="product-content"> ... </div>
// </div> <!-- end single-product -->

// If I move the closing div of product-img to be BEFORE button-head:
// </div> <!-- end product-img -->
// <div class="button-head"> ... </div>
// <div class="product-content"> ... </div>

// But wait, if I do that, `.button-head` will be BETWEEN `.product-img` and `.product-content`.
// That is perfectly fine! In a flex column, it will render between them.
// But the user said "price ke nechy dono button aien ge" (buttons should come AFTER the price).
// So `.button-head` MUST be AFTER `.product-content`!

$pattern = '/(\<div class="button-head"\>.*?\<div class="product-action d-flex justify-content-center align-items-center w-100"\>.*?\<\/div\>\s*\<\/div\>)\s*(\<\/div\>)\s*(\<div class="product-content"\>.*?\<\/div\>)/s';
$replacement = '$2' . "\n" . '$3' . "\n" . '$1';

// We only want to apply this to the "Our Products" section.
$start = strpos($c, 'class="product-area section our-products-area"');
$end = strpos($c, 'id="our-outlets-premium"');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    $new_block = preg_replace($pattern, $replacement, $block);
    
    $c = $before . $new_block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Replaced via regex successfully.";
} else {
    echo "Could not find boundaries.";
}
