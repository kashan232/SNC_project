<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

// Let's modify the fallback route to explicitly urldecode just in case, and add headers so browser caches the image.
$newFallback = '
// FALLBACK ROUTE FOR STORAGE IMAGES (Solves cPanel symlink issues)
Route::get(\'storage/{path}\', function ($path) {
    $path = urldecode($path);
    $fullPath = storage_path(\'app/public/\' . $path);
    if (file_exists($fullPath)) {
        $mime = \Illuminate\Support\Facades\File::mimeType($fullPath);
        return response()->file($fullPath, [
            \'Content-Type\' => $mime,
            \'Cache-Control\' => \'public, max-age=31536000\'
        ]);
    }
    abort(404);
})->where(\'path\', \'.*\');
';

$c = preg_replace('/\/\/ FALLBACK ROUTE FOR STORAGE IMAGES.*?->where\(\'path\', \'.*?\'\);/s', trim($newFallback), $c);
file_put_contents($f, $c);
echo "Updated fallback route.\n";
?>
