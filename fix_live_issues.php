<?php

// 1. Add Route in web.php
$f = 'routes/web.php';
$c = file_get_contents($f);

$route = '
    // FIX FILE MANAGER & LIVE URLS ROUTE
    Route::get(\'fix-live-issues\', function () {
        // Update APP_URL in .env
        $envFile = base_path(\'.env\');
        if (file_exists($envFile)) {
            $url = request()->getSchemeAndHttpHost();
            $env = file_get_contents($envFile);
            $env = preg_replace(\'/^APP_URL=(.*)$/m\', \'APP_URL=\'.$url, $env);
            file_put_contents($envFile, $env);
        }
        
        // Force symlink
        $target = storage_path(\'app/public\');
        $link = public_path(\'storage\');
        
        if (file_exists($link)) {
            @unlink($link);
        }
        @symlink($target, $link);
        
        // Clear caches
        \Illuminate\Support\Facades\Artisan::call(\'optimize:clear\');
        
        request()->session()->flash(\'success\', \'Live Server Issues Fixed! (APP_URL updated, Caches cleared, Symlink restored)\');
        return redirect()->back();
    })->name(\'fix.live.issues\');
';

if (!strpos($c, 'fix-live-issues')) {
    $c = str_replace("Route::get('storage-link',", $route . "\n    Route::get('storage-link',", $c);
    file_put_contents($f, $c);
}

// 2. Add button in Header
$h = 'resources/views/backend/layouts/header.blade.php';
$hc = file_get_contents($h);
$btn = '
      <a href="{{route(\'fix.live.issues\')}}"  class="btn btn-outline-success btn-sm mr-3" data-toggle="tooltip" title="Click this if images are broken in File Manager">
        Fix Live Images
      </a>
';
if (!strpos($hc, 'fix.live.issues')) {
    $hc = str_replace('<a href="{{route(\'storage.link\')}}"', $btn . "\n      <a href=\"{{route('storage.link')}}\"", $hc);
    file_put_contents($h, $hc);
}

echo "Added Fix Live Issues button.\n";

?>
