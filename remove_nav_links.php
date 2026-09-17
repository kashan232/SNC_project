<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

$header = str_replace('<li><a href="{{route(\'home\')}}#return-policy">Return Policy</a></li>', '', $header);
$header = str_replace('<li><a href="{{route(\'home\')}}#faq">FAQs</a></li>', '', $header);
// sometimes double quotes or slightly different formatting:
$header = preg_replace('/<li[^>]*>\s*<a href="[^"]*#return-policy"[^>]*>Return Policy<\/a>\s*<\/li>/i', '', $header);
$header = preg_replace('/<li[^>]*>\s*<a href="[^"]*#faq"[^>]*>FAQs<\/a>\s*<\/li>/i', '', $header);

file_put_contents($header_path, $header);
echo "Nav links removed.\n";
