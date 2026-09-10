<!-- Meta Tag -->
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>
<!-- Favicon -->
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">

<title>Shoukat Nimco Center Pakistan | Premium Men's Shirts for Style, Comfort & Confidence</title>

<!-- Meta Description -->
<meta name="description" content="Discover Shoukat Nimco Center Pakistan – your destination for premium men's shirts crafted with timeless style, modern comfort, and quality you can trust. Elevate your wardrobe with Shoukat Nimco Center's exclusive shirt collection loved by thousands worldwide.">

<!-- Meta Keywords -->
<meta name="keywords" content="Shoukat Nimco Center, Shoukat Nimco Center Pakistan, Shoukat Nimco Center shirts, premium men's shirts, designer shirts Pakistan, formal shirts, casual shirts, cotton shirts, luxury men's fashion, stylish shirts, mens clothing Pakistan, branded shirts, comfort wear, online shirts Pakistan">

<!-- Author & Robots -->
<meta name="author" content="Shoukat Nimco Center">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Shoukat Nimco Center Pakistan | Premium Men's Shirts for Style, Comfort & Confidence">
<meta property="og:description" content="Shop Shoukat Nimco Center’s premium shirt collection. Timeless design meets unmatched comfort. Trusted by thousands of men across Pakistan.">
<meta property="og:url" content="https://Shoukat Nimco Center.pk/">
<meta property="og:type" content="website">
<meta property="og:image" content="https://Shoukat Nimco Center.pk/assets/images/preview.jpg">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Shoukat Nimco Center Pakistan | Premium Men's Shirts for Style, Comfort & Confidence">
<meta name="twitter:description" content="Explore Shoukat Nimco Center – Pakistan’s top choice for premium men’s shirts combining comfort and style.">
<meta name="twitter:image" content="https://Shoukat Nimco Center.pk/assets/images/preview.jpg">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="{{asset('logo.png')}}">
<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
<style>
    /* Multilevel dropdown */
    .list-main {
        display: flex;
        flex-wrap: wrap;
        /* prevent overflow on small screens */
        align-items: center;
        gap: 10px;
        /* space between items */
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .list-main li {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: #333;
    }

    .list-main li i {
        margin-right: 5px;
        color: #000;
    }

    /* Make links inline and clean */
    .list-main li a {
        text-decoration: none;
        color: #000;
        font-weight: 500;
    }

    .list-main li a:hover {
        color: #4ba064;
        /* your brand color */
    }

    /* Optional: tweak spacing for small screens */
    @media (max-width: 576px) {
        .list-main {
            justify-content: center;
            gap: 15px;
        }
    }


    /* Black overlay */
    .single-banner::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        /* black shade with 0.6 opacity */
        z-index: 1;
    }

    /* Content styling */
    .single-banner .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: #fff;
        z-index: 2;
        /* above overlay */
    }

    .single-banner .content h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #fff;
    }

    @media (max-width: 768px) {

        .single-product .product-content h3 a {
            font-size: 22px !important;
        }

        .single-product .product-content .product-price span {
            font-size: 22px !important;
        }

        .single-product .product-content .product-price del {
            font-size: 16px !important;
        }

        #Gslider .carousel-inner {
            height: auto !important;
        }

        #Gslider .carousel-inner img {
            height: 100vh;
            /* full mobile height */
            object-fit: cover;
            object-position: right center;
            /* or left center if needed */
        }

        .header.shop .list-main li i {
            color: #F7941D;
        }

        .header.shop .top-left .list-main li i {
            color: #F7941D;
            font-size: 10px;
        }

        .header.shop .list-main li a {
            font-size: 12px;
        }

        .top-left {
            display: none;
        }

        .logo img {
            width: 80px;
        }
    }

    @media (max-width: 480px) {
        .single-product .product-content h3 a {
            font-size: 20px !important;
        }

        .single-product .product-content .product-price span {
            font-size: 20px !important;
        }

        .single-product .product-content .product-price del {
            font-size: 14px !important;
        }

        #Gslider .carousel-inner {
            height: auto !important;
        }

        .header.shop .list-main li i {
            color: #F7941D;
        }

        .header.shop .top-left .list-main li i {
            color: #F7941D;
            font-size: 10px;
        }

        .header.shop .list-main li a {
            font-size: 12px;
        }

        .logo img {
            width: 80px;
        }
    }
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }

    
    /*
</style>
<style>
    .header.shop .right-bar .sinlge-bar .single-icon i {
        font-size: 26px !important;
    }
    .header.shop .right-bar .sinlge-bar .single-icon .total-count {
        width: 22px !important;
        height: 22px !important;
        line-height: 22px !important;
        font-size: 12px !important;
        top: -10px !important;
        right: -10px !important;
        background: #036b41 !important; /* Force green color */
    }
</style>
@stack('styles')
