<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

// Better fallback route that catches errors and sets a default mime type
$fallback = '
// FALLBACK ROUTE FOR STORAGE IMAGES (Solves cPanel symlink issues)
Route::get(\'storage/{path}\', function ($path) {
    $path = urldecode($path);
    $fullPath = storage_path(\'app/public/\' . $path);
    if (file_exists($fullPath)) {
        try {
            $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
            $mimes = [
                \'jpg\' => \'image/jpeg\', \'jpeg\' => \'image/jpeg\',
                \'png\' => \'image/png\', \'gif\' => \'image/gif\', 
                \'svg\' => \'image/svg+xml\', \'webp\' => \'image/webp\'
            ];
            $mime = $mimes[strtolower($ext)] ?? \'application/octet-stream\';
            
            return response()->file($fullPath, [
                \'Content-Type\' => $mime,
                \'Cache-Control\' => \'public, max-age=31536000\'
            ]);
        } catch (\Exception $e) {
            // If anything fails (like fileinfo), just return the raw file content manually
            return response(file_get_contents($fullPath), 200)
                   ->header(\'Content-Type\', \'image/jpeg\'); // Safe default for LFM
        }
    }
    abort(404);
})->where(\'path\', \'.*\');
';

$c = preg_replace('/\/\/ FALLBACK ROUTE FOR STORAGE IMAGES.*?->where\(\'path\', \'.*?\'\);/s', trim($fallback), $c);
file_put_contents($f, $c);
echo "Updated fallback route to handle fileinfo exceptions.\n";
?>
