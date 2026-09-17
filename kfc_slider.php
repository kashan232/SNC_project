<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$new_cat = <<<'HTML'
<!-- Start Categories Section (Carousel) -->
<style>
    .kfc-category-section {
        padding: 60px 0;
        background: #f4f6f8;
    }
    
    .kfc-header-wrap {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 40px;
        padding: 0 15px;
    }

    .kfc-section-title h2 {
        font-weight: 900;
        font-size: 28px;
        text-transform: uppercase;
        color: #111;
        margin: 0 0 5px 0;
        letter-spacing: -0.5px;
    }

    .kfc-title-line {
        width: 60px;
        height: 3px;
        background: var(--primary-color);
    }

    .kfc-view-all {
        font-weight: 700;
        font-size: 14px;
        color: #111;
        text-transform: uppercase;
        text-decoration: none !important;
        position: relative;
        padding-bottom: 3px;
    }
    .kfc-view-all::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--primary-color);
    }

    .kfc-card-item {
        display: block;
        text-decoration: none !important;
        background: #fff;
        border-radius: 90px 90px 10px 40px;
        padding: 15px 15px 30px 15px;
        text-align: center;
        position: relative;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
        transition: transform 0.3s ease;
        margin: 10px 5px;
    }

    .kfc-card-item:hover {
        transform: translateY(-5px);
    }

    /* Small decorative dot at bottom right */
    .kfc-card-item::after {
        content: '';
        position: absolute;
        bottom: 12px;
        right: 12px;
        width: 12px;
        height: 12px;
        background: #f4f6f8;
        border-radius: 50%;
    }

    .kfc-img-box {
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        position: relative;
        border-radius: 50%;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .kfc-img-box img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.4s ease;
    }

    .kfc-card-item:hover .kfc-img-box img {
        transform: scale(1.08);
    }

    .kfc-cat-name {
        font-size: 14px;
        font-weight: 700;
        color: #222;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .kfc-name-line {
        width: 35px;
        height: 3px;
        background: var(--primary-color);
        margin: 8px auto 0;
    }

    /* KFC Slider Arrows */
    .kfc-slider .owl-nav div {
        background: var(--primary-color);
        color: #fff;
        width: 32px;
        height: 32px;
        line-height: 32px;
        text-align: center;
        border-radius: 50%;
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        font-size: 16px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .kfc-slider .owl-nav div:hover {
        background: #111;
    }
    .kfc-slider .owl-prev { left: -40px; }
    .kfc-slider .owl-next { right: -40px; }

    @media (max-width: 1200px) {
        .kfc-slider .owl-prev { left: -15px; }
        .kfc-slider .owl-next { right: -15px; }
    }
    @media (max-width: 768px) {
        .kfc-card-item {
            padding: 10px 10px 20px 10px;
        }
        .kfc-cat-name {
            font-size: 12px;
        }
        .kfc-slider .owl-prev { left: -10px; }
        .kfc-slider .owl-next { right: -10px; }
        .kfc-section-title h2 { font-size: 22px; }
    }

    /* Hero Banner Animations (Preserved) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08);
    }
</style>

<section class="kfc-category-section">
    <div class="container" style="position: relative;">
        
        <div class="kfc-header-wrap">
            <div class="kfc-section-title">
                <h2>EXPLORE MENU</h2>
                <div class="kfc-title-line"></div>
            </div>
            <a href="{{route('product-grids')}}" class="kfc-view-all">VIEW ALL</a>
        </div>

        <div class="kfc-slider owl-carousel owl-theme">
            @php
            $category_lists = DB::table('categories')->where('status','active')->where('is_parent',1)->get();
            @endphp
            @if($category_lists)
                @foreach($category_lists as $cat)
                    <a href="{{route('product-cat',$cat->slug)}}" class="kfc-card-item">
                        <div class="kfc-img-box">
                            @if($cat->photo)
                                <img src="{{$cat->photo}}" alt="{{$cat->title}}">
                            @else
                                <img src="https://placehold.co/200x200/f4f4f4/888888?text=Photo" alt="#">
                            @endif
                        </div>
                        <div class="kfc-cat-name">{{$cat->title}}</div>
                        <div class="kfc-name-line"></div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function(){
        $('.kfc-slider').owlCarousel({
            items: 6,
            autoplay: true,
            autoplayTimeout: 4000,
            smartSpeed: 500,
            autoplayHoverPause: true,
            loop: false,
            margin: 15,
            nav: true,
            dots: false,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: { items: 2, margin: 10 },
                576: { items: 3, margin: 10 },
                768: { items: 4 },
                992: { items: 5 },
                1200: { items: 6 }
            }
        });
    });
</script>
@endpush
<!-- End Categories Section -->
HTML;

$c = preg_replace('/<!-- Start Categories Section \(Carousel\) -->.*?<!-- End Categories Section -->/is', $new_cat, $c);
file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "KFC design applied.\n";
