<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, 'class="product-area section our-products-area"');
$end = strpos($c, 'id="our-outlets-premium"');
if ($start !== false && $end !== false) {
    $block = substr($c, $start, $end - $start);
    $card_start = strpos($block, '<div class="single-product"');
    $card_end = strpos($block, '</div>', $card_start);
    // Find the end of single-product
    $open = 1;
    $pos = $card_start + 20;
    while ($open > 0 && $pos < strlen($block)) {
        $next_open = strpos($block, '<div', $pos);
        $next_close = strpos($block, '</div', $pos);
        
        if ($next_open !== false && $next_open < $next_close) {
            $open++;
            $pos = $next_open + 4;
        } else if ($next_close !== false) {
            $open--;
            $pos = $next_close + 5;
        } else {
            break;
        }
    }
    echo substr($block, $card_start, $pos - $card_start + 1);
}
