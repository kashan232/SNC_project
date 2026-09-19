<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_css = <<<'CSS'
<style>
/* === OUR PRODUCTS DARK/GOLD DESIGN === */
/* Main Section Background */
.product-area {
    background-color: #2b2b36 !important;
    padding: 80px 0 !important;
}

/* Titles */
.product-area .section-title {
    margin-bottom: 40px !important;
}
.product-area .section-title span {
    color: #a49175 !important; /* Muted gold */
    font-size: 13px !important;
    letter-spacing: 2px !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
}
.product-area .section-title h2 {
    color: #e3d2b8 !important; /* Light gold */
    font-family: 'Playfair Display', serif !important;
    font-size: 42px !important;
    font-weight: 500 !important;
    margin-top: 5px !important;
}
.product-area .section-title h2 span {
    color: #e3d2b8 !important;
}
.product-area .section-title::after {
    content: '';
    display: block;
    width: 50px;
    height: 2px;
    background: #a49175;
    margin: 15px auto 0;
}

/* Tabs (Filters) */
.product-area .nav-tabs {
    border-bottom: none !important;
    justify-content: center !important;
    margin-bottom: 40px !important;
}
.product-area .nav-tabs .btn {
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
.product-area .nav-tabs .btn:hover {
    border-color: #e3d2b8 !important;
}
.product-area .nav-tabs .btn.is-checked {
    background: #d4b886 !important;
    border-color: #d4b886 !important;
    color: #2b2b36 !important;
}

/* Card Design */
.product-area .single-product {
    background: #353744 !important;
    border-radius: 12px !important;
    padding: 15px !important;
    height: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    box-shadow: none !important;
    transition: transform 0.3s ease !important;
    border: none !important;
    position: relative !important;
}
.product-area .single-product:hover {
    transform: translateY(-5px) !important;
}

/* Image Box */
.product-area .single-product .product-img {
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
.product-area .single-product .product-img img {
    max-height: 100% !important;
    width: auto !important;
    object-fit: contain !important;
}
.product-area .single-product .product-img .out-of-stock,
.product-area .single-product .product-img .new,
.product-area .single-product .product-img .hot,
.product-area .single-product .product-img .price-dec {
    display: none !important; /* Hide badges to keep it clean */
}

/* Content */
.product-area .single-product .product-content {
    text-align: left !important;
    margin-top: 0 !important;
    padding: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    flex-grow: 1 !important;
}
.product-area .single-product .product-content h3 {
    margin-bottom: 5px !important;
}
.product-area .single-product .product-content h3 a {
    color: #ffffff !important;
    font-family: 'Poppins', sans-serif !important;
    font-size: 16px !important;
    font-weight: 700 !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
}
/* Fake small description text */
.product-area .single-product .product-content h3::after {
    content: 'Delicious and crunchy, perfectly roasted to give you the best taste.';
    display: block !important;
    color: #8c909e !important;
    font-size: 11px !important;
    font-weight: 400 !important;
    line-height: 1.4 !important;
    margin-top: 8px !important;
}
.product-area .single-product .product-content .product-price {
    margin-top: auto !important;
    margin-bottom: 20px !important;
    text-align: center !important;
}
.product-area .single-product .product-content .product-price span {
    color: #ffffff !important;
    font-size: 16px !important;
    font-weight: 700 !important;
}
.product-area .single-product .product-content .product-price del {
    color: #8c909e !important;
    font-size: 13px !important;
}

/* Buttons at bottom (button-head) */
/* We will move button-head below price */
.product-area .single-product .button-head {
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
.product-area .single-product .product-action {
    display: flex !important;
    justify-content: space-between !important;
    width: 100% !important;
    gap: 10px !important;
}
.product-area .single-product .product-action a {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    width: 50% !important;
    height: 40px !important;
    border-radius: 6px !important;
    color: #ffffff !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
    background: #464a59 !important; /* Dark grey for default/left */
}
.product-area .single-product .product-action a span {
    display: none !important; /* hide text */
}

/* Left button: Quick view */
.product-area .single-product .product-action a[title="Quick View"] {
    background: #464a59 !important;
}
.product-area .single-product .product-action a[title="Quick View"]:hover {
    background: #5b5f70 !important;
}

/* Right button: Add to cart */
.product-area .single-product .product-action a[title="Add to cart"] {
    background: #d4b886 !important; /* Gold */
}
.product-area .single-product .product-action a[title="Add to cart"]:hover {
    background: #bfa06b !important;
}

/* Wishlist Heart - absolute top right */
.product-area .single-product .product-action a[title="Wishlist"] {
    position: absolute !important;
    top: 10px !important;
    right: 10px !important;
    width: 30px !important;
    height: 30px !important;
    background: transparent !important;
    color: #e74c3c !important; /* Red heart */
    z-index: 10 !important;
}
.product-area .single-product .product-action a[title="Wishlist"] i {
    font-size: 18px !important;
}

/* Ensure equal heights using flex for Isotope (if possible) or just let them fitRows */
.isotope-item {
    display: flex !important;
}
.isotope-grid {
    display: flex !important;
    flex-wrap: wrap !important;
}
</style>
CSS;

$c = preg_replace('/(\<div class="product-area section"\>)/', $new_css . "\n$1", $c);
$c = preg_replace('/(\<div class="product-area[^"]*"\>)/', $new_css . "\n$1", $c);

// Update Section Title Texts
$old_title = '<span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display:block; margin-bottom: 10px;">Explore Collection</span>
                      <h2 style="font-family: \'Orbitron\', sans-serif; font-size: 36px; font-weight: 800; color: #111;">Our <span style="color: var(--primary-color);">Products</span></h2>';

$new_title = '<span style="color: #a49175; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 13px; display:block; margin-bottom: 10px;">FEATURED PRODUCTS</span>
                      <h2 style="font-family: \'Playfair Display\', serif; font-size: 42px; font-weight: 500; color: #e3d2b8;">Our Products</h2>';

$c = str_replace($old_title, $new_title, $c);

// Move the button-head to the bottom of the card, inside product-content
// Currently button-head is inside product-img
// We need to move it using PHP replace.

// Instead of complex HTML parsing, let's just make button-head position: relative and it will flow naturally if we just push it to the bottom.
// Wait, currently button-head is inside product-img, which has overflow hidden or padding? 
// No, in CSS above I did: .product-area .single-product .button-head { position: relative !important; ... } 
// But since it's inside product-img, it will appear INSIDE the white box!
// To fix this, we need to extract button-head and place it after product-price.

// Let's do a regex to move button-head
// Match: <div class="button-head">...</div>
// Match: <div class="product-content">...</div>
$c = preg_replace('/(<div class="button-head">.*?<\/div>\s*<\/div>\s*)(<div class="product-content">.*?<\/div>\s*)(<\/div>\s*<\/div>\s*<!-- End Single Tab -->|<\/div>\s*<\/div>\s*@endforeach)/is', '$2$1$3', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Updated Our Products section.";
