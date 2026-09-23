<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// Find and replace the specific negative margins
$c = str_replace('margin-top: -80px;', 'margin-top: 20px;', $c);
$c = str_replace('margin-top: -60px;', 'margin-top: 20px;', $c);

// Just to be absolutely sure, add a strong override at the very end
$override = '
    /* Fix top overlap */
    @media (min-width: 992px) {
        .product-page-sidebar, .col-lg-9, .shop-top-modern {
            margin-top: 20px !important;
        }
    }
';
$c = str_replace('</style>', $override . "\n</style>", $c);

file_put_contents($f, $c);
echo "Margins fixed!";
?>
