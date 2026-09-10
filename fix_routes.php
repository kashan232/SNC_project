<?php
$file = 'routes/web.php';
$content = file_get_contents($file);

$old = "Route::resource('/shipping', 'ShippingController');";
$new = "Route::resource('/shipping', 'ShippingController');\n        Route::resource('/outlet', 'App\Http\Controllers\OutletController');";

$content = str_replace($old, $new, $content);
file_put_contents($file, $content);
echo "Routes updated.\n";
