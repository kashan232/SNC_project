<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

$css = '
<style>
/* Mini Cart Dropdown Modern Styling */
.shopping-item {
    position: absolute;
    top: 100%;
    right: 0;
    width: 320px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s ease;
    z-index: 999;
    border: 1px solid #f0f0f0;
}
.shopping:hover .shopping-item {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.dropdown-cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
    margin-bottom: 15px;
}
.dropdown-cart-header span {
    font-weight: 700;
    color: #333;
    font-size: 14px;
}
.dropdown-cart-header a {
    color: var(--primary-color) !important;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
}
.dropdown-cart-header a:hover {
    text-decoration: underline;
}
.shopping-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 250px;
    overflow-y: auto;
}
.shopping-list::-webkit-scrollbar {
    width: 4px;
}
.shopping-list::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 4px;
}
.shopping-list li {
    display: flex;
    align-items: center;
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 1px dashed #eee;
    position: relative;
}
.shopping-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}
.shopping-list li .remove {
    position: absolute;
    top: 0;
    left: 0;
    color: #ff4757;
    font-size: 14px;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff0f0;
    border-radius: 50%;
    transition: all 0.2s;
    z-index: 10;
}
.shopping-list li .remove:hover {
    background: #ff4757;
    color: #fff;
}
.shopping-list li .cart-img {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-left: 25px; /* space for the remove button */
    margin-right: 15px;
    border: 1px solid #f5f5f5;
    flex-shrink: 0;
}
.shopping-list li .cart-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.shopping-list li h4 {
    margin: 0 0 5px 0;
    font-size: 13px;
    line-height: 1.4;
}
.shopping-list li h4 a {
    color: #333;
    font-weight: 600;
}
.shopping-list li h4 a:hover {
    color: var(--primary-color) !important;
}
.shopping-list li .quantity {
    font-size: 12px;
    color: #777;
    margin: 0;
}
.shopping-list li .amount {
    color: var(--primary-color);
    font-weight: 700;
}
.shopping-item .bottom {
    border-top: 1px solid #eee;
    padding-top: 15px;
    margin-top: 15px;
}
.shopping-item .total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}
.shopping-item .total span {
    font-size: 15px;
    font-weight: 700;
    color: #333;
    text-transform: uppercase;
}
.shopping-item .total .total-amount {
    color: var(--primary-color);
}
.shopping-item .btn.animate {
    display: block;
    width: 100%;
    text-align: center;
    background: var(--primary-color) !important;
    color: #fff !important;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    text-transform: uppercase;
    border: none;
    transition: all 0.3s;
    line-height: 1;
}
.shopping-item .btn.animate:hover {
    filter: brightness(0.85) !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}
</style>
';

// Add CSS to the bottom of the header file
if (strpos($c, '</header>') !== false) {
    $c = str_replace('</header>', $css . "\n</header>", $c);
    file_put_contents($f, $c);
    echo "Mini cart CSS added!";
} else {
    $c .= "\n" . $css;
    file_put_contents($f, $c);
    echo "Mini cart CSS added at the end!";
}
?>
