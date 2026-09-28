<?php
$f = 'app/Http/Controllers/CartController.php';
$c = file_get_contents($f);

// Update addToCart method to handle sizes gracefully
$old_addToCart = "    public function addToCart(Request \$request){
        // dd(\$request->all());
        if (empty(\$request->slug)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }        
        \$product = Product::where('slug', \$request->slug)->first();
        // return \$product;
        if (empty(\$product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        \$already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', \$product->id)->first();
        // return \$already_cart;
        if(\$already_cart) {
            // dd(\$already_cart);
            \$already_cart->quantity = \$already_cart->quantity + 1;
            \$already_cart->amount = \$product->price+ \$already_cart->amount;
            // return \$already_cart->quantity;
            if (\$already_cart->product->stock < \$already_cart->quantity || \$already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            \$already_cart->save();
            
        }else{
            
            \$cart = new Cart;
            \$cart->user_id = auth()->user()->id;
            \$cart->product_id = \$product->id;
            \$cart->price = (\$product->price-(\$product->price*\$product->discount)/100);
            \$cart->quantity = 1;
            \$cart->amount=(\$product->price * 1);
            if (\$cart->product->stock < \$cart->quantity || \$cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return \$cart;
            \$cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();       
    }";

$new_addToCart = "    public function addToCart(Request \$request){
        if (empty(\$request->slug)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }        
        \$product = Product::where('slug', \$request->slug)->first();
        if (empty(\$product)) {
            request()->session()->flash('error','Invalid Products');
            return back();
        }

        \$default_size = null;
        \$unit_price = \$product->price;
        
        // If product has sizes, pick the first one and its specific price
        if(!empty(\$product->size)){
            \$sizes = array_filter(array_map('trim', explode(',', \$product->size)));
            if(count(\$sizes) > 0){
                \$default_size = \$sizes[0];
                if(!empty(\$product->size_prices)){
                    \$sizePrices = json_decode(\$product->size_prices, true);
                    if(is_array(\$sizePrices) && isset(\$sizePrices[\$default_size]) && \$sizePrices[\$default_size] !== \"\" && \$sizePrices[\$default_size] !== null){
                        \$unit_price = (float)\$sizePrices[\$default_size];
                    }
                }
            }
        }
        
        \$discounted_price = (\$unit_price - (\$unit_price * \$product->discount) / 100);

        \$already_cart = Cart::where('user_id', auth()->user()->id)
            ->where('order_id',null)
            ->where('product_id', \$product->id)
            ->where('size', \$default_size)
            ->first();

        if(\$already_cart) {
            \$already_cart->quantity = \$already_cart->quantity + 1;
            \$already_cart->amount = (\$discounted_price * \$already_cart->quantity);
            if (\$already_cart->product->stock < \$already_cart->quantity || \$already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            \$already_cart->save();
        }else{
            \$cart = new Cart;
            \$cart->user_id = auth()->user()->id;
            \$cart->product_id = \$product->id;
            \$cart->size = \$default_size;
            \$cart->price = \$discounted_price;
            \$cart->quantity = 1;
            \$cart->amount = \$discounted_price;
            if (\$cart->product->stock < \$cart->quantity || \$cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            \$cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();       
    }";

$c = str_replace($old_addToCart, $new_addToCart, $c);
file_put_contents($f, $c);
echo "Fixed GET addToCart method.";
?>
