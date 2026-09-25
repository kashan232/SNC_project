<?php
$f = 'resources/views/frontend/pages/checkout.blade.php';
$c = file_get_contents($f);

// 1. Remove "Shop Services Area" if present
$c = preg_replace('/<!-- Start Shop Services Area.*?<!-- End Shop Services Area -->/is', '', $c);
$c = preg_replace('/<!-- Start Shop Services Area.*?<\/section>/is', '', $c);

// 2. Add custom CSS at the end of the file
$css = '
<style>
    /* ========================================= */
    /* CHECKOUT PAGE MODERN PREMIUM REDESIGN     */
    /* ========================================= */
    
    .shop.checkout {
        background: #fdfdfd;
        padding: 60px 0;
    }
    
    /* Left Column: Form Styling */
    .checkout-form {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
    }
    .checkout-form h2 {
        font-size: 24px;
        font-weight: 700;
        color: #222;
        margin-bottom: 8px;
        text-transform: capitalize;
    }
    .checkout-form p {
        color: #777;
        font-size: 14px;
        margin-bottom: 30px;
    }
    .checkout-form .form-group {
        margin-bottom: 25px;
    }
    .checkout-form .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }
    .checkout-form .form-group label span {
        color: #ff4757;
        margin-left: 3px;
    }
    .checkout-form .form-group input, 
    .checkout-form .form-group select {
        width: 100%;
        height: 52px;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        padding: 0 15px;
        font-size: 15px;
        background: #fafafa;
        color: #333;
        transition: all 0.3s ease;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.02);
    }
    .checkout-form .form-group input:focus, 
    .checkout-form .form-group select:focus {
        border-color: var(--primary-color);
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }
    .checkout-form .nice-select {
        display: none !important; /* Force hide nice-select if initialized here */
    }
    .checkout-form select.form-control {
        display: block !important; /* Force native select for better mobile UX */
        -webkit-appearance: auto;
    }
    
    /* Right Column: Order Details */
    .order-details {
        background: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.03);
        border: 1px solid #f0f0f0;
    }
    .order-details .single-widget {
        margin-bottom: 30px;
    }
    .order-details .single-widget:last-child {
        margin-bottom: 0;
    }
    .order-details .single-widget h2 {
        background: var(--primary-color);
        color: #fff;
        font-size: 15px;
        font-weight: 700;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .order-details .single-widget .content ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .order-details .single-widget .content ul li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px dashed #eee;
        font-size: 15px;
        color: #555;
    }
    .order-details .single-widget .content ul li span {
        font-weight: 700;
        color: #333;
    }
    .order-details .single-widget .content ul li.last {
        font-size: 18px;
        color: #222;
        font-weight: 800;
        border: none;
        padding-top: 20px;
    }
    .order-details .single-widget .content ul li.last span {
        font-size: 24px;
        color: var(--primary-color);
    }
    
    /* Shipping row customization */
    .order-details .single-widget .content ul li.shipping {
        flex-direction: column;
        align-items: flex-start;
    }
    .order-details .single-widget .content ul li.shipping select {
        width: 100%;
        height: 45px;
        border-radius: 6px;
        border: 1px solid #e0e0e0;
        margin-top: 10px;
        padding: 0 15px;
        font-size: 14px;
        background: #fdfdfd;
        color: #333;
        display: block !important;
    }
    .order-details .single-widget .content ul li.shipping .nice-select {
        display: none !important;
    }
    
    /* Payment Checkbox */
    .order-details .single-widget .content .checkbox {
        padding: 15px 20px;
        background: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #eee;
        margin-top: -5px;
    }
    .order-details .single-widget .content .checkbox label {
        font-size: 15px;
        font-weight: 600;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
    }
    .order-details .single-widget .content .checkbox input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }
    
    /* Checkout Button */
    .single-widget.get-button .btn {
        width: 100%;
        height: 55px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        background: var(--primary-color) !important;
        border: none !important;
        color: #fff !important;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .single-widget.get-button .btn:hover {
        filter: brightness(0.85) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
</style>
';

// Strip any old instances of this block just in case
$c = preg_replace('/<style>\s*\/\* ========================================= \*\/\s*\/\* CHECKOUT PAGE MODERN PREMIUM REDESIGN     \*\/(.*?)<\/style>/is', '', $c);

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Checkout page perfectly redesigned!";
?>
