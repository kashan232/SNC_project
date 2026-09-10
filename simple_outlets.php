<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$pattern = '/<!-- Start Our Outlets Section -->.*?<!-- End Our Outlets Section -->/s';

$elegant_html = <<<HTML
<!-- Start Our Outlets Section -->
<style>
    #our-outlets {
        padding: 80px 0;
        background-color: #ffffff;
        font-family: 'Poppins', sans-serif;
    }
    #our-outlets .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    #our-outlets .section-title h2 {
        font-size: 32px;
        font-weight: 700;
        color: #222;
        margin-bottom: 15px;
    }
    #our-outlets .section-title .divider {
        height: 3px;
        width: 60px;
        background-color: var(--primary-color);
        margin: 0 auto;
    }
    .store-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }
    .store-box {
        background: #fff;
        border: 1px solid #eaeaea;
        padding: 30px 25px;
        border-radius: 8px;
        text-align: center;
        transition: all 0.3s ease;
    }
    .store-box:hover {
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        transform: translateY(-3px);
    }
    .store-box .icon {
        font-size: 28px;
        color: var(--primary-color);
        margin-bottom: 15px;
        display: block;
    }
    .store-box h4 {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        text-transform: capitalize;
    }
    .store-box p {
        font-size: 14px;
        color: #777;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 1200px) {
        .store-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 991px) {
        .store-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 767px) {
        .store-grid { grid-template-columns: 1fr; }
    }
</style>

<section id="our-outlets">
    <div class="container">
        <div class="section-title">
            <h2>Our Outlets</h2>
            <div class="divider"></div>
        </div>
        
        <div class="store-grid">
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Latifabad Unit 7</h4>
                <p>Shop no. 4, Civic Center Old Passport Building Opp Allied Bank, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Haider Chowk</h4>
                <p>Shop # 1307/02 Haider Bux Jatoi Building Near Bata Shop, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Wadhu Wah</h4>
                <p>Shop no. 12 Rani Arcade, Wadhu Wah Road Near Summit Bank Qasimabad, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Main Qasimabad</h4>
                <p>Shop no. 8, 9 Saim Luxury Apartment Opp Total Petrol Pump Qasimabad, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Saddar</h4>
                <p>Shop no. 63, Adjacent CBH Cant Saddar Opp Garrison, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Latifabad Unit 9</h4>
                <p>Main Airport Road Near Saira Clinic Latifabad Number 9, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Hirabad</h4>
                <p>Building A/2585 Ward A, Opposite Tower Market Jail Road, Hirabad, Hyderabad</p>
            </div>
            <div class="store-box">
                <i class="ti-location-pin icon"></i>
                <h4>Autobahn</h4>
                <p>Main Autobahn beside Dawood Super Market, Hyderabad</p>
            </div>
        </div>
    </div>
</section>
<!-- End Our Outlets Section -->
HTML;

$content = preg_replace($pattern, $elegant_html, $content);
file_put_contents($file, $content);
echo "Simple elegant outlets applied.\n";
