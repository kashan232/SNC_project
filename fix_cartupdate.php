<?php
$f = 'app/Http/Controllers/CartController.php';
$c = file_get_contents($f);

$old_cartUpdate = "                    if (\$cart->product->stock <=0) continue;
                    \$after_price=(\$cart->product->price-(\$cart->product->price*\$cart->product->discount)/100);
                    \$cart->amount = \$after_price * \$quant;
                    // return \$cart->price;
                    \$cart->save();";

$new_cartUpdate = "                    if (\$cart->product->stock <=0) continue;
                    // Use the existing unit price saved in the cart item which already accounts for size and discount
                    \$cart->amount = \$cart->price * \$quant;
                    \$cart->save();";

$c = str_replace($old_cartUpdate, $new_cartUpdate, $c);
file_put_contents($f, $c);
echo "Fixed cartUpdate price recalculation.";
?>
