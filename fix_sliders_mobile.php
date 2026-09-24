<?php
// 1. Fix Explore Slider in index.blade.php
$f1 = 'resources/views/frontend/index.blade.php';
$c1 = file_get_contents($f1);
// Change "0: { items: 2, margin: 10 }," to "0: { items: 1, margin: 10 },"
$c1 = preg_replace('/0:\s*\{\s*items:\s*2,\s*margin:\s*10\s*\}/', '0: { items: 1, margin: 10 }', $c1);
// Ensure up to 575px it's 1 item, so we can also inject a 480 breakpoint
$c1 = preg_replace('/0:\s*\{\s*items:\s*1,\s*margin:\s*10\s*\}/', "0: { items: 1, margin: 10 },\n                  480: { items: 1, margin: 10 }", $c1);
file_put_contents($f1, $c1);

// 2. Fix Popular Slider in active.js
$f2 = 'public/frontend/js/active.js';
$c2 = file_get_contents($f2);
// Find 480: { items: 2 } under .popular-slider and change to items: 1
// It's safer to just str_replace if we know the structure, but regex is better.
$c2 = preg_replace('/(480:\s*\{\s*items:)\s*2(\s*,?\s*\})/', '$1 1$2', $c2);
file_put_contents($f2, $c2);

echo "Sliders fixed to show 1 item on mobile!";
?>
