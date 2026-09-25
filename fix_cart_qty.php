<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

$css = '
<style>
    /* Robust fix for Quantity Input */
    .shopping-summery .qty {
        width: 150px !important;
        text-align: center !important;
    }
    .shopping-summery .qty .input-group {
        display: inline-flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        width: 120px !important;
        margin: 0 auto !important;
        position: relative !important;
        flex-wrap: nowrap !important;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
    }
    .shopping-summery .qty .input-group .button {
        display: flex !important;
        position: static !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 35px !important;
        height: 35px !important;
    }
    .shopping-summery .qty .input-group .button .btn {
        background: #f4f5f7 !important;
        color: #333 !important;
        border-radius: 0 !important;
        width: 35px !important;
        height: 35px !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 1px solid #ddd !important;
        box-shadow: none !important;
        transform: none !important;
    }
    .shopping-summery .qty .input-group .button.minus .btn {
        border-radius: 6px 0 0 6px !important;
    }
    .shopping-summery .qty .input-group .button.plus .btn {
        border-radius: 0 6px 6px 0 !important;
    }
    .shopping-summery .qty .input-group .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        border-color: var(--primary-color) !important;
    }
    .shopping-summery .qty .input-group .input-number {
        width: 50px !important;
        height: 35px !important;
        border: 1px solid #ddd !important;
        border-left: none !important;
        border-right: none !important;
        border-radius: 0 !important;
        text-align: center !important;
        padding: 0 !important;
        margin: 0 !important;
        position: static !important;
        font-weight: 600 !important;
        color: #333 !important;
        background: #fff !important;
    }
    .shopping-summery .qty .input-group .input-number:focus {
        outline: none !important;
        box-shadow: none !important;
    }
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Robust quantity input fixed!";
?>
