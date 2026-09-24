<?php
$f_index = 'resources/views/frontend/index.blade.php';
$f_grids = 'resources/views/frontend/pages/product-grids.blade.php';

$c_index = file_get_contents($f_index);
$c_grids = file_get_contents($f_grids);

// 1. Remove Bestseller badge from index.blade.php
$c_index = preg_replace('/@elseif\(\$product->condition==\'hot\'\)\s*<span class="badge-bestseller"><i class="ti-star"><\/i> Bestseller<\/span>/', '', $c_index);

// 2. Remove Bestseller badge from product-grids.blade.php
$c_grids = preg_replace('/@elseif\(\$product->condition==\'hot\'\)\s*<span class="badge-bestseller"><i class="ti-star"><\/i> Bestseller<\/span>/', '', $c_grids);

// 3. Add padding to card content in index.blade.php
$paddingFix = '
<style>
/* INCREASE CARD PADDING */
.isotope-grid .modern-product-card .product-info-modern {
    padding: 20px 22px 25px 22px !important; /* Slightly more breathing room */
}
</style>
';

if (strpos($c_index, '@endpush') !== false) {
    $c_index = str_replace('@endpush', $paddingFix . "\n@endpush", $c_index);
} else {
    $c_index .= "\n" . $paddingFix;
}

file_put_contents($f_index, $c_index);
file_put_contents($f_grids, $c_grids);

echo "Bestseller removed and padding increased!";
?>
