<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$c = str_replace('<div class="col-6 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item', '<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item', $c);

file_put_contents($f, $c);
echo "Fixed column layout on mobile.\n";
?>
