<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);
preg_match('/<div class="row[^>]*>[\s]*?(?:<div[^>]*>[\s]*?<a href="[^"]*" class="explore-card".*?)<\/div>/is', $c, $m);
if ($m) {
    echo "Found Explore Menu block:\n";
    echo substr($m[0], 0, 500);
} else {
    // Try simpler
    preg_match('/class="explore-card"/is', $c, $m, PREG_OFFSET_CAPTURE);
    if ($m) {
        $pos = $m[0][1];
        echo "Found at offset $pos\n";
        echo substr($c, $pos - 200, 400);
    }
}
?>
