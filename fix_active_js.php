<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$active_js_path = $base_dir . 'public/frontend/js/active.js';
$active = file_get_contents($active_js_path);

// Replace loop:true with loop:false for quickview-slider-active
$old = <<<'JS'
		$('.quickview-slider-active').owlCarousel({
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			autoplayHoverPause:true,
			nav:true,
			loop:true,
JS;
$new = <<<'JS'
		$('.quickview-slider-active').owlCarousel({
			items:1,
			autoplay:true,
			autoplayTimeout:5000,
			smartSpeed: 400,
			autoplayHoverPause:true,
			nav:true,
			loop:false,
JS;

if (strpos($active, "loop:true") !== false) {
    $active = str_replace($old, $new, $active);
    file_put_contents($active_js_path, $active);
    echo "Fixed active.js clone loop.\n";
} else {
    echo "Could not find loop:true block in active.js\n";
}

// Ensure the colors.js error is totally gone from SW cache
$sw_path = $base_dir . 'public/sw.js';
if(file_exists($sw_path)) {
    $sw = file_get_contents($sw_path);
    // Sometimes it's wrapped in double quotes
    $sw = preg_replace('/[\'"]\/frontend\/js\/colors\.js[\'"],?/', '', $sw);
    // Also remove empty lines or stray commas just in case
    file_put_contents($sw_path, $sw);
    echo "Cleaned sw.js\n";
}
