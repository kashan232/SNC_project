<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

$fallback = '
// FALLBACK ROUTE FOR STORAGE IMAGES (Solves cPanel symlink issues)
Route::get(\'storage/{path}\', function ($path) {
    $fullPath = storage_path(\'app/public/\' . $path);
    if (file_exists($fullPath)) {
        return response()->file($fullPath);
    }
    abort(404);
})->where(\'path\', \'.*\');
';

if (!strpos($c, 'FALLBACK ROUTE FOR STORAGE IMAGES')) {
    $c .= "\n" . $fallback;
    file_put_contents($f, $c);
    echo "Fallback storage route added.\n";
} else {
    echo "Fallback already exists.\n";
}
?>
