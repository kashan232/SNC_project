<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

// 1. Replace Green border (#166534) and hardcoded Orange (#F7941D) with var(--primary-color)
$c = str_replace('#166534', 'var(--primary-color)', $c);
$c = str_replace('#F7941D', 'var(--primary-color)', $c);

// 2. Fix image responsiveness
$c = str_replace('max-height: 320px;', 'width: 100%; max-height: 450px;', $c);

$css = '
<style>
/* Mobile specific image adjustments */
@media (max-width: 768px) {
    .snc-main-image-container img {
        max-height: 300px !important;
        width: 100% !important;
        object-fit: contain;
    }
}
</style>
';
if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

// 3. Add background pattern to Related Products
// Find: <div class="product-area most-popular related-product section">
// Replace with styled version
$search_related = '<div class="product-area most-popular related-product section">';
$replace_related = '<div class="product-area most-popular related-product section" style="background-color: var(--primary-color); background-image: url(\'{{ asset(\'frontend/img/leaves-pattern.jpg\') }}\'); background-blend-mode: overlay; background-size: cover; background-attachment: fixed; position: relative;">';

$c = str_replace($search_related, $replace_related, $c);

// Just in case it has different classes:
$search_related2 = '<div class="product-area most-popular section">';
// I won't replace this if it doesn't have related-product to be safe, but let's check if the section is just "product-area related-product"
$c = preg_replace('/<div class="product-area most-popular related-product section"(.*?)>/', $replace_related, $c);

file_put_contents($f, $c);
echo "Detail page updated with dynamic color, responsive image, and related products background!";
?>
