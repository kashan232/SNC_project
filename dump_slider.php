<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match('/<!-- Slider Area -->.*?<!--\/ End Slider Area -->/is', $c, $m);
file_put_contents('c:/xampp/htdocs/SNC_project/dump_slider.txt', $m[0] ?? 'Not found');
echo "Dumped\n";
