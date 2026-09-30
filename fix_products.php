<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Find and remove the old FORCE PRODUCT BUTTONS block
$c = preg_replace('/\/\* FORCE PRODUCT BUTTONS HORIZONTAL ON 1-COLUMN MOBILE LAYOUT \*\/(.*?)(?=\<\/style\>)/is', '', $c);

// Append the new better block
$append = '
<style>
/* ADJUST MOBILE LAYOUT FOR PRODUCTS */
@media (max-width: 768px) {
    /* Image size */
    .isotope-grid .modern-product-card .product-img-modern img {
        height: 180px !important;
        max-height: 180px !important;
        object-fit: contain !important; /* contain so we see the full item */
        width: 100% !important;
    }
    
    /* Make the buttons perfectly split 50/50 and side-by-side */
    .isotope-grid .modern-product-card .product-action-modern {
        display: flex !important;
        flex-direction: row !important;
        gap: 10px !important;
        width: 100% !important;
        justify-content: space-between !important;
    }
    .isotope-grid .modern-product-card .product-action-modern a.btn-action-modern {
        flex: 1 !important;
        width: 48% !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 12px 5px !important;
        font-size: 12px !important;
        margin: 0 !important;
    }
    
    /* Improve Title and Price sizing for mobile 1-column */
    .isotope-grid .modern-product-card h3 a {
        font-size: 18px !important;
        font-weight: 700 !important;
    }
    .isotope-grid .modern-product-card .current-price {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: #222 !important;
    }
    .isotope-grid .modern-product-card .old-price {
        font-size: 14px !important;
    }
    
    /* Container Padding */
    .isotope-grid .modern-product-card .product-info-modern {
        padding: 15px !important;
    }
}
</style>
';

$c .= $append;

file_put_contents($f, $c);
echo "Fixed product layout for mobile.\n";
?>
