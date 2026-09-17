<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header_backup.blade.php');

$ifs = substr_count($c, '@if');
$endifs = substr_count($c, '@endif');
$auths = substr_count($c, '@auth');
$endauths = substr_count($c, '@endauth');

echo "Backup if: $ifs, endif: $endifs\nBackup auth: $auths, endauth: $endauths\n";

$c2 = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
$ifs2 = substr_count($c2, '@if');
$endifs2 = substr_count($c2, '@endif');
$auths2 = substr_count($c2, '@auth');
$endauths2 = substr_count($c2, '@endauth');

echo "Current if: $ifs2, endif: $endifs2\nCurrent auth: $auths2, endauth: $endauths2\n";
