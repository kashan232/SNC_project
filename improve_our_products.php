<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<CSS

    /* --- BEAUTIFUL ANIMATION FOR OUR PRODUCTS CARDS --- */
    .isotope-grid .single-product {
        background: #fff !important;
        border-radius: 16px !important;
        padding: 15px !important;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
        margin-bottom: 30px !important; /* Space between rows */
        border: 2px solid transparent !important;
    }
    
    .isotope-grid .single-product:hover {
        transform: translateY(-10px) scale(1.02) !important;
        box-shadow: 0 20px 40px rgba(255, 255, 255, 0.2) !important;
        border-color: rgba(255,255,255,0.5) !important;
        border-radius: 40px 12px 40px 12px !important; /* Animated shape change */
    }
    
    .isotope-grid .single-product .product-img {
        background: #f4f4f4 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 220px !important; 
        position: relative !important;
    }
    
    .isotope-grid .single-product .product-img img {
        object-fit: cover !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.6s ease-out !important;
    }
    
    .isotope-grid .single-product:hover .product-img img {
        transform: scale(1.15) rotate(3deg) !important;
    }
    
    /* Make the action buttons animate beautifully */
    .isotope-grid .single-product .product-action a {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }
    
    .isotope-grid .single-product .product-action a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: scale(1.2) rotate(15deg) !important; /* Fun rotation on hover */
        box-shadow: 0 8px 20px rgba(0,0,0,0.2) !important;
    }
CSS;

$c = preg_replace('/(\<\/style\>)/i', $css . "\n$1", $c, 1);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Our Products animation improved!";
