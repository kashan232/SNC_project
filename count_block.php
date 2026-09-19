<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$lines = explode("\n", $c);
$block = implode("\n", array_slice($lines, 2650, 2748-2650));
$open = substr_count($block, '<div');
$close = substr_count($block, '</div');
echo "Open: $open, Close: $close\n";
