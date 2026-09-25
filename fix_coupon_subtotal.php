<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

$css = '
<style>
    /* Robust fix for Subtotal and You Pay */
    .total-amount .right ul {
        display: block !important;
        padding: 0 !important;
        margin: 0 0 25px 0 !important;
    }
    .total-amount .right ul li {
        display: block !important;
        width: 100% !important;
        font-size: 15px !important;
        color: #555 !important;
        margin-bottom: 15px !important;
        padding-bottom: 15px !important;
        border-bottom: 1px dashed #eee !important;
        overflow: hidden !important; /* clears the float */
        line-height: 24px !important;
        text-align: left !important;
    }
    .total-amount .right ul li span {
        float: right !important;
        font-weight: 700 !important;
        color: #333 !important;
    }
    .total-amount .right ul li.last {
        border: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        font-size: 18px !important;
        color: #222 !important;
        font-weight: 700 !important;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color) !important;
        font-size: 24px !important;
    }

    /* Redesign Coupon Input Form */
    .total-amount .left .coupon {
        width: 100% !important;
        margin-bottom: 20px !important;
    }
    .total-amount .left .coupon form {
        position: relative !important;
        display: block !important;
        width: 100% !important;
        max-width: 450px !important;
    }
    .total-amount .left .coupon form input {
        width: 100% !important;
        height: 54px !important;
        padding: 0 130px 0 20px !important;
        border-radius: 50px !important;
        border: 1px solid #e2e2e2 !important;
        font-size: 15px !important;
        background: #fcfcfc !important;
        box-shadow: inset 0 2px 5px rgba(0,0,0,0.02) !important;
        color: #333 !important;
    }
    .total-amount .left .coupon form input:focus {
        outline: none !important;
        border-color: var(--primary-color) !important;
        background: #fff !important;
    }
    .total-amount .left .coupon form .btn {
        position: absolute !important;
        right: 6px !important;
        top: 6px !important;
        height: 42px !important;
        border-radius: 50px !important;
        padding: 0 25px !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        font-weight: 600 !important;
        border: none !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    }
    .total-amount .left .coupon form .btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 15px rgba(0,0,0,0.15) !important;
        filter: brightness(0.9) !important;
    }
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Coupon and subtotal layout fixed!";
?>
