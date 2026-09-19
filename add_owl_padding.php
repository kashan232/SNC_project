<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_to_add = "
/* Add padding to carousel items so cards don't touch */
.most-popular .owl-carousel .owl-item {
    padding: 0 8px !important;
}
";

// Insert it right before </style> in my custom block, or just before the end of the style block.
// To be safe, just append it before </style> at the end of the file or after .clean-card
$c = preg_replace('/(\.most-popular \.clean-card \.product-img\s*\{)/', $css_to_add . "\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added padding to owl-item.";
