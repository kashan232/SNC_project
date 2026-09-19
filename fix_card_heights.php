<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_to_add = "
/* Equal Height Cards Fix */
.most-popular .owl-stage {
    display: flex !important;
}
.most-popular .owl-item {
    display: flex !important;
    padding: 0 8px !important; /* Ensure padding is kept */
}
.most-popular .single-product.clean-card {
    width: 100% !important;
    height: auto !important;
    flex: 1 1 auto !important;
}
";

// Insert before </style> in the custom block
$c = preg_replace('/(\.most-popular \.clean-card \.product-img\s*\{)/', $css_to_add . "\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed card heights.";
