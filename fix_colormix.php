<?php
$dirs = ['resources/views/frontend', 'public/frontend/css'];
foreach($dirs as $dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach($files as $file) {
        if($file->isFile() && in_array($file->getExtension(), ['php', 'css'])) {
            $original = file_get_contents($file->getRealPath());
            $c = $original;
            
            // Fix the broken color-mix syntax
            $c = preg_replace_callback('/color-mix\(in srgb, var\(--primary-color\)\s*([0-9\.]+)\)/', function($m) {
                $percent = floatval($m[1]) * 100;
                return "color-mix(in srgb, var(--primary-color) {$percent}%, transparent)";
            }, $c);
            
            // Fix the second gradient color in auth pages (rgba 180, 15, 15, 0.9)
            $c = str_replace('rgba(180, 15, 15, 0.9)', 'color-mix(in srgb, var(--hover-color) 90%, transparent)', $c);
            
            if ($c !== $original) {
                file_put_contents($file->getRealPath(), $c);
            }
        }
    }
}
echo "color-mix syntax fixed globally.\n";
