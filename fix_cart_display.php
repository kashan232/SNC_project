<?php
// Cart Page
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

$c = preg_replace(
    '/(<p class="product-name"><a href="[^"]+" target="_blank">\{\{\$cart->product\[\'title\'\]\}\}<\/a><\/p>)/i',
    '$1'."\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t@if(\$cart->size)\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p style=\"font-size: 12px; color: #777; margin-top: 5px;\">Size: <strong style=\"color: #333;\">{{ \$cart->size }}</strong></p>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t@endif",
    $c
);

file_put_contents($f, $c);
echo "Cart page updated to show sizes.";

// Header Cart Dropdown
$f2 = 'resources/views/frontend/layouts/header.blade.php';
$c2 = file_get_contents($f2);

$c2 = preg_replace(
    '/(<h4><a href="\{\{route\(\'product-detail\',\$data->product\[\'slug\'\]\)\}\}" target="_blank">\{\{\$data->product\[\'title\'\]\}\}<\/a><\/h4>)/i',
    '$1'."\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t@if(\$data->size)\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<p style=\"font-size: 11px; color: #888; margin-top: 2px; margin-bottom: 2px;\">Size: <strong>{{ \$data->size }}</strong></p>\n\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t@endif",
    $c2
);

file_put_contents($f2, $c2);
echo "Header updated to show sizes.";
?>
