<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$old_css = <<<CSS
    .shop-home-list .clean-card {
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
        border-bottom: 3px solid transparent !important;
    }
    
    .shop-home-list .clean-card:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
        transform: translateY(-8px) scale(1.02) !important;
        border-color: #f0f0f0 !important; 
        border-bottom: 3px solid var(--primary-color) !important; /* Cool bottom border highlight */
        border-radius: 16px !important; /* Keep it uniform, no leaf shape */
        background: #fffafa !important; /* Very subtle warm tint */
    }
CSS;

$new_css = <<<CSS
    .shop-home-list .clean-card {
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
        border: 2px solid transparent !important; /* Ready for border animation */
    }
    
    .shop-home-list .clean-card:hover {
        box-shadow: 0 20px 40px rgba(193, 84, 11, 0.15) !important;
        transform: translateY(-8px) scale(1.02) !important;
        border: 2px solid var(--primary-color) !important; /* Full border on hover */
        border-radius: 12px 40px 12px 40px !important; /* Opposite leaf shape */
        background: #fffafa !important; /* Very subtle warm tint */
    }
CSS;

$c = str_replace($old_css, $new_css, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Updated New Arrivals hover effect!";
