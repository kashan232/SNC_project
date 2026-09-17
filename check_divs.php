<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
echo "divs: " . substr_count($c, '<div') . "\n";
echo "/divs: " . substr_count($c, '</div') . "\n";
