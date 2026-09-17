<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_slider = <<<'HTML'
<!-- Slider Area -->
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#Gslider" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="first-slide" src="{{asset('images/home_banner.jpg')}}" alt="Shoukat Nimco Banner" style="width: 100%; height: auto; object-fit: cover;">
            <!-- The uploaded banner already has text embedded, so we hide the caption -->
            <!-- <div class="carousel-caption text-left"> ... </div> -->
        </div>
    </div>
</section>
<!--/ End Slider Area -->
HTML;

$c = preg_replace('/<!-- Slider Area -->.*?<!--\/ End Slider Area -->/s', $new_slider, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Banner replaced.";
