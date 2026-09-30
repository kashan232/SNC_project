<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// 1. Remove all instances where product-action-modern is forced to column
$c = str_replace('flex-direction: column !important; /* Stack on very small screens if they don\'t fit */', 'flex-direction: row !important;', $c);
$c = str_replace('flex-direction: column !important;
        gap: 5px !important;', 'flex-direction: row !important; gap: 8px !important;', $c);
$c = str_replace('flex-direction: column;', 'flex-direction: row;', $c);

// 2. Remove any width: 100% from buttons that might be forcing wrapping
$c = preg_replace('/\.btn-action-modern\s*\{\s*width:\s*100%;\s*\}/is', '', $c);

// 3. Fix the image object-fit and height in my previously appended block
$c = str_replace('object-fit: contain !important; /* contain so we see the full item */', 'object-fit: cover !important;', $c);
$c = str_replace('height: 180px !important;
        max-height: 180px !important;', 'height: 220px !important; max-height: 220px !important;', $c);

// 4. Ensure we have the absolute strongest override at the bottom
$append = '
<style>
/* ABSOLUTE OVERRIDE FOR BUTTONS AND IMAGES */
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
        object-fit: cover !important;
        width: 100% !important;
    }
}
</style>
';

$c .= $append;
file_put_contents($f, $c);
echo "Applied absolute strong CSS for side-by-side buttons and proper cover image height.\n";
?>
