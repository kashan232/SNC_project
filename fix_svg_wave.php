<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// Update the wave fill color so it blends with the new body background
$c = str_replace('fill="#f8f9fa"', 'fill="#eff2f6"', $c);

file_put_contents($f, $c);
echo "Wave SVG color updated!";
?>
