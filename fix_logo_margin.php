<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);

$old_img = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2); margin-top: -8px;">';
$new_img = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">';

$content = str_replace($old_img, $new_img, $content);
file_put_contents($file, $content);
echo "Image margin removed for proper centering.\n";
