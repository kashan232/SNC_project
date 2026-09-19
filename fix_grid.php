<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Ensure .isotope-grid has .row class
$c = str_replace('<div class="tab-content isotope-grid" id="myTabContent" style="position: relative;">', '<div class="tab-content isotope-grid row" id="myTabContent" style="position: relative;">', $c);
$c = str_replace('<div class="tab-content isotope-grid" id="myTabContent">', '<div class="tab-content isotope-grid row" id="myTabContent" style="position: relative;">', $c);

// Change $(window).on('load') to $(document).ready() for Isotope
$c = preg_replace('/\$\(window\)\.on\(\'load\',\s*function\(\)\s*\{(\s*var \$grid = \$topeContainer\.each\()/is', "$(document).ready(function() {\n$1", $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Fixed Grid and Isotope init.\n";
