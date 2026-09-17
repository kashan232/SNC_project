<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match_all('/<!-- Start Categories Section \(Carousel\) -->.*?<!-- End Categories Section -->/is', $c, $m);
file_put_contents('c:/xampp/htdocs/SNC_project/cat_section_dump.txt', $m[0][0] ?? 'Not found');
echo "Dumped\n";
