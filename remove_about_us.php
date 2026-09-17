<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
$c = preg_replace('/<li[^>]*><a href="\{\{route\(\'about-us\'\)\}\}"><i class="ti-info-alt"><\/i> About Us<\/a><\/li>/is', '', $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $c);
echo "Removed About Us\n";
