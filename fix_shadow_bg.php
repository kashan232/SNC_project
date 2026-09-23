<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Update the inline style on the product-area section background
$c = str_replace('background: #f8f9fa;', 'background: #eff2f6;', $c);

// 2. Add an override block for body color and card shadows
$cssOverride = '
    /* VISIBILITY OVERRIDES: Shadow & Body Color */
    body { background-color: #eff2f6 !important; }
    
    .modern-product-card {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    .single-widget {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    .shop-top-modern {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: none !important;
    }
    
    /* Enhance the hover effect slightly so it lifts off the page */
    .modern-product-card:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12) !important;
        transform: translateY(-5px) !important;
    }
';

$c = str_replace('</style>', $cssOverride . "\n</style>", $c);

file_put_contents($f, $c);
echo "Background and shadows enhanced!";
?>
