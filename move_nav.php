<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);

// Remove the old 'Our Outlets' I added
$content = str_replace('<li><a href="/#our-outlets">Our Outlets</a></li>', '', $content);

// Add 'Our Stores' after FAQs
$content = str_replace(
    '<li><a href="{{route(\'home\')}}#faq">FAQs</a></li>',
    '<li><a href="{{route(\'home\')}}#faq">FAQs</a></li>'."\n".'                                            <li><a href="{{route(\'home\')}}#our-outlets">Our Stores</a></li>',
    $content
);

file_put_contents($file, $content);
echo "Header updated.\n";
