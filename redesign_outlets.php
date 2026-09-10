<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// Find and remove the old section
$pattern = '/<!-- Start Our Outlets Section -->.*?<!-- End Our Outlets Section -->/s';

$dark_stores_html = <<<HTML
<!-- Start Our Outlets Section -->
<style>
    #our-outlets {
        padding: 90px 0;
        background-color: #111111; /* Dark theme */
        font-family: 'Poppins', sans-serif;
    }
    #our-outlets .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    #our-outlets .section-title h2 {
        font-size: 42px;
        font-weight: 900;
        color: #ffffff;
        text-transform: uppercase;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }
    #our-outlets .section-title .breadcrumbs {
        color: #999;
        font-size: 15px;
        font-weight: 500;
    }
    #our-outlets .section-title .breadcrumbs span {
        margin: 0 10px;
        font-size: 12px;
    }
    .store-card {
        background: transparent;
        padding: 0;
        border: none;
        box-shadow: none;
        border-radius: 0;
        margin-bottom: 40px;
    }
    .store-card:hover {
        transform: none;
        box-shadow: none;
        border-bottom: none;
    }
    .store-card h4 {
        font-size: 18px;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .store-card .address {
        display: flex;
        align-items: flex-start;
        color: var(--primary-color);
        font-size: 15px;
        line-height: 1.7;
        font-weight: 400;
    }
    .store-card .address i {
        color: #777;
        font-size: 16px;
        margin-right: 12px;
        margin-top: 4px;
        transform: rotate(-15deg); /* Paper plane angle */
    }
    .store-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px 30px;
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
            <h2>OUR STORES</h2>
            <div class="breadcrumbs">Home <span>&gt;</span> Our Stores</div>
        </div>
        
        <div class="store-grid">
            <!-- Store 1 -->
            <div class="store-card">
                <h4>Latifabad Unit 7</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Shop no. 4, Civic Center Old Passport Building Opp Allied Bank Latifabad Hyderabad, Sindh, 71000</span>
                </div>
            </div>
            <!-- Store 2 -->
            <div class="store-card">
                <h4>Haider Chowk</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Shop # 1307/02 Haider Bux Jatoi Building Near Bata Shop Haider Chowk, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 3 -->
            <div class="store-card">
                <h4>Wadhu Wah</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Shop no. 12 Rani Arcade, Wadhu Wah Road Near Summit Bank Qasimabad, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 4 -->
            <div class="store-card">
                <h4>Main Qasimabad</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Shop no. 8, 9 Saim Luxury Apartment Opp Total Petrol Pump Qasimabad Hyderabad, Sindh, 71000</span>
                </div>
            </div>
            <!-- Store 5 -->
            <div class="store-card">
                <h4>Saddar</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Shop no. 63, Adjacent CBH Cant Saddar Opp Garrison Hyderabad.</span>
                </div>
            </div>
            <!-- Store 6 -->
            <div class="store-card">
                <h4>Latifabad Unit 9</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Main Airport Road Near Saira Clinic Latifabad Number 9 Hyderabad</span>
                </div>
            </div>
            <!-- Store 7 -->
            <div class="store-card">
                <h4>Hirabad</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Building A/2585 Ward A, Opposite Tower Market Jail Road, Hirabad, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 8 -->
            <div class="store-card">
                <h4>Autobahn</h4>
                <div class="address">
                    <i class="ti-location-arrow"></i>
                    <span>Main Autobahn beside Dawood Super Market Hyderabad</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our Outlets Section -->
HTML;

$content = preg_replace($pattern, $dark_stores_html, $content);
file_put_contents($file, $content);
echo "Dark outlets section applied.\n";
