<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// Fix the typo
$c = str_replace('There are no any carts available.', 'Your cart is empty.', $c);
$c = str_replace('background:#F7941D !important;', 'background:var(--primary-color) !important;', $c);

// Add custom styling for the Cart page
$css = '
<style>
    /* Cart Page Modern Redesign */
    .shopping-summery {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        overflow: hidden;
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
    }
    .shopping-summery thead {
        background: var(--primary-color);
    }
    .shopping-summery thead tr th {
        color: #fff !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        padding: 18px 20px;
        border: none;
    }
    .shopping-summery tbody tr {
        border-bottom: 1px solid #f5f5f5;
        transition: all 0.3s;
    }
    .shopping-summery tbody tr:hover {
        background: #fafafa;
    }
    .shopping-summery tbody tr td {
        vertical-align: middle;
        padding: 20px;
        border: none;
    }
    .shopping-summery .cart-img img,
    .shopping-summery .image img {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        width: 90px;
        height: 90px;
        object-fit: cover;
    }
    .shopping-summery .product-name a {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        transition: all 0.2s;
    }
    .shopping-summery .product-name a:hover {
        color: var(--primary-color);
    }
    .shopping-summery .amount, .shopping-summery .money {
        font-size: 16px;
        font-weight: 700;
        color: var(--primary-color);
    }
    /* Input qty */
    .input-group .button .btn {
        background: #f4f5f7 !important;
        color: #333 !important;
        border: none !important;
        border-radius: 50% !important;
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }
    .input-group .button .btn:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .input-group .input-number {
        border: 1px solid #eee;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        width: 50px;
        margin: 0 10px;
    }
    /* Remove icon */
    .shopping-summery .remove-icon {
        color: #ff4757;
        font-size: 18px;
        transition: all 0.3s;
    }
    .shopping-summery .action a:hover .remove-icon {
        color: #c0392b;
        transform: scale(1.2);
    }
    /* Total box */
    .total-amount .right {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }
    .total-amount .right ul li {
        font-size: 15px;
        color: #555;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px dashed #eee;
    }
    .total-amount .right ul li span {
        font-weight: 700;
        color: #333;
    }
    .total-amount .right ul li.last {
        font-size: 18px;
        color: #222;
        font-weight: 700;
        border: none;
        padding-bottom: 0;
    }
    .total-amount .right ul li.last span {
        color: var(--primary-color);
        font-size: 22px;
    }
    .button5 .btn {
        width: 100%;
        margin-bottom: 10px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        padding: 14px 20px;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
    }
    .button5 .btn:hover {
        filter: brightness(0.9) !important;
    }
    .coupon form {
        display: flex;
        gap: 10px;
    }
    .coupon form input {
        border-radius: 8px;
        border: 1px solid #eee;
        padding: 10px 15px;
        flex: 1;
    }
    .coupon form .btn {
        border-radius: 8px;
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
    }
    .btn.float-right {
        background: var(--primary-color) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 8px;
        padding: 10px 20px;
    }
    .btn.float-right:hover {
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
echo "Cart page redesigned and green colors removed!";
?>
