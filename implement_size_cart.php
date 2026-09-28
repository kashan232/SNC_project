<?php
// 1. Create Migration for carts table
$migrationCmd = "php artisan make:migration add_size_to_carts_table --table=carts";
shell_exec($migrationCmd);

// Find the newly created migration file
$files = glob('database/migrations/*_add_size_to_carts_table.php');
if (!empty($files)) {
    $migrationFile = $files[0];
    $migrationContent = file_get_contents($migrationFile);
    $migrationContent = str_replace(
        'Schema::table(\'carts\', function (Blueprint $table) {
            //
        });',
        'Schema::table(\'carts\', function (Blueprint $table) {
            $table->string(\'size\')->nullable()->after(\'product_id\');
        });',
        $migrationContent
    );
    $migrationContent = str_replace(
        'Schema::table(\'carts\', function (Blueprint $table) {
            //
        });',
        'Schema::table(\'carts\', function (Blueprint $table) {
            $table->dropColumn(\'size\');
        });',
        $migrationContent
    );
    file_put_contents($migrationFile, $migrationContent);
    echo "Migration created and updated.\n";
}

// Run migration
shell_exec('php artisan migrate');
echo "Migrated carts.\n";

// 2. Update Cart Model
$cartModelFile = 'app/Models/Cart.php';
$cartModelContent = file_get_contents($cartModelFile);
$cartModelContent = str_replace(
    "protected \$fillable = ['user_id', 'product_id', 'order_id', 'quantity', 'amount', 'price', 'status'];",
    "protected \$fillable = ['user_id', 'product_id', 'order_id', 'quantity', 'amount', 'price', 'status', 'size'];",
    $cartModelContent
);
file_put_contents($cartModelFile, $cartModelContent);
echo "Cart model updated.\n";


// 3. Update CartController (singleAddToCart & addToCart)
$controllerFile = 'app/Http/Controllers/CartController.php';
$controllerContent = file_get_contents($controllerFile);

// For addToCart (home page quick add), we'll use default price. 
// For singleAddToCart (product detail), we must handle sizes.
// We will replace the whole singleAddToCart method for safety.
$singleAddToCartNew = '
    public function singleAddToCart(Request $request){
        $request->validate([
            \'slug\'      =>  \'required\',
            \'quant\'      =>  \'required\',
        ]);
        
        $product = Product::where(\'slug\', $request->slug)->first();
        if($product->stock < $request->quant[1]){
            return back()->with(\'error\',\'Out of stock, You can add other products.\');
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash(\'error\',\'Invalid Products\');
            return back();
        }    

        $selected_size = $request->input(\'size\');
        
        // Find existing cart item matching product AND size
        $already_cart = Cart::where(\'user_id\', auth()->user()->id)
            ->where(\'order_id\',null)
            ->where(\'product_id\', $product->id)
            ->where(\'size\', $selected_size)
            ->first();

        // Calculate specific price
        $unit_price = $product->price;
        if($selected_size && $product->size_prices) {
            $sizePrices = json_decode($product->size_prices, true);
            if(is_array($sizePrices) && isset($sizePrices[$selected_size]) && $sizePrices[$selected_size] !== "" && $sizePrices[$selected_size] !== null) {
                $unit_price = (float)$sizePrices[$selected_size];
            }
        }
        
        // Apply discount to unit price
        $discounted_price = ($unit_price - ($unit_price * $product->discount) / 100);

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            $already_cart->amount = ($discounted_price * $already_cart->quantity);

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with(\'error\',\'Stock not sufficient!.\');

            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->size = $selected_size;
            $cart->price = $discounted_price;
            $cart->quantity = $request->quant[1];
            $cart->amount = ($discounted_price * $request->quant[1]);
            
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with(\'error\',\'Stock not sufficient!.\');
            $cart->save();
        }
        request()->session()->flash(\'success\',\'Product successfully added to cart.\');
        return back();       
    } 
';

$controllerContent = preg_replace('/public function singleAddToCart.*?return back\(\);\s*\}/is', trim($singleAddToCartNew), $controllerContent);
file_put_contents($controllerFile, $controllerContent);
echo "CartController updated.\n";


// 4. Update Product Detail Frontend
$frontendFile = 'resources/views/frontend/pages/product_detail.blade.php';
$frontendContent = file_get_contents($frontendFile);

// Add size_prices to window object so JS can use it
$frontendContent = str_replace(
    "@php \$sizes=explode(',',$product_detail->size); @endphp",
    "@php \$sizes=explode(',',$product_detail->size); \$sizePricesJson = \$product_detail->size_prices ? \$product_detail->size_prices : '{}'; @endphp\n<script>window.productSizePrices = {!! \$sizePricesJson !!}; window.baseProductPrice = {{ \$product_detail->price }}; window.productDiscount = {{ \$product_detail->discount }};</script>",
    $frontendContent
);

// Add hidden input to the form
$frontendContent = preg_replace(
    '/<form action="\{\{route\(\'single-add-to-cart\'\)\}\}" method="POST" class="mb-4">\s*@csrf\s*<input type="hidden" name="slug" value="\{\{\$product_detail->slug\}\}">/i',
    '<form action="{{route(\'single-add-to-cart\')}}" method="POST" class="mb-4">
        @csrf
        <input type="hidden" name="slug" value="{{$product_detail->slug}}">
        <input type="hidden" name="size" id="selectedSizeInput" value="">',
    $frontendContent
);

// Automatically set the first size as selected on page load (in the form)
$frontendContent = str_replace(
    '<button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this)">{{$size}}</button>',
    '<button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this, \'{{$size}}\')">{{$size}}</button>',
    $frontendContent
);

// Update selectSncSize JS function to update price and hidden input
$jsUpdate = "
    function selectSncSize(element, sizeName) {
        $('.snc-size-btn').removeClass('active btn-dark').addClass('btn-outline-dark');
        $(element).addClass('active btn-dark').removeClass('btn-outline-dark');
        
        $('#selectedSizeInput').val(sizeName);

        // Update the displayed price
        let unitPrice = window.baseProductPrice;
        if(window.productSizePrices[sizeName] !== undefined && window.productSizePrices[sizeName] !== null && window.productSizePrices[sizeName] !== \"\") {
            unitPrice = parseFloat(window.productSizePrices[sizeName]);
        }
        
        let discount = window.productDiscount || 0;
        let finalPrice = unitPrice - (unitPrice * discount / 100);
        
        $('.current-price').html('Rs:' + finalPrice.toFixed(2));
        if(discount > 0) {
            $('.old-price del').html('Rs:' + unitPrice.toFixed(2));
            $('.product-des .short .price .discount').html('Rs:' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('Rs:' + unitPrice.toFixed(2));
        } else {
            $('.old-price del').html('');
            $('.product-des .short .price .discount').html('Rs:' + finalPrice.toFixed(2));
            $('.product-des .short .price s').html('');
        }
    }

    $(document).ready(function() {
        // Set the initial hidden input value to the active button
        let activeSize = $('.snc-size-btn.active').text().trim();
        if(activeSize) {
            selectSncSize($('.snc-size-btn.active')[0], activeSize);
        }
    });
";

$frontendContent = preg_replace('/function selectSncSize\(element\) \{.*?\}/is', $jsUpdate, $frontendContent);
file_put_contents($frontendFile, $frontendContent);
echo "Frontend product detail updated.\n";

?>
