<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, '<!-- Start Product Area -->');
$end = strpos($c, '<!-- End Product Area -->');
$block = substr($c, $start, $end - $start);

$pattern = '/(\<div class="single-product"[^\>]*\>.*?\<div class="product-img"\>.*?\<\/a\>\s*)(\<div class="button-head"\>.*?\<\/div\>\s*\<\/div\>\s*)(\<\/div\>\s*)(\<div class="product-content"\>.*?\<\/div\>\s*\<\/div\>\s*)/is';

preg_match_all($pattern, $block, $matches);
echo "Matches found: " . count($matches[0]);
