<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$checkout_blade = $base_dir . 'resources/views/frontend/pages/checkout.blade.php';

$content = file_get_contents($checkout_blade);

$content = str_replace('{{\\$firstName}}', '{{$firstName}}', $content);
$content = str_replace('{{\\$lastName}}', '{{$lastName}}', $content);
$content = str_replace('{{\\$email}}', '{{$email}}', $content);

file_put_contents($checkout_blade, $content);
echo "Syntax error fixed.\n";
