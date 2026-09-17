<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

// The regex to match the old our outlets section, including its styles
$pattern = '/<!-- Start Our Outlets Section.*<!-- End Our Outlets Section -->/is';

$new_section = <<<'HTML'
<!-- Start Our Outlets Section -->
<style>
    #our-outlets-premium {
        padding: 80px 0;
        background-color: #f9f9fa;
        font-family: 'Poppins', sans-serif;
        position: relative;
    }
    #our-outlets-premium .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    #our-outlets-premium .section-title span {
        color: var(--primary-color);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 14px;
        display: block;
        margin-bottom: 10px;
    }
    #our-outlets-premium .section-title h2 {
        font-size: 36px;
        font-weight: 800;
        color: #222;
        font-family: 'Orbitron', sans-serif;
    }
    .premium-store-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    .premium-store-box {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        text-align: center;
        border: 1px solid #f1f1f1;
    }
    .premium-store-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(3,107,65,0.1);
        border-color: var(--primary-color);
    }
    .store-icon-wrapper {
        width: 80px;
        height: 80px;
        background: rgba(3,107,65,0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 30px auto 15px;
        color: var(--primary-color);
        font-size: 32px;
        transition: all 0.3s ease;
    }
    .premium-store-box:hover .store-icon-wrapper {
        background: var(--primary-color);
        color: #fff;
    }
    .store-details {
        padding: 0 25px 35px;
    }
    .store-details h3 {
        font-size: 20px;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    .store-details p {
        font-size: 14px;
        color: #777;
        line-height: 1.6;
        margin-bottom: 15px;
    }
    .store-details .contact-info {
        display: inline-block;
        background: #f4f6f8;
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 500;
        color: #555;
    }
    .store-details .contact-info i {
        color: var(--primary-color);
        margin-right: 5px;
    }
</style>

<section id="our-outlets-premium" class="section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <span>Find Us Near You</span>
            <h2>Our Outlets</h2>
        </div>
        
        <div class="premium-store-grid">
            @php
                $outlets = \App\Models\Outlet::where('status','active')->get();
            @endphp
            @if($outlets->count() > 0)
                @foreach($outlets as $outlet)
                <div class="premium-store-box" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="store-icon-wrapper">
                        <i class="ti-location-pin"></i>
                    </div>
                    <div class="store-details">
                        <h3>{{ $outlet->name }}</h3>
                        <p>{{ $outlet->address }}</p>
                        @if($outlet->phone)
                        <div class="contact-info">
                            <i class="ti-mobile"></i> {{ $outlet->phone }}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>No outlets available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- End Our Outlets Section -->
HTML;

$index = preg_replace($pattern, $new_section, $index);
file_put_contents($index_path, $index);

echo "Redesigned Our Outlets section.\n";
