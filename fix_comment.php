<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// Find "-->\n<section id="our-outlets">" or similar
$index = preg_replace('/-->\s*<section id="our-outlets">/', '<section id="our-outlets">', $index);
$index = preg_replace('/-->\s*<!-- Start Our Outlets Section -->/', '<!-- Start Our Outlets Section -->', $index);
$index = preg_replace('/-->\s*<style>\s*#our-outlets/', '<style>\n    #our-outlets', $index);

file_put_contents($index_path, $index);
echo "Stray comment removed.\n";
