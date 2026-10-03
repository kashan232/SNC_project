<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

// We need to replace the symlink logic inside `fix-live-issues` route
$newLogic = '
        // Force symlink specifically for cPanel public_html vs local public
        $target = storage_path(\'app/public\');
        
        // Try public_html first (common on cPanel), then fallback to standard public_path
        $publicDir = base_path(\'public_html\');
        if (!is_dir($publicDir)) {
            $publicDir = public_path();
        }
        
        $link = $publicDir . \'/storage\';
        
        if (file_exists($link) || is_link($link)) {
            @unlink($link);
        }
        @symlink($target, $link);
        
        // Let\'s also fix the spaces in filenames issue for LFM if any, by ensuring LFM allows spaces or just renaming them?
        // Actually the issue is usually just the symlink is in the wrong place!
';

$c = preg_replace('/\$target = storage_path\(\'app\/public\'\);.*?@symlink\(\$target, \$link\);/s', trim($newLogic), $c);

file_put_contents($f, $c);
echo "Updated fix-live-issues to handle public_html symlinks.\n";
?>
