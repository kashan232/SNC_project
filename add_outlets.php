<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$stores_html = <<<HTML

<!-- Start Our Outlets Section -->
<style>
    #our-outlets {
        padding: 80px 0;
        background-color: #f9f9f9;
        font-family: 'Poppins', sans-serif;
    }
    #our-outlets .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    #our-outlets .section-title h2 {
        font-size: 36px;
        font-weight: 800;
        color: #111;
        text-transform: uppercase;
        margin-bottom: 15px;
    }
    #our-outlets .section-title .line {
        width: 80px;
        height: 4px;
        background-color: var(--primary-color);
        margin: 0 auto;
        border-radius: 2px;
    }
    .store-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-bottom: 4px solid transparent;
    }
    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-bottom: 4px solid var(--primary-color);
    }
    .store-card h4 {
        font-size: 20px;
        font-weight: 700;
        color: #111;
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .store-card .address {
        display: flex;
        align-items: flex-start;
        color: #666;
        font-size: 15px;
        line-height: 1.6;
    }
    .store-card .address i {
        color: var(--primary-color);
        font-size: 18px;
        margin-right: 12px;
        margin-top: 4px;
    }
    .store-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
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
            <h2>Our Stores</h2>
            <div class="line"></div>
        </div>
        
        <div class="store-grid">
            <!-- Store 1 -->
            <div class="store-card">
                <h4>Latifabad Unit 7</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Shop no. 4, Civic Center Old Passport Building Opp Allied Bank Latifabad Hyderabad, Sindh, 71000</span>
                </div>
            </div>
            <!-- Store 2 -->
            <div class="store-card">
                <h4>Haider Chowk</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Shop # 1307/02 Haider Bux Jatoi Building Near Bata Shop Haider Chowk, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 3 -->
            <div class="store-card">
                <h4>Wadhu Wah</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Shop no. 12 Rani Arcade, Wadhu Wah Road Near Summit Bank Qasimabad, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 4 -->
            <div class="store-card">
                <h4>Main Qasimabad</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Shop no. 8, 9 Saim Luxury Apartment Opp Total Petrol Pump Qasimabad Hyderabad, Sindh, 71000</span>
                </div>
            </div>
            <!-- Store 5 -->
            <div class="store-card">
                <h4>Saddar</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Shop no. 63, Adjacent CBH Cant Saddar Opp Garrison Hyderabad.</span>
                </div>
            </div>
            <!-- Store 6 -->
            <div class="store-card">
                <h4>Latifabad Unit 9</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Main Airport Road Near Saira Clinic Latifabad Number 9 Hyderabad</span>
                </div>
            </div>
            <!-- Store 7 -->
            <div class="store-card">
                <h4>Hirabad</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Building A/2585 Ward A, Opposite Tower Market Jail Road, Hirabad, Hyderabad.</span>
                </div>
            </div>
            <!-- Store 8 -->
            <div class="store-card">
                <h4>Autobahn</h4>
                <div class="address">
                    <i class="ti-location-pin"></i>
                    <span>Main Autobahn beside Dawood Super Market Hyderabad</span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our Outlets Section -->

HTML;

// Insert just before the final scripts push or before @endsection
if (strpos($content, '<!-- Start Our Outlets Section -->') === false) {
    $content = str_replace('@endsection', $stores_html . "\n@endsection", $content);
    file_put_contents($file, $content);
    echo "Outlets section added.\n";
} else {
    echo "Outlets section already exists.\n";
}

