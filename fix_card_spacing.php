<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$spacingFix = '
<style>
/* FIX ISOTOPE VERTICAL SPACING */
.isotope-grid .isotope-item {
    padding-bottom: 40px !important; /* Extra padding between rows */
}
.isotope-grid .modern-product-card {
    height: 100% !important;
    margin-bottom: 20px !important; /* Force margin inside the item to separate them vertically */
}
</style>
';

// Append to the end before @endpush
if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $spacingFix . "\n@endpush", $c);
} else {
    $c .= "\n" . $spacingFix;
}

file_put_contents($f, $c);
echo "Vertical spacing fixed for Isotope grid!";
?>
