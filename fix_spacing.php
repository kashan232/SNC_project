<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Replace paddings with consistent 50px
$content = preg_replace('/padding:\s*\d+px 0;/', 'padding: 50px 0;', $content);

file_put_contents($file, $content);
echo "Paddings adjusted to 50px 0.\n";