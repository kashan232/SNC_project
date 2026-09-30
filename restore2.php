<?php
// Let's explicitly checkout the correct version that had the columns
shell_exec('git checkout HEAD^ resources/views/frontend/index.blade.php');

$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Apply the CORRECT fixes for the products ONLY
$append = '
<style>
/* ABSOLUTE OVERRIDE FOR BUTTONS AND IMAGES (MOBILE ONLY) */
@media (max-width: 768px) {
    html body .isotope-grid .modern-product-card .product-action-modern {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        gap: 10px !important;
        width: 100% !important;
    }
    html body .isotope-grid .modern-product-card .product-action-modern a.btn-action-modern {
        flex: 1 1 50% !important;
        width: 50% !important;
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 12px 0px !important;
        font-size: 13px !important;
        margin: 0 !important;
        white-space: nowrap !important;
    }
    html body .isotope-grid .modern-product-card .product-img-modern img {
        height: 220px !important;
        max-height: 220px !important;
        object-fit: cover !important;
        width: 100% !important;
    }
}
</style>
';

$c .= $append;
file_put_contents($f, $c);
echo "Properly checked out and applied!\n";
?>
