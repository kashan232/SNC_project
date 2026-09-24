<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Replace the inline style on the most-popular section
$oldTag = '<div class="product-area most-popular section" style="background:#c1540b;">';
$newTag = '<div class="product-area most-popular section" style="background-color: #d35400; background-image: url(\'{{ asset("frontend/img/leaves-pattern.jpg") }}\'); background-blend-mode: overlay; background-size: 400px; background-repeat: repeat;">';

$c = str_replace($oldTag, $newTag, $c);

// Also add a fallback if the exact string wasn't matched due to formatting
// Let's use preg_replace just in case
if (strpos($c, $newTag) === false) {
    $c = preg_replace('/<div class="product-area most-popular section" style="background:#c1540b;">/', $newTag, $c);
}

file_put_contents($f, $c);
echo "Featured Products background updated!";
?>
