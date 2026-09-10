<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);
$old = 'Shoukat<br><span style="color: #333; font-size: 14px;">Nimco Center</span>';
$new = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="max-height: 80px; margin-top: -10px;">';
$content = str_replace($old, $new, $content);
file_put_contents($file, $content);
echo "Header logo updated.\n";
