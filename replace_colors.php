<?php
$dirs = ['resources/views/frontend', 'public/frontend/css'];
foreach($dirs as $dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach($files as $file) {
        if($file->isFile() && in_array($file->getExtension(), ['php', 'css'])) {
            $content = file_get_contents($file->getRealPath());
            $newContent = str_ireplace('#e62020', '#d35400', $content); // Burnt Orange
            $newContent = str_ireplace('#cc1818', '#a84300', $newContent); // Darker Orange/Brown for hovers
            
            // Also replace rgb values if any
            $newContent = str_ireplace('rgba(230, 32, 32,', 'rgba(211, 84, 0,', $newContent);
            $newContent = str_ireplace('rgba(230,32,32,', 'rgba(211,84,0,', $newContent);
            
            if ($content !== $newContent) {
                file_put_contents($file->getRealPath(), $newContent);
            }
        }
    }
}
echo "Colors updated to Nimco Brown/Orange!\n";
