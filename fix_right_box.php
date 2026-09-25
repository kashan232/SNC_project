<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// We will append a final CSS block that absolutely fixes the right box layout
$css = '
<style>
    /* Final reset for the right box */
    .total-amount .right {
        padding: 30px !important;
        box-sizing: border-box !important;
        width: 100% !important;
    }
    .total-amount .right * {
        box-sizing: border-box !important;
    }
    
    .total-amount .right ul {
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right ul li {
        padding: 0 0 12px 0 !important;
        margin: 0 0 12px 0 !important;
        width: 100% !important;
        text-align: left !important;
        position: relative !important;
    }
    .total-amount .right ul li::before {
        display: none !important; /* hide any stray icons */
    }
    
    .total-amount .right .coupon {
        padding: 20px 0 0 0 !important;
        margin: 0 0 20px 0 !important;
        width: 100% !important;
    }
    .total-amount .right .coupon form {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        display: block !important;
        position: relative !important;
    }
    .total-amount .right .coupon form input {
        width: 100% !important;
        padding-left: 20px !important;
        padding-right: 110px !important; /* space for the button */
        height: 48px !important;
        border-radius: 30px !important;
        margin: 0 !important;
    }
    .total-amount .right .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        width: 100px !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 !important;
        font-size: 13px !important;
    }

    .total-amount .right .button5 {
        padding: 0 !important;
        margin: 0 !important;
        width: 100% !important;
    }
    .total-amount .right .button5 .btn {
        margin: 0 0 10px 0 !important;
        width: 100% !important;
        display: block !important;
        box-sizing: border-box !important;
    }
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Right box layout fixed!";
?>
