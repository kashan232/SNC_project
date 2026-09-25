<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// Add missing CSS for layout fixes
$css = '
<style>
    /* 1. Header Trash Icon White */
    .shopping-summery thead .remove-icon {
        color: #fff !important;
    }

    /* 2. Quantity Input Complete Redesign */
    .shopping-summery .qty .input-group {
        display: inline-flex !important;
        align-items: center !important;
        background: #f4f5f7;
        border: 1px solid #eaeaea;
        border-radius: 30px;
        padding: 4px;
        width: auto !important;
        flex-wrap: nowrap !important;
    }
    .shopping-summery .qty .button .btn {
        background: #fff !important;
        color: #333 !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08) !important;
        border-radius: 50% !important;
        width: 34px !important;
        height: 34px !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        padding: 0 !important;
        border: none !important;
        transition: all 0.2s !important;
    }
    .shopping-summery .qty .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: scale(1.05);
    }
    .shopping-summery .qty .input-number {
        border: none !important;
        background: transparent !important;
        text-align: center !important;
        width: 40px !important;
        font-weight: 700 !important;
        color: #333 !important;
        margin: 0 5px !important;
        padding: 0 !important;
    }
    .shopping-summery .qty .input-number:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    /* 3. Fix Subtotal Card Layout */
    .total-amount .right ul {
        padding: 0;
        margin: 0 0 20px 0;
        list-style: none;
    }
    .total-amount .right ul li {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        font-size: 15px !important;
        color: #555 !important;
        margin-bottom: 15px !important;
        padding-bottom: 15px !important;
        border-bottom: 1px dashed #eee !important;
        width: 100% !important;
    }
    .total-amount .right ul li span {
        font-weight: 700 !important;
        color: #333 !important;
    }
    .total-amount .right ul li.last {
        border: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        font-size: 18px !important;
        color: #222 !important;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color) !important;
        font-size: 22px !important;
    }
    .total-amount .right {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
        border: 1px solid #f0f0f0;
        margin-top: 20px;
    }
    .total-amount .left {
        margin-top: 20px;
    }
    .coupon form {
        display: flex;
        gap: 15px;
        align-items: center;
    }
</style>
';

// Replace previous <style> if we need to ensure the new one takes precedence, 
// but since this is appended to @endpush or bottom, it will override nicely if we use !important.
if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Fixes applied!";
?>
