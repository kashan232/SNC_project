<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// 1. Bring back the dots
$dots = '
<ol class="carousel-indicators">
    @foreach($banners as $key=>$banner)
    <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? \'active\' : \'\')}}"></li>
    @endforeach
</ol>
';
$c = str_replace('<!-- <ol class="carousel-indicators"> removed for cleaner bottom wave look -->', ltrim($dots), $c);

// 2. Remove the arrows
// We can use regex to hide the prev/next controls
$c = preg_replace('/<a class="carousel-control-prev".*?<\/a>/is', '<!-- Previous Arrow Removed -->', $c);
$c = preg_replace('/<a class="carousel-control-next".*?<\/a>/is', '<!-- Next Arrow Removed -->', $c);

// 3. Optional: Move the dots slightly up so they don't overlap the wave too badly
// Let's add CSS for `.carousel-indicators` to increase bottom spacing
$c = preg_replace('/(#Gslider \.carousel-indicators\s*{\s*bottom:\s*)30px(;)/', '${1}55px${2}', $c);


file_put_contents($f, $c);
echo "Swapped arrows for dots.\n";
?>
