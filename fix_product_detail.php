<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

$js = "
<script>
    window.baseProductPrice = {{ \$product_detail->price ?? 0 }};
    window.productDiscount = {{ \$product_detail->discount ?? 0 }};
    window.productSizePrices = {!! \$product_detail->size_prices ? \$product_detail->size_prices : '{}' !!};
</script>
";

if (strpos($c, 'window.baseProductPrice =') === false) {
    $c = preg_replace('/@push\(\'scripts\'\)/', "@push('scripts')\n" . $js, $c, 1);
    file_put_contents($f, $c);
    echo "Fixed missing window variables in product detail.";
} else {
    echo "Already fixed.";
}
?>
