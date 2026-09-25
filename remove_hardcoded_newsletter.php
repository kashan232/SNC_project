<?php
$f = 'resources/views/frontend/pages/checkout.blade.php';
$c = file_get_contents($f);

// Remove the hardcoded newsletter block
$c = preg_replace('/<!-- Start Shop Newsletter  -->.*?<!-- End Shop Newsletter -->/is', '', $c);
$c = preg_replace('/<section class="shop-newsletter section">.*?<\/section>/is', '', $c);

file_put_contents($f, $c);
echo "Hardcoded newsletter section removed!";
?>
