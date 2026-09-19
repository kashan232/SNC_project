<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = str_replace('.our-products-area .isotope-grid {
    display: flex !important;
    flex-wrap: wrap !important;
}', '', $c);
$c = str_replace('.our-products-area .isotope-item {
    display: flex !important;
}', '', $c);

// Also remove display: flex and height: 100% from .single-product because it might interfere with absolute positioning height calculations
$c = preg_replace('/(\.our-products-area \.single-product\s*\{[^}]*)display:\s*flex\s*!important;/is', '$1', $c);
$c = preg_replace('/(\.our-products-area \.single-product\s*\{[^}]*)height:\s*100%\s*!important;/is', '$1', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Removed Isotope flex overrides that caused overlapping.";
