<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_img_hover = <<<CSS
    .isotope-grid .single-product:hover .product-img img {
        transform: scale(1.15) rotate(3deg) !important;
    }
CSS;

// Remove the image zoom/rotate animation.
// Also add a rule to hide the secondary image (.hover-img) to fix the double image issue.
$new_img_hover = <<<CSS
    /* Removed image animation as per user request */
    
    /* Fix double image issue by hiding the hover-img */
    .isotope-grid .single-product .product-img img.hover-img {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }
CSS;

$c = str_replace($old_img_hover, $new_img_hover, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed image hover in Our Products!";
