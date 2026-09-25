<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// 1. Find and extract the coupon block
if (preg_match('/<div class="coupon">[\s\S]*?<\/div>/', $c, $matches)) {
    $couponBlock = $matches[0];
    
    // Remove it from its original location
    $c = str_replace($couponBlock, '', $c);
    
    // Insert it before button5
    $c = str_replace('<div class="button5">', $couponBlock . "\n\t\t\t\t\t\t\t\t\t<div class=\"button5\">", $c);
    
    echo "Coupon block moved successfully!\n";
} else {
    echo "Could not find coupon block!\n";
}

// 2. Fix the CSS
// Replace .total-amount .left .coupon with .total-amount .right .coupon
$c = str_replace('.total-amount .left .coupon', '.total-amount .right .coupon', $c);

// Inject specific styles to make it fit beautifully inside the right box
// We'll just append it to the end of the existing styles so it overrides properly.
$css = '
<style>
    .total-amount .right .coupon {
        width: 100% !important;
        max-width: 100% !important;
        margin-top: 15px !important;
        margin-bottom: 20px !important;
        padding-top: 20px !important;
        border-top: 1px dashed #eee !important;
    }
    .total-amount .right .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        height: 46px !important;
        padding: 0 100px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 13px !important;
        background: #fdfdfd !important;
        box-shadow: none !important;
    }
    .total-amount .right .coupon form input:focus {
        background: #fff !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 38px !important;
        border-radius: 30px !important;
        padding: 0 18px !important;
        font-size: 12px !important;
    }
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "CSS updated!";
?>
