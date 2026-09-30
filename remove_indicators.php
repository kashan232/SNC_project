<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// We want to hide or remove the carousel-indicators.
// The easiest way is to wrap it in a PHP comment or just delete it.
// Let's use regex to remove it.
$pattern = '/<ol class="carousel-indicators">.*?<\/ol>/is';
$replacement = '<!-- <ol class="carousel-indicators"> removed for cleaner bottom wave look -->';

$c = preg_replace($pattern, $replacement, $c);

file_put_contents($f, $c);
echo "Indicators removed.\n";
?>
