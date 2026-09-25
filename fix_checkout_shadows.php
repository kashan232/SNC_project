<?php
$f = 'resources/views/frontend/pages/checkout.blade.php';
$c = file_get_contents($f);

// We will update the CSS block to strengthen shadows and enforce #fff text on primary colors
$c = str_replace('box-shadow: 0 5px 25px rgba(0,0,0,0.03);', 'box-shadow: 0 8px 30px rgba(0,0,0,0.1); border: none;', $c);
$c = str_replace('box-shadow: 0 4px 15px rgba(0,0,0,0.1);', 'box-shadow: 0 6px 20px rgba(0,0,0,0.15);', $c);

// Force text white on headings
$c = str_replace('color: #fff;', 'color: #fff !important;', $c);

// Let's specifically target the headings inside order details
$c = str_replace('background: var(--primary-color);', 'background: var(--primary-color) !important; color: #fff !important;', $c);

file_put_contents($f, $c);
echo "Checkout shadows and white text on orange fixed!";
?>
