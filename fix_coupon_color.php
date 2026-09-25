<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// Replace the hardcoded green color with the dynamic theme color
$c = str_replace('#27ae60', 'var(--primary-color)', $c);

file_put_contents($f, $c);
echo "Coupon color updated to theme color!";
?>
