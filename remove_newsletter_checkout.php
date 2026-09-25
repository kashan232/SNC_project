<?php
$f = 'resources/views/frontend/pages/checkout.blade.php';
$c = file_get_contents($f);

// Remove the newsletter include
$c = preg_replace('/<!-- Start Shop Newsletter  -->\s*@include\(\'frontend\.layouts\.newsletter\'\)\s*<!-- End Shop Newsletter -->/is', '', $c);
$c = preg_replace('/@include\(\'frontend\.layouts\.newsletter\'\)/is', '', $c);

file_put_contents($f, $c);
echo "Newsletter section removed from checkout page!";
?>
