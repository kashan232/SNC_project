<?php
$f = 'resources/views/backend/message/show.blade.php';
$c = file_get_contents($f);
$c = str_replace('{{$message->message}}', '{!! $message->message !!}', $c);
file_put_contents($f, $c);

// Also let's update web.php
$f2 = 'routes/web.php';
$c2 = file_get_contents($f2);
$c2 = str_replace("Route::get('/complain', function() { return view('frontend.pages.complain'); })->name('complain');", 
"Route::get('/complain', function() { return view('frontend.pages.complain'); })->name('complain');\n    Route::post('/complain/submit', [\App\Http\Controllers\MessageController::class, 'submitComplain'])->name('complain.submit');", $c2);
file_put_contents($f2, $c2);

echo "Backend Message HTML escaping fixed and Route added.\n";
?>
