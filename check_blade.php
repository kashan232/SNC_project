<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
$ifs = substr_count($c, '@if');
$endifs = substr_count($c, '@endif');
$auths = substr_count($c, '@auth');
$endauths = substr_count($c, '@endauth');
$fore = substr_count($c, '@foreach');
$endfore = substr_count($c, '@endforeach');
echo "if: $ifs, endif: $endifs\nauth: $auths, endauth: $endauths\nforeach: $fore, endforeach: $endfore\n";
