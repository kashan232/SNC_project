<?php
$f = 'resources/views/frontend/pages/cart.blade.php';
$c = file_get_contents($f);

// Remove the Shop Services Area
$c = preg_replace('/<!-- Start Shop Services Area  -->.*?<!-- End Shop Services Area -->/is', '', $c);
// Fallback if the End comment is different (e.g. End Shop Newsletter by mistake)
$c = preg_replace('/<!-- Start Shop Services Area  -->.*?<\/section>/is', '', $c);

file_put_contents($f, $c);
echo "Free shipping section removed!";
?>
