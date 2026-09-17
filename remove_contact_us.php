<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// Remove Contact Area
$index = preg_replace('/<!-- Start Contact Area -->.*?<!-- End Contact Area -->/s', '', $index);
file_put_contents($index_path, $index);

$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

// Remove Contact Us link
$header = preg_replace('/<li[^>]*>\s*<a href="[^"]*contact"[^>]*>Contact Us<\/a>\s*<\/li>/i', '', $header);
file_put_contents($header_path, $header);

echo "Removed Contact Us section and nav link.\n";
