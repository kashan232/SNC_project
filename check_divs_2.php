<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header_backup.blade.php');
echo "Backup div: " . substr_count($c, '<div') . "\n";
echo "Backup /div: " . substr_count($c, '</div') . "\n";
$c2 = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
echo "Current div: " . substr_count($c2, '<div') . "\n";
echo "Current /div: " . substr_count($c2, '</div') . "\n";
