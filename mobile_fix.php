<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);
$css = "
    @media (max-width: 768px) {
        .shop-top-modern {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
        }
        .shop-top-right {
            width: 100%;
        }
        .search-bar-modern {
            width: 100%;
        }
        .modern-search-input {
            width: 100%;
        }
        
        /* Buttons layout on mobile */
        .product-action-modern {
            flex-direction: column;
            gap: 8px;
        }
        .btn-action-modern {
            width: 100%;
            padding: 8px 5px;
            font-size: 12px;
        }
        
        /* Reduce card padding on mobile */
        .modern-product-card {
            padding: 12px;
            border-radius: 12px;
        }
        .product-info-modern h3 a {
            font-size: 14px;
        }
        .current-price {
            font-size: 16px;
        }
        .card-badges span {
            font-size: 8px;
            padding: 3px 6px;
        }
        .product-img-modern {
            height: 120px;
        }
    }
    </style>";
$c = str_replace('</style>', $css, $c);

// Also change col-12 to col-6 for product cards to fit 2 per row on mobile
$c = str_replace('<div class="col-lg-4 col-md-6 col-12 mb-4">', '<div class="col-lg-4 col-md-6 col-6 mb-4" style="padding: 0 5px;">', $c);

// Wrap row with a tighter margin for mobile
$c = str_replace('<div class="row modern-products-grid">', '<div class="row modern-products-grid" style="margin: 0 -5px;">', $c);

file_put_contents($f, $c);
