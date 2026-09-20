<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS

    /* --- NEW ARRIVALS SPECIFIC HOVER EFFECT --- */
    /* Override the general clean-card hover for the New Arrivals section */
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
    
    /* Image animation for New Arrivals - slightly different from Featured */
    .shop-home-list .clean-card:hover .product-img img.default-img {
        transform: scale(1.12) rotate(-3deg) !important; /* Rotates the other way */
        transition: transform 0.6s ease-out !important;
    }
CSS;

// Find the first </style> tag and insert before it
$c = preg_replace('/(\<\/style\>)/i', $css . "\n$1", $c, 1);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "New Arrivals specific animation added!";
