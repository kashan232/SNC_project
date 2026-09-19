<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium');
$block = substr($c, $start, $end - $start);
echo $block;
