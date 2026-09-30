<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);
preg_match('/class="explore-card"/is', $c, $m, PREG_OFFSET_CAPTURE);
if ($m) {
    $pos = $m[0][1];
    echo substr($c, $pos - 1000, 1100);
}
?>
