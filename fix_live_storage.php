<?php
$f = 'routes/web.php';
$c = file_get_contents($f);

// Better deletion logic to wipe out any physical storage folder/symlink
$newLogic = '
        // Remove the symlink or directory because cPanel Apache throws 500 error on it!
        $publicDir = base_path(\'public_html\');
        if (!is_dir($publicDir)) {
            $publicDir = public_path();
        }
        $link = $publicDir . \'/storage\';
        
        if (is_link($link)) {
            @unlink($link); 
        } elseif (is_dir($link)) {
            // Delete directory and contents if it was copied by mistake
            \Illuminate\Support\Facades\File::deleteDirectory($link);
        } elseif (file_exists($link)) {
            @unlink($link);
        }
        // Do NOT recreate the symlink! Our fallback route will handle the requests.
';

$c = preg_replace('/\/\/ Remove the symlink because cPanel.*?\/\/ Do NOT recreate the symlink! Our fallback route will handle the requests\./s', trim($newLogic), $c);

// Also let's review the fallback route.
// If the image was uploaded via LFM, it goes to `storage/app/public/...`
// Wait! What if the user is using `unisharp` LFM and LFM is configured to use `public` disk, but LFM creates it in `public/photos`?
// Let's check where the images ACTUALLY ARE.

file_put_contents($f, $c);
echo "Updated deletion logic.\n";
?>
