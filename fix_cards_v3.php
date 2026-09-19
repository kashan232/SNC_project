<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<'CSS'
<style>
/* === OUR PRODUCTS DARK/GOLD DESIGN === */
/* Main Section Background */
.our-products-area {
    background-color: #2b2b36 !important;
    padding: 80px 0 !important;
}

/* Titles */
.our-products-area .section-title {
    margin-bottom: 40px !important;
}
.our-products-area .section-title span {
    color: #a49175 !important;
    font-size: 13px !important;
    letter-spacing: 2px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
}
.our-products-area .section-title h2 {
    color: #e3d2b8 !important;
    font-family: 'Playfair Display', serif !important;
    font-size: 42px !important;
    font-weight: 500 !important;
    margin-top: 5px !important;
}
.our-products-area .section-title h2 span {
    color: #e3d2b8 !important;
}
.our-products-area .section-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 2px;
    background: #a49175;
    margin: 15px auto 0;
}

/* Tabs (Filters) */
.our-products-area .nav-tabs {
    border-bottom: none !important;
    justify-content: center !important;
    margin-bottom: 40px !important;
}
.our-products-area .nav-tabs .btn {
    background: transparent !important;
    border: 1px solid #5a5c66 !important;
    color: #e3d2b8 !important;
    border-radius: 30px !important;
    padding: 8px 25px !important;
    margin: 0 5px 10px 5px !important;
    font-weight: 600 !important;
    font-size: 12px !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    transition: all 0.3s ease !important;
}
.our-products-area .nav-tabs .btn:hover {
    border-color: #e3d2b8 !important;
}
.our-products-area .nav-tabs .btn.is-checked {
    background: #d4b886 !important;
    border-color: #d4b886 !important;
    color: #2b2b36 !important;
}

/* Card Design */
.our-products-area .single-product {
    background: #353744 !important;
    border-radius: 12px !important;
    padding: 15px !important;
    border: none !important;
    margin-bottom: 30px !important;
}

/* Card image box */
.our-products-area .single-product .product-img {
    background: #ffffff !important;
    border-radius: 8px !important;
    padding: 15px !important;
    position: relative !important;
    overflow: hidden !important; /* Important for the hover effect */
}
.our-products-area .single-product .product-img img {
    width: 100% !important;
    height: auto !important;
    object-fit: cover !important;
}

/* Content */
.our-products-area .single-product .product-content {
    text-align: center !important;
    margin-top: 15px !important;
}
.our-products-area .single-product .product-content h3 a {
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 700 !important;
}
.our-products-area .single-product .product-price {
    margin-top: 5px !important;
    text-align: center !important;
}
.our-products-area .single-product .product-price span {
    color: #ffffff !important;
    font-weight: bold !important;
    font-size: 14px !important;
}
.our-products-area .single-product .product-price del {
    color: #999999 !important;
    font-size: 13px !important;
    margin-left: 5px !important;
}

/* 
 * WE DO NOT OVERRIDE .button-head OR .product-action 
 * WE LET THE ORIGINAL THEME CSS HANDLE THE HOVER EFFECT!
 */
</style>
CSS;

$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);
$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Restored original button styles.";
