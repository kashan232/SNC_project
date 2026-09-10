<?php
$header = 'resources/views/frontend/layouts/header.blade.php';
$h_content = file_get_contents($header);
$h_old = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="max-height: 80px; margin-top: -10px;">';
$h_new = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 75px; height: 75px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 10px rgba(0,0,0,0.2); margin-top: -8px;">';
$h_content = str_replace($h_old, $h_new, $h_content);
file_put_contents($header, $h_content);

$footer = 'resources/views/frontend/layouts/footer.blade.php';
$f_content = file_get_contents($footer);
$f_old = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="max-width: 150px; border-radius: 8px;">';
$f_new = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 130px; height: 130px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 10px;">';
$f_content = str_replace($f_old, $f_new, $f_content);
file_put_contents($footer, $f_content);

echo "Logo shape updated to circle.\n";
