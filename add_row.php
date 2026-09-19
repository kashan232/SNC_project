<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$c = str_replace('<div class="tab-content isotope-grid" id="myTabContent">', '<div class="tab-content isotope-grid row" id="myTabContent">', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Added row to isotope grid.\n";
