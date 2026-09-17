<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/routes/web.php');
if (strpos($c, "Route::get('/complain'") === false) {
    $c = str_replace(
        "Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');",
        "Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');\n    Route::get('/complain', function() { return view('frontend.pages.complain'); })->name('complain');",
        $c
    );
    file_put_contents('c:/xampp/htdocs/SNC_project/routes/web.php', $c);
    echo "Added /complain route\n";
} else {
    echo "Route already exists\n";
}

$header = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');
$header = str_replace("{{route('contact')}}", "{{route('complain')}}", $header);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $header);
echo "Updated header to point to complain route\n";
