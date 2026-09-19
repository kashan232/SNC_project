<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, '<div class="product-area most-popular section">');
$end = strpos($c, '<!-- End Most Popular Area -->');

if ($start !== false && $end !== false) {
    $block = substr($c, $start, $end - $start);
    echo "Opening: " . substr_count($block, '<div') . "\n";
    echo "Closing: " . substr_count($block, '</div') . "\n";
} else {
    echo "Not found";
}
