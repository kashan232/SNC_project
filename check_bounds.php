<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start1 = strpos($c, 'most-popular');
$start2 = strpos($c, 'our-products-area');
$end1 = strpos($c, '<!-- End Most Popular Area -->');
echo "most-popular starts at $start1\n";
echo "our-products-area starts at $start2\n";
echo "most-popular ends at $end1\n";
