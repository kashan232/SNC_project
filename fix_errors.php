<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Fix colors.js 404 in footer
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);
$footer = str_replace('<script src="{{asset(\'frontend/js/colors.js\')}}"></script>', '', $footer);
file_put_contents($footer_path, $footer);

// 2. Fix colors.js in sw.js
$sw_path = $base_dir . 'public/sw.js';
if (file_exists($sw_path)) {
    $sw = file_get_contents($sw_path);
    $sw = str_replace("'/frontend/js/colors.js',", "", $sw);
    $sw = str_replace('"/frontend/js/colors.js",', "", $sw);
    file_put_contents($sw_path, $sw);
}

// 3. Fix Owl Carousel clone error.
// The error says: nicesellect.js:48:3005 Cannot read properties of undefined (reading 'clone')
// Wait, sometimes OwlCarousel throws clone errors when elements have `display: none` or don't exist.
// Let's just catch the error or ensure AOS doesn't hide the elements before OwlCarousel initializes.
// If AOS sets `opacity: 0` before OwlCarousel clones, it's fine, but if it sets `display: none`, Owl fails.
// Our AOS auto-apply script was running BEFORE owl-carousel initialized?
// Wait, active.js initializes owl-carousel on $(document).ready.
// Our AOS script runs on DOMContentLoaded.
// If AOS modifies DOM, OwlCarousel might break.
// Let's change our AOS script to run AFTER a slight delay, or just let OwlCarousel run first.

$footer = file_get_contents($footer_path);
$footer = str_replace(
    'document.addEventListener("DOMContentLoaded", function() {', 
    'window.addEventListener("load", function() { setTimeout(function() {', 
    $footer
);
$footer = str_replace(
    'AOS.refresh();
        }', 
    'AOS.refresh();
        } }, 500);', 
    $footer
);

file_put_contents($footer_path, $footer);

echo "Errors fixed.\n";
