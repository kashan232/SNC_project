<?php
$f = 'resources/views/frontend/pages/product_detail.blade.php';
$c = file_get_contents($f);

// Find the duplicate and replace it
$pattern = '/<input type="hidden" name="size" id="selectedSizeInput" value="">\s*<input type="hidden" name="size" id="selectedSizeInput" value="">/';
$c = preg_replace($pattern, '<input type="hidden" name="size" id="selectedSizeInput" value="">', $c);

file_put_contents($f, $c);
echo "Fixed duplicate hidden inputs.";
?>
