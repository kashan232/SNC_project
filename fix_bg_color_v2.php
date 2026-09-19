<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = preg_replace('/(\.our-products-area\s*\{\s*background-color:\s*)#[0-9a-fA-F]+/s', '${1}#2b2b36', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Changed background color back to #2b2b36.";
