<?php
$f = 'resources/views/frontend/pages/product-grids.blade.php';
$c = file_get_contents($f);

// 1. Replace the HTML for the menu-hero-section
$oldHero = '<div class="menu-hero-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="bread-list-modern">
                        <li><a href="{{route(\'home\')}}">Home</a></li>
                        <li><span>/</span></li>
                        <li class="active">Our Menu</li>
                    </ul>
                    <h1 class="hero-title">EXPLORE <span class="text-primary">MENU</span></h1>
                </div>
            </div>
        </div>
    </div>';

$newHero = '<div class="menu-hero-section" style="background-color: #0b1d2e; background-image: linear-gradient(to right, #0b1d2e 0%, #0b1d2e 45%, rgba(11, 29, 46, 0.4) 100%), url(\'{{asset(\'frontend/img/explore-banner-bg.png\')}}\'); background-position: right center; background-size: cover; background-repeat: no-repeat; padding: 60px 0 100px 0; position: relative;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row">
                <div class="col-lg-7 col-md-9 col-12">
                    <ul class="bread-list-modern" style="display: flex; align-items: center; list-style: none; padding: 0; margin: 0 0 15px 0; font-size: 13px; color: #fff;">
                        <li><a href="{{route(\'home\')}}" style="color: #fff; text-decoration: none;">Home</a></li>
                        <li style="margin: 0 10px; color: #F7941D;"><i class="ti-angle-right" style="font-size: 10px;"></i></li>
                        <li class="active" style="color: #fff; font-weight: 600;">Our Menu</li>
                    </ul>
                    <h1 class="hero-title" style="font-size: 48px; font-weight: 900; color: #fff; margin-bottom: 15px; letter-spacing: 1px;">EXPLORE OUR <span style="color: #F7941D;">MENU</span></h1>
                    <p class="hero-subtitle" style="color: #e0e6ed; font-size: 15px; line-height: 1.6; font-weight: 400; max-width: 450px; margin-bottom: 0;">Premium quality Nimco, bakery items, and biscuits made with care and tradition.</p>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave SVG to match mockup exactly -->
        <div class="hero-wave" style="position: absolute; bottom: -2px; left: 0; width: 100%; overflow: hidden; line-height: 0; z-index: 1;">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="display: block; width: 100%; height: 70px;">
                <!-- Orange Outline Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="#F7941D" transform="translate(0, -6)"></path>
                <!-- White Fill Wave -->
                <path d="M0,60 C320,120 420,0 720,40 C1020,80 1120,-20 1440,60 L1440,120 L0,120 Z" fill="#f8f9fa"></path>
            </svg>
        </div>
    </div>';

$c = str_replace($oldHero, $newHero, $c);

// 2. Also inject a small override for mobile responsiveness of the hero section text
$cssOverride = '
    @media (max-width: 768px) {
        .menu-hero-section {
            padding: 40px 0 80px 0 !important;
            background-image: linear-gradient(to right, rgba(11, 29, 46, 0.9) 0%, rgba(11, 29, 46, 0.8) 100%), url(\'{{asset(\'frontend/img/explore-banner-bg.png\')}}\') !important;
        }
        .hero-title {
            font-size: 32px !important;
        }
        .hero-subtitle {
            font-size: 14px !important;
        }
        .hero-wave svg {
            height: 40px !important;
        }
    }
';
$c = str_replace('</style>', $cssOverride . "\n</style>", $c);

file_put_contents($f, $c);
echo "Hero section perfectly matched!";
?>
