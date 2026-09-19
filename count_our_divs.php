<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, 'our-products-area');
$end = strpos($c, 'our-outlets-premium');

if ($start !== false && $end !== false) {
    $block = substr($c, $start, $end - $start);
    echo "Opening: " . substr_count($block, '<div') . "\n";
    echo "Closing: " . substr_count($block, '</div') . "\n";
} else {
    echo "Not found";
}
