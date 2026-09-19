<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');

// Remove old KFC Category CSS block
$c = preg_replace('/<style>\s*\.kfc-category-section.*?<\/style>/is', '', $c);

$new_css = <<<'CSS'
<style>
    /* === EXPLORE MENU NEW DESIGN === */
    .kfc-category-section {
        padding: 80px 0 60px 0;
        /* Using a warm off-white background as seen in design */
        background-color: #F8F5F0; 
        background-image: url('https://www.transparenttextures.com/patterns/food.png'); /* subtle food pattern placeholder */
        position: relative;
    }
    
    .kfc-header-wrap {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 50px;
        padding: 0 15px;
    }

    .kfc-section-title {
        position: relative;
    }

    .kfc-section-title h2 {
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 26px;
        color: #4A2B29; /* Dark brown/maroon color */
        margin: 0;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .kfc-title-line {
        width: 40px;
        height: 2px;
        background: #A98C66; /* Gold/Brown color */
        margin-top: 8px;
    }

    /* Hide the old view all button since it's not in the new design */
    .kfc-view-all {
        display: none !important;
    }

    /* Slider Container */
    .kfc-slider {
        padding: 20px 0;
    }

    /* Card Item (Arch Shape) */
    .kfc-card-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none !important;
        background: #FFFFFF;
        border-radius: 60px 60px 15px 15px; /* Arch shape */
        padding: 10px 10px 25px 10px;
        text-align: center;
        position: relative;
        box-shadow: 0 8px 16px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        margin: 20px 5px; /* Margin to allow overflow from hover */
        height: 180px;
    }

    /* Small decorative dot removed */
    .kfc-card-item::after {
        display: none !important;
    }

    /* Image Box */
    .kfc-img-box {
        width: 100px;
        height: 100px;
        position: relative;
        border-radius: 50%;
        margin-top: 5px;
        margin-bottom: auto;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    /* Pseudo-element for the golden ring */
    .kfc-img-box::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        border: 2px solid #C4A579; /* Golden ring */
        border-radius: 50%;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.4s ease;
    }

    .kfc-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.4s ease;
    }

    /* Text */
    .kfc-cat-name {
        font-family: 'Poppins', sans-serif;
        font-size: 13px;
        font-weight: 700;
        color: #111;
        margin-top: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.3s ease;
    }

    /* Text Underline (Active/Hover) */
    .kfc-name-line {
        width: 15px;
        height: 2px;
        background: #C4A579; /* Golden color */
        margin: 6px auto 0;
        opacity: 0;
        transition: all 0.3s ease;
    }

    /* HOVER / ACTIVE STATE */
    .kfc-card-item:hover, .kfc-card-item.active {
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    /* Expand the image and show golden ring */
    .kfc-card-item:hover .kfc-img-box, .kfc-card-item.active .kfc-img-box {
        transform: scale(1.15) translateY(-10px);
        z-index: 10;
    }
    .kfc-card-item:hover .kfc-img-box::before, .kfc-card-item.active .kfc-img-box::before {
        opacity: 1;
        transform: scale(1);
    }

    .kfc-card-item:hover .kfc-name-line, .kfc-card-item.active .kfc-name-line {
        opacity: 1;
        width: 25px;
    }

    /* Owl Slider Arrows styling to match design (Brown circle with arrow) */
    .kfc-slider .owl-nav div {
        background: #9D7B54 !important;
        color: #fff !important;
        width: 40px !important;
        height: 40px !important;
        line-height: 40px !important;
        text-align: center !important;
        border-radius: 50% !important;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        font-size: 18px !important;
    }
    .kfc-slider .owl-prev { left: -20px; }
    .kfc-slider .owl-next { right: -20px; }

    @media (max-width: 768px) {
        .kfc-card-item {
            height: 160px;
        }
        .kfc-img-box {
            width: 80px;
            height: 80px;
        }
    }
</style>
CSS;

$c = str_replace('<!-- Start Categories Section (Carousel) -->', "<!-- Start Categories Section (Carousel) -->\n" . $new_css, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php', $c);
echo "Explore Menu UI replaced.\n";
