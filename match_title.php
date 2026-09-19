<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_old = <<<'CSS'
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
CSS;

$css_new = <<<'CSS'
/* Titles */
.our-products-area .section-title {
    margin-bottom: 50px !important;
}
.our-products-area .section-title span {
    color: #ffffff !important;
    font-size: 16px !important;
    letter-spacing: 3px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    opacity: 0.9 !important;
}
.our-products-area .section-title h2 {
    color: #ffffff !important;
    font-size: 50px !important;
    font-weight: 800 !important;
    margin-top: 0 !important;
    font-family: inherit !important; /* Use same font as Featured Products */
}
.our-products-area .section-title h2 span {
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 50px !important;
}
CSS;

if (strpos($c, "/* Titles */") !== false) {
    $c = preg_replace('/\/\* Titles \*\/(.*?)\.our-products-area \.section-title::after/is', $css_new . "\n.our-products-area .section-title::after", $c);
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Our Products title updated.";
} else {
    echo "Could not find CSS.";
}
