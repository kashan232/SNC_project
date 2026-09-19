<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$start = strpos($c, 'our-products-area');
$end = strpos($c, 'id="our-outlets-premium"');

if ($start !== false && $end !== false) {
    // We want to replace all button-heads within the entire file just to be sure
    // Actually, no, let's just do it for the whole file. It won't hurt other cards because they also have flexbox / same structure!
    // But let's restrict it to the start and end to be safe.
    $before = substr($c, 0, $start);
    $block = substr($c, $start, $end - $start);
    $after = substr($c, $end);
    
    $pattern = '/(\<div class="button-head"\>.*?\<div class="product-action d-flex justify-content-center align-items-center w-100"\>.*?\<\/div\>\s*\<\/div\>)\s*(\<\/div\>)\s*(\<div class="product-content"\>.*?\<\/div\>)/s';
    $replacement = '$2' . "\n" . '$3' . "\n" . '$1';
    
    $new_block = preg_replace($pattern, $replacement, $block);
    
    $c = $before . $new_block . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Replaced via regex successfully.";
} else {
    echo "Could not find boundaries. start=$start, end=$end";
}
