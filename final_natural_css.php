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

/* Card Design - Pure & Simple */
.our-products-area .single-product {
    background: #353744 !important;
    border-radius: 12px !important;
    padding: 15px !important; /* Back to normal padding, NO fixed bottom space needed! */
    border: none !important;
    margin-bottom: 30px !important;
    position: relative !important; /* Anchor for heart */
}

/* Card image box */
.our-products-area .single-product .product-img {
    background: #ffffff !important;
    border-radius: 12px !important;
    padding: 15px !important;
    margin-bottom: 20px !important;
    position: relative !important; 
    display: block !important;
}
.our-products-area .single-product .product-img img {
    width: 100% !important;
    height: auto !important;
    object-fit: cover !important;
}
.our-products-area .single-product .product-img span.out-of-stock,
.our-products-area .single-product .product-img span.new,
.our-products-area .single-product .product-img span.hot,
.our-products-area .single-product .product-img span.price-dec {
    display: none !important;
}

/* Content (Title & Price & future description) */
.our-products-area .single-product .product-content {
    text-align: center !important;
    margin-bottom: 0px !important;
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
    font-size: 15px !important;
}
.our-products-area .single-product .product-price del {
    color: #999999 !important;
    font-size: 13px !important;
    margin-left: 5px !important;
}

/* Buttons Area (Now naturally in DOM flow) */
.our-products-area .single-product .button-head {
    background: transparent !important;
    opacity: 1 !important;
    visibility: visible !important;
    position: static !important; /* Normal document flow! */
    width: 100% !important;
    height: 45px !important;
    margin: 15px 0 0 0 !important; /* Give 15px space above buttons */
    transform: none !important;
}
.our-products-area .single-product .product-action {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    width: 100% !important;
    height: 100% !important;
    gap: 15px !important;
    position: static !important;
}

/* Bottom Buttons (Quick View & Add to Cart) */
.our-products-area .single-product .product-action a[title="Quick View"],
.our-products-area .single-product .product-action a[title="Add to cart"] {
    width: 50% !important;
    height: 100% !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s ease !important;
    text-decoration: none !important;
}
.our-products-area .single-product .product-action a span {
    display: none !important; /* Hide text */
}
.our-products-area .single-product .product-action a i {
    display: inline-block !important;
    font-size: 18px !important;
}

/* Button Colors */
.our-products-area .single-product .product-action a[title="Quick View"] {
    background: #464a59 !important; /* Dark Grey */
    color: #ffffff !important;
}
.our-products-area .single-product .product-action a[title="Quick View"]:hover {
    background: #565a6b !important;
}

.our-products-area .single-product .product-action a[title="Add to cart"] {
    background: #b59063 !important; /* Gold/Tan */
    color: #ffffff !important;
}
.our-products-area .single-product .product-action a[title="Add to cart"]:hover {
    background: #c6a275 !important;
}

/* Wishlist Heart - Floating Top Right */
.our-products-area .single-product .product-action a[title="Wishlist"] {
    position: absolute !important; /* Break out of flow */
    top: 25px !important;
    right: 25px !important;
    background: transparent !important;
    color: #e74c3c !important; /* Red heart */
    width: 30px !important;
    height: 30px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    text-decoration: none !important;
    z-index: 100 !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"] i {
    font-size: 20px !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"]:hover {
    background: rgba(231, 76, 60, 0.1) !important;
}

</style>
CSS;

$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);
$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Final natural DOM flow CSS updated with margin-top.";
