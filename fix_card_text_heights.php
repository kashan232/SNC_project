<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_to_add = "
/* Equal Height Text Fix */
.most-popular .clean-card .product-content h3 a {
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
    min-height: 45px !important;
}
";

$c = preg_replace('/(\.most-popular \.clean-card \.product-content h3 a\s*\{)/', $css_to_add . "\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed card text heights.";
