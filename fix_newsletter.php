<?php
$file = 'resources/views/frontend/layouts/newsletter.blade.php';
$content = file_get_contents($file);

$content = str_replace('<section class="shop-newsletter section">', '<!-- <section class="shop-newsletter section">', $content);
$content = str_replace('</section>', '</section> -->', $content);

file_put_contents($file, $content);
echo "Newsletter section fully commented out.\n";
