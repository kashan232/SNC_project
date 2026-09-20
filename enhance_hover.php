<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_hover = <<<CSS
    .clean-card:hover {
        box-shadow: 0 8px 25px rgba(211,84,0,0.1) !important;
        transform: translateY(-5px) !important;
    }
CSS;

$new_hover = <<<CSS
    .clean-card:hover {
        box-shadow: 0 15px 40px rgba(211,84,0,0.25) !important;
        transform: translateY(-10px) !important;
        border-color: rgba(211,84,0,0.5) !important;
    }
    
    .clean-card:hover a.clean-add-cart {
        background: #4a2e2b !important;
        transform: scale(1.1) rotate(180deg) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        transition: all 0.4s ease !important;
    }
    
    .clean-card:hover a.clean-wishlist {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: scale(1.1) !important;
    }
CSS;

$old_img_hover = <<<CSS
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.08) !important;
    }
CSS;

$new_img_hover = <<<CSS
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.15) rotate(2deg) !important;
        transition: transform 0.5s ease-out !important;
    }
CSS;

$c = str_replace($old_hover, $new_hover, $c);
$c = str_replace($old_img_hover, $new_img_hover, $c);

// Need to make sure transitions are added to buttons
$c = str_replace('a.clean-add-cart {', "a.clean-add-cart {\n        transition: all 0.4s ease !important;", $c);
$c = str_replace('a.clean-wishlist {', "a.clean-wishlist {\n        transition: all 0.4s ease !important;", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Hover effects enhanced!";
