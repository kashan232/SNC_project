<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// Remove Return Policy Area
$index = preg_replace('/<!-- Start Return Policy Area -->.*?<!-- End Return Policy Area -->/s', '', $index);

// Remove FAQs Area
$index = preg_replace('/<!-- Start FAQs Area -->.*?<!-- End FAQs Area -->/s', '', $index);

file_put_contents($index_path, $index);
echo "Removed FAQ and Returns sections.\n";
