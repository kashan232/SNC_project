<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match_all('/<!-- Start Product Area -->.*?<!-- End Product Area -->/is', $c, $m);
file_put_contents('c:/xampp/htdocs/SNC_project/product_area_dump.txt', $m[0][0] ?? 'Not found');
echo "Dumped\n";
