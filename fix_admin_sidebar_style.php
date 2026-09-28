<?php
$f = 'resources/views/backend/layouts/sidebar.blade.php';
$c = file_get_contents($f);

// Replace background color from #000 to primary color
$c = str_replace('style="background-color: #000;"', 'style="background-color: var(--primary-color, #F7941D);"', $c);

// Replace the logo
$old_logo = '<img src="{{ asset(\'backend/img/logo.png\') }}"';
$new_logo = '<img src="{{ asset(\'images/footer_logo.jpg\') }}"';
$c = str_replace($old_logo, $new_logo, $c);

// Also adjust logo style so it looks good
$old_style = 'style="height:30px; width:auto;"';
$new_style = 'style="height:50px; width:50px; border-radius:50%; object-fit:cover; border:2px solid #fff;"';
$c = str_replace($old_style, $new_style, $c);

file_put_contents($f, $c);
echo "Admin sidebar style and logo updated.\n";
?>
