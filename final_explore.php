<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

$newBlock = '<!-- Start Categories Section (Carousel) -->
<style>
/* EXPLORE MENU DESIGN */
.explore-menu-section {
    padding: 80px 0;
    background-color: #fbf9f6 !important; /* Light grey/cream background */
    background-image: none !important; /* Remove food pattern */
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

/* CAROUSEL EQUAL HEIGHTS */
.explore-slider .owl-stage {
    display: flex;
    align-items: stretch;
}
.explore-slider .owl-item {
    display: flex;
}

/* CARD */
.explore-card {
    background: #fff;
    border-radius: 24px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    width: 100%;
    text-decoration: none !important;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    transition: all 0.4s ease;
    margin: 15px 5px;
    position: relative;
    overflow: hidden;
}

/* HOVER EFFECT AS REQUESTED */
.explore-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(247, 148, 29, 0.3);
    background: #F7941D;
}

/* IMAGE WRAPPER */
.explore-img-wrap {
    position: relative;
    width: 100%;
    padding-top: 100%; /* 1:1 Aspect Ratio */
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* THE ABSTRACT BLOB BACKGROUND */
.explore-blob {
    position: absolute;
    top: 5%;
    left: 5%;
    right: 5%;
    bottom: 5%;
    border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
    z-index: 1;
    transition: all 0.5s ease;
}

.explore-card:hover .explore-blob {
    background-color: #fff !important; /* Turn white on hover to contrast with orange card */
    border-radius: 50%; /* Become perfect circle on hover */
}

/* THE TRANSPARENT IMAGE */
.explore-img-wrap img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 85%;
    height: 85%;
    object-fit: contain;
    z-index: 2;
    transition: transform 0.5s ease;
}

.explore-card:hover .explore-img-wrap img {
    transform: translate(-50%, -50%) scale(1.15);
}

/* TEXT AND BUTTONS */
.explore-info {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
}

.explore-info h3 {
    font-size: 17px;
    font-weight: 800;
    color: #222;
    margin: 0 0 15px 0;
    text-align: left;
    line-height: 1.3;
    transition: color 0.4s ease;
}

.explore-card:hover .explore-info h3 {
    color: #fff;
}

.explore-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
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
    transition: all 0.3s ease;
}

.explore-card:hover .explore-btn {
    background: #fff;
    color: #F7941D;
    transform: scale(1.1);
}

.explore-leaf {
    color: #f0f0f0;
    font-size: 24px;
    line-height: 1;
    transition: color 0.3s ease;
}

.explore-card:hover .explore-leaf {
    color: rgba(255, 255, 255, 0.25);
}

/* OWL NAV (WHITE ARROWS ON EDGES) */
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
    border: none !important;
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

// Regex replace
$c = preg_replace('/<!-- Start Categories Section \(Carousel\) -->.*?<\/section>/s', $newBlock, $c);

file_put_contents($f, $c);
?>
