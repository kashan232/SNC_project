<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// We need to inject strict CSS to fix the card height issues and image bounding.
$fixCSS = '
    /* CARD HEIGHT & GRID FIXES */
    .modern-products-grid {
        display: flex !important;
        flex-wrap: wrap !important;
    }
    .modern-products-grid > [class*="col-"] {
        display: flex !important;
        flex-direction: column !important;
        margin-bottom: 25px !important;
    }
    .modern-product-card {
        flex: 1 1 auto !important; /* Forces card to stretch to match sibling heights */
        width: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
    }
    .product-info-modern {
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important; /* Takes up remaining space */
    }
    
    /* Lock image container sizes */
    .product-img-modern {
        height: 180px !important;
        min-height: 180px !important;
        max-height: 180px !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 10px 0 15px 0 !important;
        overflow: hidden !important;
    }
    .product-img-modern img {
        width: 100% !important;
        height: 100% !important;
        object-fit: contain !important; /* Contains any image ratio inside the 180px box perfectly */
    }
    
    /* Standardize Title & Desc Heights so they align beautifully */
    .product-info-modern h3 {
        margin-bottom: 5px !important;
        min-height: 42px !important; /* Space for 2 lines */
    }
    .product-info-modern h3 a {
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        line-height: 1.4 !important;
    }
    
    .product-desc {
        min-height: 36px !important; /* Space for 2 lines */
        margin-bottom: 15px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        line-height: 1.4 !important;
    }
    
    /* Force price and buttons to the bottom */
    .price-row {
        margin-top: auto !important;
        margin-bottom: 15px !important;
    }
    .product-action-modern {
        margin-top: 0 !important; /* Auto handled by price-row */
    }
    
    @media (max-width: 768px) {
        .product-img-modern {
            height: 120px !important;
            min-height: 120px !important;
            max-height: 120px !important;
        }
        .product-info-modern h3 {
            min-height: 38px !important;
        }
        .product-desc {
            min-height: 32px !important;
            margin-bottom: 10px !important;
        }
    }
';

$c = str_replace('</style>', $fixCSS . "\n</style>", $c);

file_put_contents($f, $c);
echo "Card heights and images fixed!";
?>
