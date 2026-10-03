<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

// We want to remove the redundant <i class="fa fa-angle-down"></i> in the Categories link.
$pattern = '/Categories<\/span>\s*<i class="fa fa-angle-down"><\/i>/';
$replacement = 'Categories</span>';

$c = preg_replace($pattern, $replacement, $c);

file_put_contents($f, $c);
echo "Sidebar arrow fixed.\n";
?>
