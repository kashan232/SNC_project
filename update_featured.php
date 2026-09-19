<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_css = <<<'CSS'
<style>
/* === NEW FEATURED ARRIVALS DESIGN === */
.most-popular.section {
    background-color: #3C424F !important; /* Dark blue-grey background */
    padding: 80px 0 !important;
}
.most-popular .section-title {
    margin-bottom: 50px !important;
}
.most-popular .section-title span {
    color: #A3ADB9 !important; /* Lighter grey for subtitle */
    font-size: 13px !important;
    letter-spacing: 2px !important;
}
.most-popular .section-title h2 {
    color: #EAE6DF !important; /* Creamy white for main title */
    font-family: 'Playfair Display', serif !important; /* Serif font as per design */
    font-size: 40px !important;
    font-weight: 500 !important;
    margin-top: 5px !important;
}
.most-popular .section-title h2 span {
    color: #EAE6DF !important;
}
.most-popular .section-title::after {
    content: '';
    display: block;
    width: 40px;
    height: 2px;
    background: #A98C66; /* Gold underline */
    margin: 15px auto 0;
}

/* CAROUSEL CARD DESIGN */
.most-popular .single-product.clean-card {
    background-color: #303540 !important; /* Slightly darker card background */
    border-radius: 12px !important;
    padding: 15px 15px 20px 15px !important;
    display: flex !important;
    flex-direction: column !important;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    border: none !important;
    margin: 10px 0 !important;
    height: 100% !important;
}

/* Image container */
.most-popular .clean-card .product-img {
    background-color: #fff !important;
    border-radius: 8px !important;
    padding: 20px !important;
    height: 220px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 20px !important;
}
.most-popular .clean-card .product-img img {
    max-height: 100% !important;
    width: auto !important;
    object-fit: contain !important;
}

/* Hide wishlist heart */
.most-popular .clean-card .clean-wishlist {
    display: none !important;
}

/* Content */
.most-popular .clean-card .product-content {
    text-align: left !important;
    padding: 0 !important;
    display: flex !important;
    flex-direction: column !important;
    flex-grow: 1 !important;
}
.most-popular .clean-card .product-content h3 {
    margin-bottom: 10px !important;
}
.most-popular .clean-card .product-content h3 a {
    color: #fff !important;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 700 !important;
    font-size: 15px !important;
}
.most-popular .clean-card .price-container {
    justify-content: flex-start !important;
    margin-bottom: 20px !important;
    margin-top: auto !important;
}
.most-popular .clean-card .price-container span {
    color: #D3B98E !important; /* Gold price */
    font-size: 14px !important;
}

/* Red Button */
.most-popular .clean-card .clean-add-cart {
    background-color: #E4002B !important; /* Theme Red */
    color: #fff !important;
    display: block !important;
    text-align: center !important;
    width: 100% !important;
    border-radius: 6px !important;
    padding: 10px 0 !important;
    font-family: 'Poppins', sans-serif !important;
    font-weight: 800 !important;
    font-size: 14px !important;
    letter-spacing: 1px !important;
    text-transform: uppercase !important;
    text-decoration: none !important;
    transition: 0.3s !important;
    position: relative !important;
}
.most-popular .clean-card .clean-add-cart:hover {
    background-color: #c00024 !important; /* Darker red */
    color: #fff !important;
}
.most-popular .clean-card .clean-add-cart i {
    display: none !important; /* Hide the plus icon */
}
.most-popular .clean-card .clean-add-cart::after {
    content: 'ADD TO CART';
}

/* Slider Nav overrides */
.most-popular .owl-carousel .owl-nav {
    position: absolute !important;
    top: 50% !important;
    width: 100% !important;
    transform: translateY(-50%) !important;
    margin: 0 !important;
    pointer-events: none !important;
}
.most-popular .owl-carousel .owl-nav div {
    background: #EAE6DF !important; /* Cream color */
    color: #3C424F !important;
    pointer-events: auto !important;
    width: 35px !important;
    height: 35px !important;
    position: absolute !important;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3) !important;
}
.most-popular .owl-carousel .owl-nav .owl-prev {
    left: -15px !important;
}
.most-popular .owl-carousel .owl-nav .owl-next {
    right: -15px !important;
}

@media (max-width: 768px) {
    .most-popular.section {
        padding: 40px 0 !important;
    }
    .most-popular .section-title h2 {
        font-size: 28px !important;
    }
    .most-popular .owl-carousel .owl-nav {
        display: none !important;
    }
}
</style>
CSS;

$c = str_replace('<!-- Start Most Popular -->', "<!-- Start Most Popular -->\n" . $new_css, $c);

// Also change the title text to match the design
$c = preg_replace('/<span.*?Top Picks<\/span>/is', '<span style="color: #A3ADB9; font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 12px;">FEATURED ARRIVALS</span>', $c);
$c = preg_replace('/<h2.*?Featured <span.*?>Products<\/span><\/h2>/is', '<h2 style="font-family: \'Playfair Display\', serif; font-size: 40px; font-weight: 500; color: #EAE6DF; margin-top: 10px;">Featured Arrivals</h2>', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Featured Products UI updated.\n";
