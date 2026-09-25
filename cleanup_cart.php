<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// Remove all my previous injected <style> blocks
$c = preg_replace('/<style>\s*\/\* Cart Page Modern Redesign \*\/(.*?)<\/style>/s', '', $c);
$c = preg_replace('/<style>\s*\/\* 1\. Header Trash Icon White \*\/(.*?)<\/style>/s', '', $c);
$c = preg_replace('/<style>\s*\/\* Robust fix for Quantity Input \*\/(.*?)<\/style>/s', '', $c);
$c = preg_replace('/<style>\s*\/\* Robust fix for Subtotal and You Pay \*\/(.*?)<\/style>/s', '', $c);

// Also any stray simple ones I added
$c = preg_replace('/<style>\s*\.shopping-summery \{\s*color: #fff(.*?)<\/style>/s', '', $c);

// Now define ONE clean, consolidated CSS block
$css = '
<style>
    /* ========================================= */
    /* CART PAGE UNIFIED MODERN STYLES */
    /* ========================================= */

    /* 1. Main Table Styling */
    .shopping-summery {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .shopping-summery thead {
        background: var(--primary-color) !important;
    }
    .shopping-summery thead tr th {
        color: #fff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        padding: 18px 20px;
        border: none;
    }
    .shopping-summery thead .remove-icon {
        color: #fff !important;
    }
    .shopping-summery tbody tr {
        border-bottom: 1px solid #f5f5f5;
    }
    .shopping-summery tbody tr:last-child {
        border-bottom: none;
    }
    .shopping-summery tbody tr td {
        vertical-align: middle;
        padding: 20px;
        border: none;
    }
    
    /* Product Info in Table */
    .shopping-summery .cart-img img,
    .shopping-summery .image img {
        border-radius: 8px;
        width: 80px;
        height: 80px;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .shopping-summery .product-name a {
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }
    .shopping-summery .product-name a:hover {
        color: var(--primary-color);
    }
    .shopping-summery .amount, .shopping-summery .money {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    /* Trash Icon */
    .shopping-summery .action a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 35px;
        height: 35px;
        background: #fff5f5;
        border-radius: 50%;
        color: #ff4757;
        transition: all 0.3s;
    }
    .shopping-summery .action a:hover {
        background: #ff4757;
        color: #fff;
    }

    /* Update Button */
    .btn.float-right {
        background: #f4f5f7 !important;
        color: #333 !important;
        border: none !important;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn.float-right:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }

    /* 2. Quantity Input Redesign */
    .shopping-summery .qty {
        width: 140px;
        text-align: center;
    }
    .shopping-summery .qty .input-group {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: center !important;
        width: 110px !important;
        margin: 0 auto !important;
        background: #f8f9fa !important;
        border: 1px solid #e9ecef !important;
        border-radius: 30px !important;
        padding: 3px !important;
    }
    .shopping-summery .qty .input-group .button {
        margin: 0 !important;
        padding: 0 !important;
        display: flex !important;
    }
    .shopping-summery .qty .input-group .button .btn {
        background: #fff !important;
        color: #333 !important;
        border: none !important;
        border-radius: 50% !important;
        width: 30px !important;
        height: 30px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
        padding: 0 !important;
        transition: all 0.2s !important;
    }
    .shopping-summery .qty .input-group .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .shopping-summery .qty .input-group .input-number {
        width: 35px !important;
        height: 30px !important;
        border: none !important;
        background: transparent !important;
        text-align: center !important;
        font-weight: 700 !important;
        color: #333 !important;
        margin: 0 4px !important;
        padding: 0 !important;
    }

    /* 3. Coupon Form Redesign */
    .total-amount .left {
        margin-top: 15px;
    }
    .total-amount .left .coupon {
        width: 100%;
        max-width: 400px;
    }
    .total-amount .left .coupon form {
        display: flex !important;
        position: relative !important;
        width: 100% !important;
    }
    .total-amount .left .coupon form input {
        width: 100% !important;
        height: 48px !important;
        padding: 0 110px 0 20px !important;
        border-radius: 30px !important;
        border: 1px solid #ddd !important;
        font-size: 14px !important;
        background: #fff !important;
        color: #333 !important;
    }
    .total-amount .left .coupon form input:focus {
        border-color: var(--primary-color) !important;
        outline: none !important;
    }
    .total-amount .left .coupon form .btn {
        position: absolute !important;
        right: 4px !important;
        top: 4px !important;
        height: 40px !important;
        border-radius: 30px !important;
        padding: 0 20px !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.2s !important;
    }
    .total-amount .left .coupon form .btn:hover {
        filter: brightness(0.9) !important;
    }

    /* 4. Subtotal / Total Card Layout */
    .total-amount .right {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-top: 15px;
    }
    .total-amount .right ul {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 0 20px 0 !important;
    }
    .total-amount .right ul li {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        font-size: 15px !important;
        color: #555 !important;
        margin-bottom: 12px !important;
        padding-bottom: 12px !important;
        border-bottom: 1px dashed #eee !important;
    }
    .total-amount .right ul li span {
        font-weight: 700 !important;
        color: #333 !important;
    }
    .total-amount .right ul li.last {
        border: none !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
        font-size: 16px !important;
        color: #222 !important;
        font-weight: 700 !important;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color) !important;
        font-size: 22px !important;
    }

    /* Checkout & Continue Shopping Buttons */
    .button5 {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .button5 .btn {
        width: 100% !important;
        border-radius: 6px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        padding: 12px 20px !important;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        text-align: center !important;
        transition: all 0.3s !important;
    }
    .button5 .btn:last-child {
        background: #f4f5f7 !important;
        color: #333 !important;
    }
    .button5 .btn:hover {
        filter: brightness(0.9) !important;
    }
</style>
';

// Add the consolidated clean CSS
if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Cleaned up and applied unified CSS!";
?>
