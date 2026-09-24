<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Remove data-aos="fade-up" from Our Outlets title
$c = str_replace('<div class="section-title" data-aos="fade-up">', '<div class="section-title">', $c);

// Remove data-aos from Outlets boxes
// The boxes have something like: <div class="premium-store-box" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
$c = preg_replace('/data-aos="fade-up" data-aos-delay="\{\{.*?\}\}"/', '', $c);

// Remove data-aos from Final Banner
$c = str_replace('<div class="col-12 text-center" data-aos="fade-up">', '<div class="col-12 text-center">', $c);

file_put_contents($f, $c);
echo "AOS animations removed from Outlets and Banner!";
?>
