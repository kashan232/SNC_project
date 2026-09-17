<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$dynamic_slider = <<<'HTML'
<!-- Slider Area -->
@if(count($banners)>0)
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($banners as $key=>$banner)
        <div class="carousel-item {{(($key==0)? 'active' : '')}}">
            <img class="first-slide" src="{{$banner->photo}}" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">
            <!-- Caption (optional, removed if you just use images) -->
        </div>
        @endforeach
    </div>
    
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev" style="width: 50px; background: rgba(0,0,0,0.2);">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next" style="width: 50px; background: rgba(0,0,0,0.2);">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif
<!--/ End Slider Area -->
HTML;

$c = preg_replace('/<!-- Slider Area -->.*?<!--\/ End Slider Area -->/s', $dynamic_slider, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Dynamic banner restored.\n";
