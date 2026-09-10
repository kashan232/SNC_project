<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Remove Shop Services (Why Choose Us, Returns, etc)
$content = preg_replace('/<!-- Start Shop Services Area -->.*?<!-- End Shop Services Area -->/s', '', $content);

// Remove Midium Banner (Featured Items)
$content = preg_replace('/<!-- Start Midium Banner  -->.*?<!-- End Midium Banner -->/s', '', $content);

// Remove About Us Section (often confused with Contact Us on homepage)
$content = preg_replace('/<!-- Start About Us Section -->.*?<!-- End About Us Section -->/s', '', $content);

// Remove Shop Newsletter
$content = preg_replace('/<!-- Start Shop Newsletter  -->.*?<!-- End Shop Newsletter -->/s', '', $content);

file_put_contents($file, $content);
echo "Sections removed successfully.";
