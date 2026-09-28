<?php
$f = 'app/Http/Controllers/CartController.php';
$c = file_get_contents($f);

// We need to carefully remove the stray code block
// It starts with:
//         request()->session()->flash('success','Product successfully added to cart.'); 
//         return back();        
//     }     
// 
//         $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first(); 
//
// And ends right before:
//     public function cartDelete(Request $request){ 

$pattern = '/(request\(\)->session\(\)->flash\(\'success\',\'Product successfully added to cart\.\'\);\s*return back\(\);\s*\}\s*)(\s*\$already_cart = Cart::where.*?)(?=\s*public function cartDelete)/s';

$c = preg_replace($pattern, "$1", $c);

file_put_contents($f, $c);
echo "Syntax error fixed!\n";
?>
