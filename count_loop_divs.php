<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
preg_match_all('/@foreach\(\$product_lists as \$key=\>\$product\)(.*?)@endforeach/s', $c, $m);
// There are two loops with this: the product grid, and the modal grid!
// $m[1][0] is the product grid
$open = substr_count($m[1][0], '<div');
$close = substr_count($m[1][0], '</div');
echo "Product Grid Loop -> Open: $open, Close: $close\n";

if (isset($m[1][1])) {
    $open2 = substr_count($m[1][1], '<div');
    $close2 = substr_count($m[1][1], '</div');
    echo "Modal Loop -> Open: $open2, Close: $close2\n";
}
