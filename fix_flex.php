<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Find any instance of .product-action-modern getting column stacked and force it to row.
// Let's just append a very strong CSS override at the end to make sure it's horizontal.

$append = '
<style>
/* FORCE PRODUCT BUTTONS HORIZONTAL ON 1-COLUMN MOBILE LAYOUT */
@media (max-width: 768px) {
    .isotope-grid .modern-product-card .product-action-modern {
        flex-direction: row !important;
        gap: 8px !important;
    }
    .isotope-grid .modern-product-card .btn-action-modern {
        padding: 10px 8px !important;
        font-size: 13px !important;
        flex: 1 !important;
    }
    .isotope-grid .modern-product-card .product-img-modern img {
        height: 250px !important;
        object-fit: cover !important;
        width: 100% !important;
    }
    .isotope-grid .modern-product-card h3 a {
        font-size: 18px !important;
    }
    .isotope-grid .modern-product-card .current-price {
        font-size: 18px !important;
    }
}
</style>
';

$c .= $append;

file_put_contents($f, $c);
echo "Added strong CSS override to ensure horizontal buttons and proper image height.\n";
?>
