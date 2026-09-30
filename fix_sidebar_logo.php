<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

$old_sidebar = '.sidebar-logo {
            width: 50px; height: 50px; border-radius: 50%; object-fit: cover;
        }';
$new_sidebar = '.sidebar-logo {
            width: 50px; height: 50px; min-width: 50px; min-height: 50px; flex-shrink: 0; border-radius: 50%; object-fit: cover; display: block;
        }';
$c = str_replace($old_sidebar, $new_sidebar, $c);

file_put_contents($f, $c);
echo "Fixed responsive logo in mobile sidebar.\n";
?>
