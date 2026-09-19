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
    box-shadow: none !important;
    transition: transform 0.3s ease !important;
    border: none !important;
    position: relative !important;
    display: block !important; /* CRITICAL: Must be block for Isotope */
    height: auto !important; /* CRITICAL: Must be auto for Isotope */
}
.our-products-area .single-product:hover {
    transform: translateY(-5px) !important;
}

/* Image Box */
.our-products-area .single-product .product-img {
    background: #ffffff !important;
    border-radius: 8px !important;
    padding: 15px !important;
    position: relative !important;
    overflow: hidden !important;
    height: 200px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 20px !important;
}
.our-products-area .single-product .product-img img {
    max-height: 100% !important;
    width: auto !important;
    object-fit: contain !important;
}
.our-products-area .single-product .product-img .out-of-stock,
.our-products-area .single-product .product-img .new,
.our-products-area .single-product .product-img .hot,
.our-products-area .single-product .product-img .price-dec {
    display: none !important;
}

/* Content */
.our-products-area .single-product .product-content {
    text-align: left !important;
    margin-top: 0 !important;
    padding: 0 !important;
    display: block !important;
}
.our-products-area .single-product .product-content h3 {
    margin-bottom: 5px !important;
}
.our-products-area .single-product .product-content h3 a {
    color: #ffffff !important;
    font-family: 'Poppins', sans-serif !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
    min-height: 45px !important;
}
/* Fake small description text */
.our-products-area .single-product .product-content h3::after {
    content: 'Delicious and crunchy, perfectly roasted to give you the best taste.';
    display: block !important;
    color: #8c909e !important;
    font-size: 11px !important;
    font-weight: 400 !important;
    line-height: 1.4 !important;
    margin-top: 8px !important;
}
.our-products-area .single-product .product-content .product-price {
    margin-top: 15px !important;
    margin-bottom: 20px !important;
    text-align: center !important;
}
.our-products-area .single-product .product-content .product-price span {
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 700 !important;
}
.our-products-area .single-product .product-content .product-price del {
    color: #8c909e !important;
    font-size: 13px !important;
}

/* Buttons at bottom (button-head) */
.our-products-area .single-product .button-head {
    position: relative !important;
    opacity: 1 !important;
    visibility: visible !important;
    background: transparent !important;
    bottom: 0 !important;
    left: 0 !important;
    width: 100% !important;
    margin-top: 15px !important;
    transform: none !important;
}
.our-products-area .single-product .product-action {
    display: flex !important;
    justify-content: space-between !important;
    width: 100% !important;
    gap: 10px !important;
}
.our-products-area .single-product .product-action a {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    width: 50% !important;
    height: 40px !important;
    border-radius: 6px !important;
    color: #ffffff !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
    background: #464a59 !important; /* Dark grey */
}
.our-products-area .single-product .product-action a span {
    display: none !important; /* hide text */
}

/* Left button: Quick view */
.our-products-area .single-product .product-action a[title="Quick View"] {
    background: #464a59 !important;
}
.our-products-area .single-product .product-action a[title="Quick View"]:hover {
    background: #5b5f70 !important;
}

/* Right button: Add to cart */
.our-products-area .single-product .product-action a[title="Add to cart"] {
    background: #d4b886 !important; /* Gold */
}
.our-products-area .single-product .product-action a[title="Add to cart"]:hover {
    background: #bfa06b !important;
}

/* Wishlist Heart - absolute top right */
.our-products-area .single-product .product-action a[title="Wishlist"] {
    position: absolute !important;
    top: 10px !important;
    right: 10px !important;
    width: 30px !important;
    height: 30px !important;
    background: transparent !important;
    color: #e74c3c !important; /* Red heart */
    z-index: 10 !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"] i {
    font-size: 18px !important;
}
</style>
CSS;

$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);
$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed card collapse issue.";
