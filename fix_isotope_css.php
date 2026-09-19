<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Remove height 100% from single-product
$c = str_replace('height: 100% !important;', '/* height: 100% removed */', $c);

// Also remove display: flex from isotope-grid if it has row
$c = str_replace('<div class="tab-content isotope-grid row" id="myTabContent">', '<div class="tab-content isotope-grid" id="myTabContent" style="position: relative;">', $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed CSS issues that might break isotope.\n";
