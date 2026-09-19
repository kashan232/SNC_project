<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Remove the old CSS block completely
$c = preg_replace('/\/\* === OUR PRODUCTS DARK\/GOLD DESIGN === \*\/(.*?)\<\/style\>/is', '', $c);

// Inject a new, ultra-safe CSS block that only changes colors, not layout
$css = <<<'CSS'
<style>
/* === OUR PRODUCTS DARK/GOLD DESIGN === */
/* Background and spacing */
.our-products-area {
    background-color: #2b2b36 !important;
    padding: 80px 0 !important;
}

/* Typography and Colors */
.our-products-area .section-title span {
    color: #a49175 !important;
}
.our-products-area .section-title h2 {
    color: #e3d2b8 !important;
}
.our-products-area .section-title h2 span {
    color: #e3d2b8 !important;
}

/* Tabs */
.our-products-area .nav-tabs .btn {
    background: transparent !important;
    border: 1px solid #5a5c66 !important;
    color: #e3d2b8 !important;
    border-radius: 30px !important;
}
.our-products-area .nav-tabs .btn.is-checked {
    background: #d4b886 !important;
    border-color: #d4b886 !important;
    color: #2b2b36 !important;
}

/* Product Cards */
.our-products-area .single-product {
    background: #353744 !important;
    border-radius: 12px !important;
    padding: 15px !important;
    border: none !important;
}
.our-products-area .product-content h3 a {
    color: #ffffff !important;
}
.our-products-area .product-price span {
    color: #ffffff !important;
}

/* Button styles without breaking layout */
.our-products-area .product-action a {
    background: #464a59 !important;
    color: #fff !important;
    border-radius: 6px !important;
}
.our-products-area .product-action a[title="Add to cart"] {
    background: #d4b886 !important;
}
</style>
CSS;

$c = preg_replace('/@endsection/i', $css . "\n@endsection", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Applied only color CSS to fix overlap.";
