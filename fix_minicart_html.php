<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

// Wrap h4 and p.quantity in a div for flexbox to work correctly
// Cart dropdown
$c = preg_replace('/(<h4><a.*?<\/a><\/h4>\s*<p class="quantity">.*?<\/p>)/s', '<div class="cart-item-content" style="flex: 1; padding-left: 10px;">$1</div>', $c);

// Also let's fix the CSS a bit to ensure it looks perfect
$c = str_replace('.shopping-list li .cart-img {', '.shopping-list li .cart-img { position: relative; margin-left: 5px; margin-right: 0;', $c);
$c = str_replace('.shopping-list li .remove {', '.shopping-list li .remove { position: relative; top: auto; left: auto;', $c);

// Ensure the item content takes the remaining space
$c = str_replace('</style>', '.cart-item-content h4 { margin-bottom: 3px !important; } .cart-item-content p { margin: 0; }</style>', $c);

file_put_contents($f, $c);
echo "HTML wrapped and CSS adjusted for mini cart!";
?>
