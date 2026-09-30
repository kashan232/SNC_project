<?php
$f = 'resources/views/frontend/index.blade.php';
// 1. Get the file from BEFORE my catastrophic replace
$c = shell_exec('git show HEAD^:resources/views/frontend/index.blade.php');

// 2. We still want to remove width: 100% from buttons if there's any
$c = preg_replace('/\.btn-action-modern\s*\{\s*width:\s*100%;\s*\}/is', '', $c);

// 3. We STILL want to remove the old object-fit: contain override if it was there
$c = str_replace('object-fit: contain !important; /* contain so we see the full item */', 'object-fit: cover !important;', $c);
$c = str_replace('height: 180px !important;
        max-height: 180px !important;', 'height: 220px !important; max-height: 220px !important;', $c);
        
$c = str_replace('height: 180px !important;', 'height: 220px !important;', $c);

// 4. Append the CORRECT fix
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
        max-height: 220px !important;
        object-fit: cover !important;
        width: 100% !important;
    }
}
</style>
';

$c .= $append;
file_put_contents($f, $c);
echo "Restored from HEAD^ and applied correct absolute fixes.\n";
?>
