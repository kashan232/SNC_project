@extends('frontend.layouts.master')

@section('title','Shoukat Nimco Center ||  About Us')

@section('main-content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="{{route('about-us')}}">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Start About Us Section -->
    <section class="about-us-section section" style="background-color: #fbfbfb; padding: 100px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="about-content" style="padding-right: 30px;">
                        <span style="color: #036b41; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Discover Our Story</span>
                        <h2 style="font-family: 'Orbitron', sans-serif; font-size: 38px; font-weight: 800; margin: 15px 0 25px; color: #222; line-height: 1.3;">Welcome to <br> <span style="color: #036b41;">Shoukat Nimco Center</span></h2>
                        <p style="font-size: 16px; color: #555; line-height: 1.8; margin-bottom: 20px;">
                            We are passionate about transforming ordinary spaces into inspiring environments. With a commitment to quality craftsmanship and modern design, our curated collection of premium home furniture, ergonomic office setups, and high-performance gaming chairs is tailored to elevate your lifestyle and workspace.
                        </p>
                        <p style="font-size: 16px; color: #555; line-height: 1.8; margin-bottom: 35px;">
                            Our mission is to provide exceptional value and unparalleled comfort. Every piece in our store is selected with extreme care to ensure durability, standout style, and absolute satisfaction for our customers. We believe that your furniture should be as unique and ambitious as you are.
                        </p>
                        <a href="{{route('contact')}}" class="btn ws-btn" style="background-color: #036b41; color: #fff; padding: 14px 35px; border-radius: 4px; text-transform: uppercase; font-weight: 600; letter-spacing: 1.5px; transition: all 0.3s ease; display: inline-block;">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 mt-5 mt-lg-0">
                    <div class="about-image position-relative" style="padding-left: 20px;">
                        <!-- Real Store Image (Portrait) -->
                        <img src="{{asset('about_us_store.jpg')}}" alt="Shoukat Nimco Center Store" style="width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
                        
                        <!-- Decorative Badge -->
                        <div class="experience-badge" style="position: absolute; bottom: -30px; left: -10px; background: #036b41; color: white; padding: 25px 30px; border-radius: 8px; box-shadow: 0 10px 20px rgba(3, 107, 65, 0.4); text-align: center; border: 3px solid #fff;">
                            <h3 style="font-size: 36px; font-weight: 800; color: #fff; margin: 0;">100%</h3>
                            <span style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Quality<br>Guaranteed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us Section -->

	<!-- Start Vision & Mission (Extra Section for Dedicated Page) -->
	<section class="vision-mission section" style="padding: 80px 0; background: #fff;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-12 mb-4 mb-lg-0">
					<div class="vision-box" style="background: #f4f7f6; padding: 40px; border-radius: 12px; border-left: 5px solid #036b41; height: 100%;">
						<h3 style="font-family: 'Orbitron', sans-serif; color: #023a23; font-weight: 800; margin-bottom: 20px; font-size: 24px;"><i class="ti-eye" style="color: #036b41; margin-right: 10px;"></i> Our Vision</h3>
						<p style="color: #666; line-height: 1.8; font-size: 15px; margin: 0;">To be the leading premium furniture brand in the region, recognized for our commitment to sustainable design, exceptional comfort, and a relentless focus on creating inspiring living and working environments.</p>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="mission-box" style="background: #f4f7f6; padding: 40px; border-radius: 12px; border-left: 5px solid #036b41; height: 100%;">
						<h3 style="font-family: 'Orbitron', sans-serif; color: #023a23; font-weight: 800; margin-bottom: 20px; font-size: 24px;"><i class="ti-target" style="color: #036b41; margin-right: 10px;"></i> Our Mission</h3>
						<p style="color: #666; line-height: 1.8; font-size: 15px; margin: 0;">To curate and deliver high-quality, stylish, and ergonomic furniture that exceeds customer expectations. We strive to provide a seamless shopping experience and unparalleled customer support every step of the way.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Vision & Mission -->

	<!-- Start Shop Services Area -->
<section class="shop-services section home" style="background-color: #f7f9fb; padding: 100px 0;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-center" style="margin-bottom: 60px;">
                    <span style="color: #036b41; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display:block; margin-bottom: 10px;">Our Core Values</span>
                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 36px; font-weight: 800; color: #111; margin-top: 5px;">Why Choose <span style="color: #036b41;">Us</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="service-card text-center">
                    <div class="service-icon-box">
                        <i class="ti-rocket"></i>
                    </div>
                    <h4>Free Shipping</h4>
                    <p>On all orders over Rs: 1000</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="service-card text-center">
                    <div class="service-icon-box">
                        <i class="ti-reload"></i>
                    </div>
                    <h4>7 Days Return</h4>
                    <p>Original box required</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4 mb-lg-0">
                <div class="service-card text-center">
                    <div class="service-icon-box">
                        <i class="ti-lock"></i>
                    </div>
                    <h4>Secure Payment</h4>
                    <p>100% secure payment</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="service-card text-center">
                    <div class="service-icon-box">
                        <i class="ti-tag"></i>
                    </div>
                    <h4>Best Price</h4>
                    <p>Guaranteed best prices</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services Area -->

@endsection

@push('styles')
<style>
    /* Service Cards Styling (From Home Page) */
    .service-card {
        background: #ffffff;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        border: 1px solid #f0f0f0;
        position: relative;
        overflow: hidden;
        z-index: 1;
        height: 100%;
    }
    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(3, 107, 65, 0.15);
        border-color: #036b41;
    }
    .service-icon-box {
        width: 85px;
        height: 85px;
        background: #eaf3ee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        transition: all 0.4s ease;
    }
    .service-card:hover .service-icon-box {
        background: #036b41;
        transform: scale(1.1);
    }
    .service-icon-box i {
        font-size: 38px;
        color: #036b41;
        transition: all 0.4s ease;
    }
    .service-card:hover .service-icon-box i {
        color: #ffffff;
    }
    .service-card h4 {
        font-size: 20px;
        font-weight: 700;
        color: #222;
        margin-bottom: 12px;
        text-transform: capitalize;
    }
    .service-card p {
        font-size: 15px;
        color: #666;
        line-height: 1.6;
        margin: 0;
    }
    .service-card::before {
        content: "";
        position: absolute;
        top: -30px;
        right: -30px;
        width: 120px;
        height: 120px;
        background: rgba(3, 107, 65, 0.03);
        border-radius: 50%;
        z-index: -1;
        transition: all 0.4s ease;
    }
    .service-card:hover::before {
        transform: scale(3);
        background: rgba(3, 107, 65, 0.05);
    }
</style>
@endpush