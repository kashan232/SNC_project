<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);
$c = str_replace('<i class="ti-package"></i> Products', '<i class="ti-package"></i> Our Menu', $c);
$c = str_replace('">Products</a><span class="new">New</span>', '">Our Menu</a><span class="new">New</span>', $c);
file_put_contents($f, $c);
