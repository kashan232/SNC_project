<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// 1. Change text color to white for mobile categories
$c = preg_replace('/\.desk-pill-mobile-circle .cat-name \{\s*font-size: 11px !important;\s*font-weight: 700 !important;\s*color: #444 !important;/m', ".desk-pill-mobile-circle .cat-name {\n        font-size: 11px !important;\n        font-weight: 700 !important;\n        color: #fff !important;", $c);

$c = preg_replace('/\.desk-pill-mobile-circle\.is-checked \.cat-name,\s*\.desk-pill-mobile-circle\.active \.cat-name,\s*\.desk-pill-mobile-circle\.how-active1 \.cat-name \{\s*color: var\(--primary-color\) !important;\s*\}/m', ".desk-pill-mobile-circle.is-checked .cat-name,\n    .desk-pill-mobile-circle.active .cat-name,\n    .desk-pill-mobile-circle.how-active1 .cat-name {\n        color: #fff !important;\n    }", $c);

// 2. Change column classes for smaller cards on mobile
$c = str_replace('<div class="col-sm-12 col-md-6 col-lg-3 p-b-35 isotope-item', '<div class="col-6 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item', $c);

// 3. Add CSS for smaller cards on mobile
$css = '
<style>
/* Adjust card styling for smaller mobile grid (2 per row) */
@media (max-width: 575px) {
    .isotope-grid .modern-product-card {
        margin-bottom: 10px !important;
    }
    .isotope-grid .modern-product-card .product-info-modern {
        padding: 10px !important;
    }
    .isotope-grid .modern-product-card h3 a {
        font-size: 12px !important;
        line-height: 1.3 !important;
    }
    .isotope-grid .modern-product-card .current-price {
        font-size: 14px !important;
    }
    .isotope-grid .modern-product-card .product-action-modern {
        flex-direction: column !important;
        gap: 5px !important;
    }
    .isotope-grid .modern-product-card .btn-action-modern {
        padding: 6px 4px !important;
        font-size: 10px !important;
    }
    .isotope-grid .isotope-item {
        padding-left: 8px !important;
        padding-right: 8px !important;
        padding-bottom: 20px !important;
    }
}
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Cards are now 2-per-row on mobile and text is white!";
?>
