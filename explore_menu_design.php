<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

$css = <<<'CSS'
<style>
    /* EXPLORE MENU DESIGN */
    .kfc-category-section {
        padding: 60px 0;
        background-color: #fcf8f2;
        background-image: url('https://www.transparenttextures.com/patterns/food.png'); /* Fallback pattern */
        position: relative;
    }
    
    .kfc-header-wrap {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-direction: column;
        margin-bottom: 40px;
        padding: 0 15px;
    }

    .kfc-section-title h2 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 900;
        font-size: 28px;
        text-transform: uppercase;
        color: #4a2e2b; /* Dark Brown */
        margin: 0 0 5px 0;
        letter-spacing: 0.5px;
    }

    .kfc-title-line {
        width: 60px;
        height: 3px;
        background: #b59063; /* Golden */
    }

    .kfc-view-all {
        display: none; /* Hidden in screenshot */
    }

    .kfc-card-item {
        display: block;
        text-decoration: none !important;
        background: #ffffff;
        border-radius: 20px; /* Rounded rectangle */
        padding: 15px 15px 25px 15px;
        text-align: center;
        position: relative;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin: 15px 5px;
    }

    .kfc-card-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0,0,0,0.1);
    }

    .kfc-card-item::after {
        display: none;
    }

    .kfc-img-box {
        width: 100%;
        padding-top: 100%; /* 1:1 Aspect Ratio */
        position: relative;
        border-radius: 50%;
        margin-bottom: 15px;
        overflow: visible; /* To allow glow */
    }

    .kfc-img-box img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        transition: all 0.3s ease;
    }

    /* Hover effect golden ring */
    .kfc-card-item:hover .kfc-img-box img {
        border-color: #b59063;
        box-shadow: 0 0 0 5px rgba(181, 144, 99, 0.2);
    }

    .kfc-cat-name {
        font-family: 'Poppins', sans-serif !important;
        font-size: 15px;
        font-weight: 800;
        color: #111;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .kfc-name-line {
        display: none; /* Not visible in screenshot */
    }

    /* KFC Slider Arrows */
    .kfc-slider .owl-nav div {
        background: #b59063;
        color: #fff;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        font-size: 18px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    .kfc-slider .owl-nav div:hover {
        background: #9a7b54;
    }
    .kfc-slider .owl-prev { left: -50px; }
    .kfc-slider .owl-next { right: -50px; }

    @media (max-width: 1200px) {
        .kfc-slider .owl-prev { left: -15px; }
        .kfc-slider .owl-next { right: -15px; }
    }
    @media (max-width: 768px) {
        .kfc-card-item {
            padding: 10px 10px 20px 10px;
        }
        .kfc-cat-name {
            font-size: 13px;
        }
        .kfc-slider .owl-prev { left: -10px; }
        .kfc-slider .owl-next { right: -10px; }
        .kfc-section-title h2 { font-size: 22px; }
    }
</style>
CSS;

// Find the existing style block for categories
$start = strpos($c, '<!-- Start Categories Section (Carousel) -->');
$end = strpos($c, '<section class="kfc-category-section">');

if ($start !== false && $end !== false) {
    $before = substr($c, 0, $start);
    $after = substr($c, $end);
    $c = $before . "<!-- Start Categories Section (Carousel) -->\n" . $css . "\n" . $after;
    file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
    echo "Successfully updated Explore Menu design.";
} else {
    echo "Could not find Explore Menu section.";
}
