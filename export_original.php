<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
$start = strpos($c, 'Explore Collection');
$block = substr($c, $start, 3000);
file_put_contents('c:/xampp/htdocs/SNC_project/our_products_block_original.txt', $block);
echo "Exported original block.";
