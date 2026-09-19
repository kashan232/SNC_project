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
    padding: 15px 15px 70px 15px !important; /* Added 70px bottom padding for absolute buttons */
    border: none !important;
    margin-bottom: 30px !important;
    position: relative !important; /* Required for absolute positioning of button-head */
}

/* Card image box */
.our-products-area .single-product .product-img {
    background: #ffffff !important;
    border-radius: 8px !important;
    padding: 15px !important;
    margin-bottom: 20px !important;
    height: 200px !important; /* Fixed height for image */
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
}
.our-products-area .single-product .product-img a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.our-products-area .single-product .product-img img {
    max-height: 100% !important;
    width: auto !important;
    max-width: 100% !important;
    object-fit: contain !important;
}
.our-products-area .single-product .product-img span.out-of-stock,
.our-products-area .single-product .product-img span.new,
.our-products-area .single-product .product-img span.hot,
.our-products-area .single-product .product-img span.price-dec {
    display: none !important; /* Hide badges */
}

/* Content */
.our-products-area .single-product .product-content {
    text-align: left !important;
}
.our-products-area .single-product .product-content h3 a {
    color: #ffffff !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
    min-height: 40px !important;
}
.our-products-area .single-product .product-price {
    margin-top: 10px !important;
    text-align: center !important;
}
.our-products-area .single-product .product-price span {
    color: #ffffff !important;
    font-weight: bold !important;
}

/* Buttons */
.our-products-area .single-product .button-head {
    background: transparent !important;
    opacity: 1 !important;
    visibility: visible !important;
    position: absolute !important; /* Move it to the bottom of the card */
    bottom: 15px !important;
    left: 15px !important;
    width: calc(100% - 30px) !important;
    margin-top: 0 !important;
    transform: none !important;
    z-index: 10 !important;
}
.our-products-area .single-product .product-action {
    display: flex !important;
    justify-content: space-between !important;
    width: 100% !important;
    gap: 10px !important;
    position: static !important;
}
.our-products-area .single-product .product-action a {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 50% !important;
    height: 40px !important;
    border-radius: 6px !important;
    color: #fff !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    text-decoration: none !important;
}
.our-products-area .single-product .product-action a i {
    display: none !important; /* Hide icons to show text, or keep them? The mockup had text "Quick View", "Add to Cart" but I don't want to change HTML, I'll show icons instead of text if text is not in HTML */
}
/* Wait, the mockup has buttons with NO text, just icons? Or text? 
   The user said "Add to cart e white karain" before. Let's just style the a tags nicely */
.our-products-area .single-product .product-action a span {
    display: block !important; /* Show text */
    font-size: 12px !important;
}
.our-products-area .single-product .product-action a i {
    display: none !important; /* Hide icon */
}

.our-products-area .single-product .product-action a[title="Quick View"] {
    background: #464a59 !important;
}
.our-products-area .single-product .product-action a[title="Add to cart"] {
    background: #d4b886 !important;
    color: #2b2b36 !important;
}

/* Wishlist Heart */
.our-products-area .single-product .product-action a[title="Wishlist"] {
    position: absolute !important;
    top: -270px !important; /* Move it way up into the white image box */
    right: 10px !important;
    background: transparent !important;
    width: 30px !important;
    height: 30px !important;
    color: #e74c3c !important;
    font-size: 20px !important;
}
.our-products-area .single-product .product-action a[title="Wishlist"] i {
    display: block !important; /* Show icon for wishlist */
}
.our-products-area .single-product .product-action a[title="Wishlist"] span {
    display: none !important; /* Hide text for wishlist */
}
</style>
CSS;

// Remove any existing OUR PRODUCTS DARK/GOLD DESIGN block to avoid duplicates
$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);

// Inject the new CSS block
$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Applied card fix.";
