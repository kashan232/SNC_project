<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

// Change the fix-live-issues route to DELETE the symlink instead of recreating it!
$newLogic = '
        // Remove the symlink because cPanel Apache throws 500 error on symlinks!
        $publicDir = base_path(\'public_html\');
        if (!is_dir($publicDir)) {
            $publicDir = public_path();
        }
        $link = $publicDir . \'/storage\';
        
        if (file_exists($link) || is_link($link)) {
            @unlink($link); // Just delete it!
        }
        // Do NOT recreate the symlink! Our fallback route will handle the requests.
';

$c = preg_replace('/\$publicDir = base_path\(\'public_html\'\);.*?@symlink\(\$target, \$link\);/s', trim($newLogic), $c);

file_put_contents($f, $c);
echo "Symlink logic removed to fix 500 error.\n";
?>
