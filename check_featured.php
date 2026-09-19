<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$lines = explode("\n", $c);
$block = implode("\n", array_slice($lines, 1570, 1622-1570));
$open = substr_count($block, '<div');
$close = substr_count($block, '</div');
echo "Featured Arrivals -> Open: $open, Close: $close\n";
