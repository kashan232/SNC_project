<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$open = substr_count($c, '<div');
$close = substr_count($c, '</div');
echo "Open: $open, Close: $close\n";
