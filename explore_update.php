<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// New HTML/CSS block
$newBlock = '<!-- Start Categories Section (Carousel) -->
<style>
/* EXPLORE MENU DESIGN */
.explore-menu-section {
    padding: 80px 0;
    background-color: #fbf9f6;
    font-family: \'Poppins\', sans-serif;
}

.explore-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 40px;
}

.explore-subtitle {
    font-size: 13px;
    font-weight: 700;
    color: #F7941D;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 5px;
}

.explore-subtitle .line {
    width: 40px;
    height: 2px;
    background-color: #F7941D;
    display: inline-block;
}

.explore-title {
    font-size: 42px;
    font-weight: 900;
    color: #222;
    margin: 0 0 10px 0;
    line-height: 1.2;
}

.explore-title .text-orange {
    color: #F7941D;
}

.explore-desc {
    font-size: 14px;
    color: #777;
    margin: 0;
    line-height: 1.6;
}

.explore-view-all {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 25px;
    border: 1px solid #ddd;
    border-radius: 30px;
    color: #333;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
    background: #fff;
}
.explore-view-all:hover {
    background: #F7941D;
    border-color: #F7941D;
    color: #fff;
}

/* CARD */
.explore-card {
    background: #fff;
    border-radius: 24px;
    padding: 20px;
    display: block;
    text-decoration: none !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    transition: all 0.3s ease;
    margin: 15px 5px;
    position: relative;
    overflow: hidden;
}

.explore-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
}

.explore-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 100%; /* square aspect ratio */
    margin-bottom: 20px;
}

.explore-blob {
    position: absolute;
    top: 10%;
    left: 10%;
    right: 10%;
    bottom: 10%;
    border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
    z-index: 1;
    transition: all 0.5s ease;
}
.explore-card:hover .explore-blob {
    border-radius: 50%;
}

.explore-img-wrap img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 90% !important;
    max-height: 90% !important;
    object-fit: contain;
    z-index: 2;
    transition: transform 0.4s ease;
}
.explore-card:hover .explore-img-wrap img {
    transform: translate(-50%, -50%) scale(1.08);
}

.explore-info h3 {
    font-size: 18px;
    font-weight: 800;
    color: #222;
    margin: 0 0 15px 0;
    text-align: left;
}

.explore-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.explore-btn {
    width: 32px;
    height: 32px;
    background: #F7941D;
    color: #fff;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
}

.explore-leaf {
    color: #f0f0f0;
    font-size: 24px;
    line-height: 1;
}

/* OWL NAV */
.explore-menu-section .owl-carousel {
    position: relative;
}
.explore-menu-section .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    transform: translateY(-50%);
    left: 0;
    pointer-events: none;
    margin: 0;
}
.explore-menu-section .owl-prev,
.explore-menu-section .owl-next {
    position: absolute !important;
    width: 45px !important;
    height: 45px !important;
    background: #fff !important;
    color: #333 !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
    pointer-events: auto;
    font-size: 18px !important;
    line-height: 1 !important;
    transition: all 0.3s ease !important;
    margin: 0 !important;
    border: 1px solid #eee !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
}
.explore-menu-section .owl-prev {
    left: -20px !important;
}
.explore-menu-section .owl-next {
    right: -20px !important;
}
.explore-menu-section .owl-prev:hover,
.explore-menu-section .owl-next:hover {
    background: #F7941D !important;
    color: #fff !important;
}

@media (max-width: 768px) {
    .explore-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }
    .explore-title {
        font-size: 32px;
    }
}
</style>
<section class="explore-menu-section">
    <div class="container" style="position: relative;">
        <!-- Header -->
        <div class="explore-header">
            <div class="explore-header-left">
                <div class="explore-subtitle">OUR DELICIOUS RANGE <span class="line"></span></div>
                <h2 class="explore-title">Explore <span class="text-orange">Menu</span></h2>
                <p class="explore-desc">Discover our wide variety of fresh and premium quality snacks,<br>made with the finest ingredients.</p>
            </div>
            <div class="explore-header-right">
                <a href="{{route(\'product-grids\')}}" class="explore-view-all">View All <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Carousel -->
        <div class="explore-slider owl-carousel owl-theme">
            @php
            $category_lists = DB::table(\'categories\')->where(\'status\',\'active\')->where(\'is_parent\',1)->get();
            $blob_colors = [\'#e8f4eb\', \'#fbe9dc\', \'#fdf2d5\', \'#fbe9dc\', \'#e8f4eb\', \'#f5eee6\', \'#e8f4eb\'];
            @endphp
            @if($category_lists)
                @foreach($category_lists as $cat)
                    @php 
                    $bcolor = $blob_colors[$loop->index % count($blob_colors)]; 
                    @endphp
                    <a href="{{route(\'product-cat\',$cat->slug)}}" class="explore-card">
                        <div class="explore-img-wrap">
                            <div class="explore-blob" style="background-color: {{$bcolor}};"></div>
                            @if($cat->photo)
                                <img src="{{$cat->photo}}" alt="{{$cat->title}}">
                            @else
                                <img src="https://placehold.co/200x200/f4f4f4/888888?text=Photo" alt="#">
                            @endif
                        </div>
                        <div class="explore-info">
                            <h3>{{$cat->title}}</h3>
                            <div class="explore-card-footer">
                                <span class="explore-btn"><i class="fa fa-arrow-right"></i></span>
                                <span class="explore-leaf"><i class="ti-leaf"></i></span>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>';

// Use Regex to replace everything from "<!-- Start Categories Section (Carousel) -->" to "</section>"
$c = preg_replace('/<!-- Start Categories Section \(Carousel\) -->.*?<\/section>/s', $newBlock, $c);

// Replace JS
$c = str_replace("$('.kfc-slider').owlCarousel({", "$('.explore-slider').owlCarousel({", $c);

file_put_contents($f, $c);
?>
