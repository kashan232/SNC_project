<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$oldTag = '<div class="product-area section" style="background: #c1540b;">';
$newTag = '<div class="product-area section" style="background-color: #d35400; background-image: url(\'{{ asset("frontend/img/leaves-pattern.jpg") }}\'); background-blend-mode: overlay; background-size: 400px; background-repeat: repeat;">';

$c = str_replace($oldTag, $newTag, $c);

file_put_contents($f, $c);
echo "Our Products background updated!";
?>
