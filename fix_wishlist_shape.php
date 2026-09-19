<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css_fix = <<<CSS
    .quickview-content .add-to-cart .btn.min {
        height: 45px !important;
        width: 45px !important;
        padding: 0 !important;
        border-radius: 50% !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
CSS;

$c = str_replace(
    '/* Quantity input styling */',
    $css_fix . "\n    /* Quantity input styling */",
    $c
);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Wishlist button fixed!";
