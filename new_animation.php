<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// 1. Add the shopping cart icon next to the plus icon
$c = str_replace('<i class="ti-plus"></i>', '<i class="ti-plus"></i><i class="ti-shopping-cart"></i>', $c);

// 2. We need to update the CSS. Let's find the old CSS and replace it.
// First, replace the old hover rule for clean-card
$old_hover = <<<CSS
    .clean-card:hover {
        box-shadow: 0 15px 40px rgba(211,84,0,0.25) !important;
        transform: translateY(-10px) !important;
        border-color: rgba(211,84,0,0.5) !important;
    }
CSS;

$new_hover = <<<CSS
    .clean-card {
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }
    .clean-card:hover {
        box-shadow: 0 15px 40px rgba(211,84,0,0.2) !important;
        transform: translateY(-8px) !important;
        border-color: rgba(211,84,0,0.3) !important;
        border-radius: 40px 12px 40px 12px !important; /* Cool shape change */
    }
CSS;

$c = str_replace($old_hover, $new_hover, $c);

// 3. Update the button CSS
$old_btn_hover = <<<CSS
    .clean-card:hover a.clean-add-cart {
        background: #4a2e2b !important;
        transform: scale(1.1) rotate(180deg) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        transition: all 0.4s ease !important;
    }
CSS;

$new_btn_hover = <<<CSS
    a.clean-add-cart {
        overflow: hidden !important;
    }
    a.clean-add-cart i {
        position: absolute !important;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease !important;
    }
    a.clean-add-cart .ti-plus {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
    a.clean-add-cart .ti-shopping-cart {
        transform: scale(0) rotate(-180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart {
        background: #4a2e2b !important;
        transform: scale(1.1) !important;
        box-shadow: 0 6px 15px rgba(74, 46, 43, 0.4) !important;
        border-radius: 50% !important; /* Make it fully round on hover */
    }
    
    .clean-card:hover a.clean-add-cart .ti-plus {
        transform: scale(0) rotate(180deg) !important;
        opacity: 0 !important;
    }
    
    .clean-card:hover a.clean-add-cart .ti-shopping-cart {
        transform: scale(1) rotate(0deg) !important;
        opacity: 1 !important;
    }
CSS;

$c = str_replace($old_btn_hover, $new_btn_hover, $c);

// Also remove the old image hover and put a simpler one so it's not too crazy
$old_img_hover = <<<CSS
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.15) rotate(2deg) !important;
        transition: transform 0.5s ease-out !important;
    }
CSS;

$new_img_hover = <<<CSS
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.1) !important;
        transition: transform 0.5s ease-out !important;
    }
CSS;
$c = str_replace($old_img_hover, $new_img_hover, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "New animations applied!";
