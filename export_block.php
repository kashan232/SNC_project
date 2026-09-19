<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium');

if ($start !== false && $end !== false) {
    $block = substr($c, $start, $end - $start);
    file_put_contents('c:/xampp/htdocs/SNC_project/our_products_block.txt', $block);
    echo "Exported block.";
}
