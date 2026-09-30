<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// In my previous replacement: 
// $c = str_replace('<div class="col-6 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item', '<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item', $c);
// I might have unintentionally affected other elements?
// But Explore Menu cards don't have 'isotope-item'.
// Wait, looking back at a previous log, the explore menu wrapper was:
// <div class="col-6 col-md-4 col-lg-3 col-xl-2 mb-4">
// Let's search for "col-12 col-md-4 col-lg-3 col-xl-2" in case I replaced "col-6" globally.

preg_match_all('/<div class="col-12[^>]*>.*?explore-card/is', $c, $matches);
foreach($matches[0] as $m) {
    echo "MATCH FOUND:\n" . substr($m, 0, 150) . "\n\n";
}
?>
