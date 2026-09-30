<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

// Fix Left Logo (Desktop)
$old_logo_left = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">';
$new_logo_left = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; min-width: 75px; min-height: 75px; flex-shrink: 0; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">';
$c = str_replace($old_logo_left, $new_logo_left, $c);

// Fix Center Logo (Mobile)
$old_logo_center = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">';
$new_logo_center = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; min-width: 75px; min-height: 75px; flex-shrink: 0; display: block; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">';
$c = str_replace($old_logo_center, $new_logo_center, $c);

file_put_contents($f, $c);
echo "Fixed responsive logo in header.\n";
?>
