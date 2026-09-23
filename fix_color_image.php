<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// We need to inject new overrides for the colors and the image spacing
$newOverrides = '
    /* COLOR THEME & FULL IMAGE WIDTH FIXES */
    .badge-discount {
        background: #F7941D !important; /* Theme Orange */
        color: #fff !important;
    }
    .btn-wishlist-modern {
        background: #F7941D !important; /* Theme Orange */
        color: #fff !important;
    }
    .btn-wishlist-modern:hover {
        background: #e08316 !important;
    }
    
    /* Remove padding from card, apply to content so image is edge-to-edge at the top */
    .modern-product-card {
        padding: 0 !important;
    }
    .product-img-modern {
        margin: 0 !important;
        border-radius: 12px 12px 0 0 !important;
        height: 220px !important; /* Slightly taller to look majestic */
        background: #fff;
    }
    .product-img-modern img {
        object-fit: cover !important; /* Forces the image to fill the entire space beautifully */
    }
    .product-info-modern {
        padding: 15px 20px 20px 20px !important;
    }
    
    @media (max-width: 768px) {
        .product-img-modern {
            height: 140px !important;
        }
        .product-info-modern {
            padding: 10px 12px 12px 12px !important;
        }
    }
';

$c = str_replace('</style>', $newOverrides . "\n</style>", $c);

// We also need to fix any previous !important overrides that might conflict, 
// for example if I previously set padding: 20px !important on the card or margin on image.
// My previous script had:
// .product-img-modern { margin: 10px 0 15px 0 !important; }
$c = preg_replace('/margin:\s*10px\s*0\s*15px\s*0\s*!important;/', 'margin: 0 !important;', $c);

// And if there were any previous wishlist/discount colors, this new block at the END will override them since it is appended right before </style>.

file_put_contents($f, $c);
echo "Color theme and image space fixed!";
?>
