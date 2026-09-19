@extends('frontend.layouts.master')
@section('title','Shoukat Nimco Center')
@section('main-content')
<style>
    /* Floating Action Buttons */
    .single-product .product-img .button-head {
        background: transparent !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        position: absolute !important;
        bottom: 15px !important;
        left: 0 !important;
        width: 100% !important;
        border: none !important;
        z-index: 9 !important;
    }
    
    .single-product .product-action {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        float: none !important;
    }

    .single-product .product-action a {
        color: #333 !important;
        font-size: 18px !important;
        margin: 0 5px !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        background: #fff !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .single-product .product-action a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .single-product .product-action a i {
        margin: 0 !important;
        padding: 0 !important;
    }
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

    .product-area .nav-tabs {
    text-align: center;
    display: flex;
    flex-wrap: wrap; /* responsive me wrap hon */
    justify-content: center;
    gap: 10px; /* buttons ke beech spacing */
    border: none;
}

.product-area .nav-tabs li {
    list-style: none;
}

.product-area .nav-tabs li button {
    padding: 8px 16px; /* andar ki spacing */
    border: none;
    background: #f5f5f5;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.product-area .nav-tabs li button:hover,
.product-area .nav-tabs li button.active {
    background: #4ba064;
    color: #fff;
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


    /* Professional Category Cards */
    .single-banner {
        position: relative;
        overflow: hidden;
        border-radius: 8px; /* Slightly rounded corners */
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Soft shadow */
        height: 400px; /* Force uniform height across all single-banners */
    }

    .single-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .single-banner:hover img {
        transform: scale(1.08); /* Zoom effect on hover */
    }

    /* Elegant gradient overlay */
    .single-banner::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(3, 107, 65, 0.7) 100%); /* Greenish dark gradient matching theme */
        z-index: 1;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .single-banner:hover::after {
        opacity: 0.95;
    }

    /* Content styling */
    .single-banner .content {
        position: absolute;
        bottom: 30px; /* Position from bottom instead of center */
        top: auto;
        left: 30px;
        right: 30px;
        transform: none;
        text-align: center;
        color: #fff;
        z-index: 2; /* above overlay */
    }

    .single-banner .content h3 {
        font-family: 'Orbitron', sans-serif;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    
    .single-banner .content a {
        display: inline-block;
        padding: 10px 25px;
        background-color: #fff;
        color: var(--primary-color); /* Theme green */
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    }

    .single-banner .content a:hover {
        background-color: var(--primary-color);
        color: #fff;
        border: 1px solid #fff;
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
        height: 85vh;
    }
    #Gslider .carousel-item {
        height: 100%;
    }

        #Gslider .carousel-inner img {
            height: 100vh;
            /* full mobile height */
            object-fit: cover;
            object-position: right center;
            /* or left center if needed */
        }

        .header.shop .list-main li i {
            color: var(--primary-color);
        }

        .header.shop .top-left .list-main li i {
            color: var(--primary-color);
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
        height: 85vh;
    }
    #Gslider .carousel-item {
        height: 100%;
    }

        .header.shop .list-main li i {
            color: var(--primary-color);
        }

        .header.shop .top-left .list-main li i {
            color: var(--primary-color);
            font-size: 10px;
        }

        .header.shop .list-main li a {
            font-size: 12px;
        }

        .logo img {
            width: 80px;
        }
    }
    /* Midium Banner (Featured Products) Redesign */
    .midium-banner {
        padding: 60px 0 !important;
    }
    .midium-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .midium-banner .single-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05);
    }
    .midium-banner .single-banner::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%);
        z-index: 1;
    }
    .midium-banner .single-banner .content {
        position: absolute;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2;
        text-align: left !important;
        padding: 0 !important;
        width: 80%;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
        background: var(--primary-color);
        display: inline-block;
        padding: 4px 12px;
        border-radius: 4px;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; text-decoration: underline; /* Make discount pop, or use a distinct green/yellow */
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px);
    }
    /* Uniform Product Card Heights */
    
        flex-direction: column;
        
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        padding-top: 120%; /* Enforce a fixed aspect ratio for images */
        background: #fff;
        overflow: hidden;
    }
    .single-product .product-img a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-height: 100%;
        width: auto !important;
        max-width: 100%;
        object-fit: contain;
    }
    .single-product .product-content {
        flex-grow: 1;
        display: flex;
        
        justify-content: flex-end;
    }

    /* Fix Card Heights and Image Contain */
    
        flex-direction: column;
        
        justify-content: space-between;
        background: #fff;
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        height: 300px; /* Fixed height for all images */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .single-product .product-img a {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-width: 100%;
        max-height: 100%;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
    }
    .single-product .product-content {
        padding-top: 15px;
    }

    /* Perfect Global Section Padding */
    .section {
        padding: 70px 0 !important;
    }
    .section-title {
        margin-bottom: 50px !important;
    }
    .small-banner.section {
        padding: 40px 0 !important;
    }
    .midium-banner {
        padding: 70px 0 !important;
    }
    /* Add Padding to Product Images inside Cards */
    .single-product .product-img {
        padding: 20px !important;
    }
    
    /* Better Design for Slider Navigation Arrows */
    .owl-carousel .owl-nav {
        margin-top: 30px !important;
        text-align: center;
    }
    .owl-carousel .owl-nav div {
        background: var(--primary-color) !important;
        color: #fff !important;
        width: 45px !important;
        height: 45px !important;
        
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        margin: 0 10px !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .owl-carousel .owl-nav div:hover {
        background: #222 !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
    .owl-carousel .owl-nav div i {
        
    }
    /* Fix Slider Icon Alignment */
    .owl-carousel .owl-nav div {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: normal !important;
        padding: 0 !important;
    }
    .owl-carousel .owl-nav div i {
        line-height: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }
    /* Premium Small Banner Design for White-Background Products */
    .small-banner .single-banner {
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 80%;
        height: 80%;
        object-fit: contain;
        mix-blend-mode: multiply; /* Magically removes the white background */
        transition: transform 0.5s ease;
        opacity: 0.85; /* Blend nicely with the text */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 1;
    }
    
          flex-direction: column !important;
          justify-content: center !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        
        align-items: center;
        justify-content: flex-end;
        text-align: center;
        z-index: 2;
        padding-bottom: 30px;
        background: linear-gradient(to top, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 50%);
    }
    .small-banner .single-banner .content h3 {
        color: #023a23 !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 22px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px !important;
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 10px 25px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 13px !important;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .small-banner .single-banner .content a:hover {
        background: #023a23 !important;
        transform: translateY(-3px);
    }
    /* Fixing the Small Banner Content Alignment */
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: flex-end !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 0 !important;
        padding-bottom: 20px !important;
        background: transparent !important;
    }
    /* We add a separate pseudo element for the gradient so it doesn't mess with flex */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 50% !important;
        background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
    }
    .small-banner .single-banner h3, 
    .small-banner .single-banner a {
        position: relative !important;
        z-index: 3 !important;
    }
    /* Sleek Lifestyle Category Banners */
    .small-banner .single-banner {
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
        opacity: 0.7; /* Darken image slightly so text is readable */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 0.5;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner::before {
        display: none !important; /* Remove any previously added gradients */
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 14px !important;
        letter-spacing: 1.5px;
        transition: all 0.3s ease !important;
        border: 2px solid transparent !important;
    }
    .small-banner .single-banner .content a:hover {
        background: transparent !important;
        border: 2px solid #fff !important;
        transform: translateY(-3px);
    }
    /* Restore to the Elegant White-on-Green Lifestyle Design */
    .small-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
    }
    /* The soft green gradient overlay */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(3,107,65,0.7) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
        display: block !important;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Poppins', sans-serif !important;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 2px !important;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
    }
    .small-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        font-size: 14px !important;
        letter-spacing: 1.5px !important;
        transition: all 0.3s ease !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }
    .small-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* Midium Banner (Featured Products) Redesign for White-Background Products */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%) !important;
        display: flex !important;
        align-items: center !important;
    }
    .midium-banner .single-banner::before {
        display: none !important; /* Remove dark overlay */
    }
    .midium-banner .single-banner img {
        width: 50% !important;
        height: 90% !important;
        object-fit: contain !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.5s ease !important;
        position: absolute !important;
        right: 10px !important;
        bottom: 10px !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.1) !important;
    }
    .midium-banner .single-banner .content {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        transform: none !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 40px !important;
        width: 60% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 15px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 6px 15px !important;
        border-radius: 30px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #023a23 !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 30px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 25px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: var(--primary-color) !important; 
        text-decoration: underline !important; 
    }
    .midium-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(3, 107, 65, 0.3) !important;
        border: 2px solid var(--primary-color) !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: transparent !important;
        color: var(--primary-color) !important;
        transform: translateY(-3px) !important;
    }
    /* Revert Midium Banner to the Original Behtreen Design */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: transparent !important;
        display: block !important;
    }
    .midium-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease !important;
        position: static !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05) !important;
    }
    .midium-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%) !important;
        z-index: 1 !important;
        display: block !important;
    }
    .midium-banner .single-banner .content {
        position: absolute !important;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 0 !important;
        width: 80% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 10px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 4px 12px !important;
        border-radius: 4px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; 
        text-decoration: underline !important;
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        border: none !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* === EMERGENCY FIX FOR LAYOUT === */
    /* 1. Fix Product Cards Layout */
    .single-product {
        display: flex !important;
        flex-direction: column !important;
        background: #fff !important;
    }
    .single-product .product-img {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 300px !important; /* Force image container height */
        padding: 20px !important;
    }
    .single-product .product-img img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
    }

    /* 2. Fix Small Banners Layout (Office Chairs etc) */
    .small-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        width: 100% !important;
        left: 0 !important;
        padding: 20px !important;
    }
    .small-banner .single-banner .content a {
        display: inline-block !important; /* Prevent stretching */
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
    }

    /* 3. Fix Medium Banner Layout (Featured) */
    .midium-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: center !important;
    }
    .midium-banner .single-banner .content a {
        display: inline-block !important;
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
    }
    /* === MOBILE RESPONSIVE FIXES FOR SLIDER === */
    @media (max-width: 768px) {
        #Gslider .carousel-inner img {
            min-height: 250px !important;
            object-fit: cover !important; /* Prevents stretching, crops instead to fit the height */
        }
        #Gslider .carousel-inner .carousel-caption {
            padding: 10px !important;
        }
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 20px !important;
            margin-bottom: 10px !important;
            line-height: 1.3 !important;
            letter-spacing: 1px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 12px !important;
            margin-bottom: 15px !important;
            line-height: 1.4 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important; /* Max 2 lines for description */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        #Gslider .btn.ws-btn {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    @media (max-width: 400px) {
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 16px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 11px !important;
        }
    }
    /* === FEATURED ITEMS RESPONSIVE FIX === */
    @media (max-width: 768px) {
        .midium-banner .single-banner {
            height: auto !important; /* Allow it to grow if needed */
            min-height: 250px !important;
            padding-bottom: 20px !important;
        }
        .midium-banner .single-banner .content {
            padding: 20px !important;
            width: 100% !important;
            left: 0 !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }
        .midium-banner .single-banner .content p {
            font-size: 11px !important;
            padding: 4px 10px !important;
            margin-bottom: 10px !important;
        }
        .midium-banner .single-banner .content h3 {
            font-size: 20px !important;
            line-height: 1.2 !important;
            margin-bottom: 15px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 3 !important; /* Limit title to 3 lines */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .midium-banner .single-banner .content a {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    /* === FIX FEATURED PRODUCTS CONTENT & BUTTONS === */
    .single-product .product-content {
        display: flex !important;
        flex-direction: column !important; /* Stack Title and Price vertically */
        justify-content: flex-start !important;
        text-align: center !important;
        padding: 15px 10px !important;
    }
    .single-product .product-content h3 {
        margin-bottom: 8px !important;
    }
    .single-product .product-content h3 a {
        display: block !important;
        font-size: 14px !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .single-product .product-content .product-price {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
    }
    .single-product .product-img .button-head {
        display: flex !important;
        flex-direction: row !important;
        opacity: 1 !important; /* Make buttons visible on mobile */
        visibility: visible !important;
        bottom: 10px !important;
        transform: translateY(0) !important;
    }
    .single-product .product-action {
        flex-direction: row !important;
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- Slider Area -->
@if(count($banners)>0)
<section id="Gslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($banners as $key=>$banner)
        <li data-target="#Gslider" data-slide-to="{{$key}}" class="{{(($key==0)? 'active' : '')}}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($banners as $key=>$banner)
        <div class="carousel-item {{(($key==0)? 'active' : '')}}">
            <img class="first-slide" src="{{$banner->photo}}" alt="Banner Image" style="width: 100%; height: auto; object-fit: cover;">
            <!-- Caption (optional, removed if you just use images) -->
        </div>
        @endforeach
    </div>
    
    <a class="carousel-control-prev" href="#Gslider" role="button" data-slide="prev" style="width: 50px; background: rgba(0,0,0,0.2);">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#Gslider" role="button" data-slide="next" style="width: 50px; background: rgba(0,0,0,0.2);">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</section>
@endif
<!--/ End Slider Area -->



{{-- @php
    $featured=DB::table('products')->where('is_featured',1)->where('status','active')->orderBy('id','DESC')->limit(1)->get();
@endphp --}}




<!-- Start Categories Section (Carousel) -->
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
        width: 35px;
        height: 3px;
        background: #b59063; /* Golden */
        margin: 8px auto 0;
        transition: width 0.3s ease;
    }
    .kfc-card-item:hover .kfc-name-line {
        width: 50px;
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







<!-- Start Most Popular -->
<div class="product-area most-popular section" style="background:#c1540b;">
    <div class="container">
<div class="row">
            <div class="col-12">
                <div class="section-title text-center" style="margin-bottom: 50px;">
                    <span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Top Picks</span>
                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #fff; margin-top: 10px;">Featured <span style="color: #fff;">Products</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @foreach($product_lists as $product)
                    @if($product->condition=='hot')
                    <!-- Start Clean Product Card -->
                    <div class="single-product clean-card">
                        <div class="product-img">
                            <a href="{{route('product-detail',$product->slug)}}">
                                @php $photo=explode(',',$product->photo); @endphp
                                <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                            </a>
                            <a class="clean-wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class="ti-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                            <div class="price-container">
                                @php $after_discount=($product->price-($product->price*$product->discount)/100); @endphp
                                @if($product->discount>0)
                                    <del>Rs:{{number_format($product->price,2)}}</del>
                                @endif
                                <span class="current-price">Rs:{{number_format($after_discount,2)}}</span>
                            </div>
                            <a class="clean-add-cart" href="{{route('add-to-cart',$product->slug)}}"><i class="ti-plus"></i></a>
                        </div>
                    </div>
                    <!-- End Clean Product Card -->
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Most Popular Area -->

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container">
<div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center" style="margin-bottom: 50px;">
                            <span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px;">Just In</span>
                            <h2 style="font-family: 'Orbitron', sans-serif; font-size: 32px; font-weight: 800; color: #222; margin-top: 10px;">New <span style="color: var(--primary-color);">Arrivals</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="owl-carousel popular-slider">
                            @php
                            $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(12)->get();
                            @endphp
                            @foreach($product_lists as $product)
                        <!-- Start Clean Product Card -->
                        <div class="single-product clean-card">
                            <div class="product-img">
                                <a href="{{route('product-detail',$product->slug)}}">
                                    @php $photo=explode(',',$product->photo); @endphp
                                    <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                </a>
                                <a class="clean-wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class="ti-heart"></i></a>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                <div class="price-container">
                                    @php $after_discount=($product->price-($product->price*$product->discount)/100); @endphp
                                    @if($product->discount>0)
                                        <del>Rs:{{number_format($product->price,2)}}</del>
                                    @endif
                                    <span class="current-price">Rs:{{number_format($after_discount,2)}}</span>
                                </div>
                                <a class="clean-add-cart" href="{{route('add-to-cart',$product->slug)}}"><i class="ti-plus"></i></a>
                            </div>
                        </div>
                        <!-- End Clean Product Card -->
                              @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->

<!-- Start Product Area -->
<style>
    /* Floating Action Buttons */
    .single-product .product-img .button-head {
        background: transparent !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        position: absolute !important;
        bottom: 15px !important;
        left: 0 !important;
        width: 100% !important;
        border: none !important;
        z-index: 9 !important;
    }
    
    .single-product .product-action {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        float: none !important;
    }

    .single-product .product-action a {
        color: #333 !important;
        font-size: 18px !important;
        margin: 0 5px !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        background: #fff !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .single-product .product-action a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .single-product .product-action a i {
        margin: 0 !important;
        padding: 0 !important;
    }
    .filter-tope-group { display: flex; justify-content: center; gap: 15px; margin-bottom: 40px; border: none; flex-wrap: wrap; }
    .filter-tope-group .btn { 
        background: #f4f6f8 !important; 
        color: #555 !important; 
        border-radius: 30px; 
        padding: 10px 30px; 
        font-weight: 600; 
        font-size: 15px;
        border: 2px solid transparent; 
        transition: all 0.3s;
        text-transform: capitalize;
    }
    .filter-tope-group .btn:hover, .filter-tope-group .btn.is-checked, .filter-tope-group .btn.active { 
        background: var(--primary-color) !important; 
        color: #fff !important; 
        border-color: var(--primary-color); 
        box-shadow: 0 8px 20px rgba(3, 107, 65, 0.25);
    }

    /* Product Card Styling */
    .single-product {
        display: flex; flex-direction: column; background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s ease;
        border: 1px solid #f0f0f0;
        margin-bottom: 30px;
    }
    .single-product:hover {
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        transform: translateY(-8px);
    }
    .single-product .product-img {
        position: relative;
        overflow: hidden;
    }
    .single-product .product-content {
        padding: 22px 20px;
        text-align: left;
    }
    .single-product .product-content h3 {
        margin-bottom: 10px;
    }
    .single-product .product-content h3 a {
        font-size: 16px;
        font-weight: 600;
        color: #222 !important;
        text-decoration: none;
        transition: color 0.3s;
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .single-product .product-content h3 a:hover {
        color: var(--primary-color) !important;
    }
    .single-product .product-content .product-price {
        font-size: 18px;
        font-weight: 800;
        color: var(--primary-color);
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .single-product .product-content .product-price del {
        font-size: 14px;
        color: #aaa;
        font-weight: 500;
        text-decoration: line-through;
    }
    
    /* Completely Redesign Action Buttons (Vertical Floating Icons) */
    .single-product .button-head {
        background: transparent !important;
        position: absolute !important;
        top: 15px !important;
        right: -60px !important; /* Hidden by default off-screen */
        width: auto !important;
        display: flex !important;
        
        gap: 10px !important;
        align-items: center !important;
        padding: 0 !important;
        transition: right 0.4s ease !important;
        opacity: 0 !important;
        z-index: 9 !important;
        border: none !important;
        bottom: auto !important;
        left: auto !important;
    }
    
    .single-product:hover .button-head {
        right: 15px !important;
        opacity: 1 !important;
    }

    
    
    /* Common style for all 3 icons */
    .single-product .product-action a,
    .single-product .product-action-2 a {
        width: 42px !important;
        height: 42px !important;
        background: #fff !important;
        color: #333 !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        transition: all 0.3s !important;
        font-size: 18px !important;
        border: none !important;
        padding: 0 !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
    
    .single-product .product-action a:hover,
    .single-product .product-action-2 a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: scale(1.1);
    }

    /* Hide text from View/Wishlist/Cart */
    .single-product .product-action a span,
    .single-product .product-action-2 a span {
        display: none !important; 
    }
    /* Midium Banner (Featured Products) Redesign */
    .midium-banner {
        padding: 60px 0 !important;
    }
    .midium-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .midium-banner .single-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05);
    }
    .midium-banner .single-banner::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%);
        z-index: 1;
    }
    .midium-banner .single-banner .content {
        position: absolute;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2;
        text-align: left !important;
        padding: 0 !important;
        width: 80%;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
        background: var(--primary-color);
        display: inline-block;
        padding: 4px 12px;
        border-radius: 4px;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; text-decoration: underline; /* Make discount pop, or use a distinct green/yellow */
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px);
    }
    /* Uniform Product Card Heights */
    
        flex-direction: column;
        
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        padding-top: 120%; /* Enforce a fixed aspect ratio for images */
        background: #fff;
        overflow: hidden;
    }
    .single-product .product-img a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-height: 100%;
        width: auto !important;
        max-width: 100%;
        object-fit: contain;
    }
    .single-product .product-content {
        flex-grow: 1;
        display: flex;
        
        justify-content: flex-end;
    }

    /* Fix Card Heights and Image Contain */
    
        flex-direction: column;
        
        justify-content: space-between;
        background: #fff;
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        height: 300px; /* Fixed height for all images */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .single-product .product-img a {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-width: 100%;
        max-height: 100%;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
    }
    .single-product .product-content {
        padding-top: 15px;
    }

    /* Perfect Global Section Padding */
    .section {
        padding: 70px 0 !important;
    }
    .section-title {
        margin-bottom: 50px !important;
    }
    .small-banner.section {
        padding: 40px 0 !important;
    }
    .midium-banner {
        padding: 70px 0 !important;
    }
    /* Add Padding to Product Images inside Cards */
    .single-product .product-img {
        padding: 20px !important;
    }
    
    /* Better Design for Slider Navigation Arrows */
    .owl-carousel .owl-nav {
        margin-top: 30px !important;
        text-align: center;
    }
    .owl-carousel .owl-nav div {
        background: var(--primary-color) !important;
        color: #fff !important;
        width: 45px !important;
        height: 45px !important;
        
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        margin: 0 10px !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .owl-carousel .owl-nav div:hover {
        background: #222 !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
    .owl-carousel .owl-nav div i {
        
    }
    /* Fix Slider Icon Alignment */
    .owl-carousel .owl-nav div {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: normal !important;
        padding: 0 !important;
    }
    .owl-carousel .owl-nav div i {
        line-height: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }
    /* Premium Small Banner Design for White-Background Products */
    .small-banner .single-banner {
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 80%;
        height: 80%;
        object-fit: contain;
        mix-blend-mode: multiply; /* Magically removes the white background */
        transition: transform 0.5s ease;
        opacity: 0.85; /* Blend nicely with the text */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 1;
    }
    
          flex-direction: column !important;
          justify-content: center !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        
        align-items: center;
        justify-content: flex-end;
        text-align: center;
        z-index: 2;
        padding-bottom: 30px;
        background: linear-gradient(to top, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 50%);
    }
    .small-banner .single-banner .content h3 {
        color: #023a23 !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 22px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px !important;
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 10px 25px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 13px !important;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .small-banner .single-banner .content a:hover {
        background: #023a23 !important;
        transform: translateY(-3px);
    }
    /* Fixing the Small Banner Content Alignment */
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: flex-end !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 0 !important;
        padding-bottom: 20px !important;
        background: transparent !important;
    }
    /* We add a separate pseudo element for the gradient so it doesn't mess with flex */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 50% !important;
        background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
    }
    .small-banner .single-banner h3, 
    .small-banner .single-banner a {
        position: relative !important;
        z-index: 3 !important;
    }
    /* Sleek Lifestyle Category Banners */
    .small-banner .single-banner {
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
        opacity: 0.7; /* Darken image slightly so text is readable */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 0.5;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner::before {
        display: none !important; /* Remove any previously added gradients */
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 14px !important;
        letter-spacing: 1.5px;
        transition: all 0.3s ease !important;
        border: 2px solid transparent !important;
    }
    .small-banner .single-banner .content a:hover {
        background: transparent !important;
        border: 2px solid #fff !important;
        transform: translateY(-3px);
    }
    /* Restore to the Elegant White-on-Green Lifestyle Design */
    .small-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
    }
    /* The soft green gradient overlay */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(3,107,65,0.7) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
        display: block !important;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Poppins', sans-serif !important;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 2px !important;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
    }
    .small-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        font-size: 14px !important;
        letter-spacing: 1.5px !important;
        transition: all 0.3s ease !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }
    .small-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* Midium Banner (Featured Products) Redesign for White-Background Products */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%) !important;
        display: flex !important;
        align-items: center !important;
    }
    .midium-banner .single-banner::before {
        display: none !important; /* Remove dark overlay */
    }
    .midium-banner .single-banner img {
        width: 50% !important;
        height: 90% !important;
        object-fit: contain !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.5s ease !important;
        position: absolute !important;
        right: 10px !important;
        bottom: 10px !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.1) !important;
    }
    .midium-banner .single-banner .content {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        transform: none !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 40px !important;
        width: 60% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 15px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 6px 15px !important;
        border-radius: 30px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #023a23 !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 30px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 25px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: var(--primary-color) !important; 
        text-decoration: underline !important; 
    }
    .midium-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(3, 107, 65, 0.3) !important;
        border: 2px solid var(--primary-color) !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: transparent !important;
        color: var(--primary-color) !important;
        transform: translateY(-3px) !important;
    }
    /* Revert Midium Banner to the Original Behtreen Design */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: transparent !important;
        display: block !important;
    }
    .midium-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease !important;
        position: static !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05) !important;
    }
    .midium-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%) !important;
        z-index: 1 !important;
        display: block !important;
    }
    .midium-banner .single-banner .content {
        position: absolute !important;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 0 !important;
        width: 80% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 10px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 4px 12px !important;
        border-radius: 4px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; 
        text-decoration: underline !important;
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        border: none !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* === EMERGENCY FIX FOR LAYOUT === */
    /* 1. Fix Product Cards Layout */
    .single-product {
        display: flex !important;
        flex-direction: column !important;
        background: #fff !important;
    }
    .single-product .product-img {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 300px !important; /* Force image container height */
        padding: 20px !important;
    }
    .single-product .product-img img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
    }

    /* 2. Fix Small Banners Layout (Office Chairs etc) */
    .small-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        width: 100% !important;
        left: 0 !important;
        padding: 20px !important;
    }
    .small-banner .single-banner .content a {
        display: inline-block !important; /* Prevent stretching */
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
    }

    /* 3. Fix Medium Banner Layout (Featured) */
    .midium-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: center !important;
    }
    .midium-banner .single-banner .content a {
        display: inline-block !important;
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
    }
    /* === MOBILE RESPONSIVE FIXES FOR SLIDER === */
    @media (max-width: 768px) {
        #Gslider .carousel-inner img {
            min-height: 250px !important;
            object-fit: cover !important; /* Prevents stretching, crops instead to fit the height */
        }
        #Gslider .carousel-inner .carousel-caption {
            padding: 10px !important;
        }
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 20px !important;
            margin-bottom: 10px !important;
            line-height: 1.3 !important;
            letter-spacing: 1px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 12px !important;
            margin-bottom: 15px !important;
            line-height: 1.4 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important; /* Max 2 lines for description */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        #Gslider .btn.ws-btn {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    @media (max-width: 400px) {
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 16px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 11px !important;
        }
    }
    /* === FEATURED ITEMS RESPONSIVE FIX === */
    @media (max-width: 768px) {
        .midium-banner .single-banner {
            height: auto !important; /* Allow it to grow if needed */
            min-height: 250px !important;
            padding-bottom: 20px !important;
        }
        .midium-banner .single-banner .content {
            padding: 20px !important;
            width: 100% !important;
            left: 0 !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }
        .midium-banner .single-banner .content p {
            font-size: 11px !important;
            padding: 4px 10px !important;
            margin-bottom: 10px !important;
        }
        .midium-banner .single-banner .content h3 {
            font-size: 20px !important;
            line-height: 1.2 !important;
            margin-bottom: 15px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 3 !important; /* Limit title to 3 lines */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .midium-banner .single-banner .content a {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    /* === FIX FEATURED PRODUCTS CONTENT & BUTTONS === */
    .single-product .product-content {
        display: flex !important;
        flex-direction: column !important; /* Stack Title and Price vertically */
        justify-content: flex-start !important;
        text-align: center !important;
        padding: 15px 10px !important;
    }
    .single-product .product-content h3 {
        margin-bottom: 8px !important;
    }
    .single-product .product-content h3 a {
        display: block !important;
        font-size: 14px !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .single-product .product-content .product-price {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
    }
    .single-product .product-img .button-head {
        display: flex !important;
        flex-direction: row !important;
        opacity: 1 !important; /* Make buttons visible on mobile */
        visibility: visible !important;
        bottom: 10px !important;
        transform: translateY(0) !important;
    }
    .single-product .product-action {
        flex-direction: row !important;
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<div class="product-area section">
    <div class="container">
<div class="row">
            <div class="col-12">
                <div class="section-title text-center" style="margin-bottom: 50px;">
                    <span style="color: var(--primary-color); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 14px; display:block; margin-bottom: 10px;">Explore Collection</span>
                    <h2 style="font-family: 'Orbitron', sans-serif; font-size: 36px; font-weight: 800; color: #111;">Our <span style="color: var(--primary-color);">Products</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs filter-tope-group" id="myTab" role="tablist">
                            @php
                            $categories=DB::table('categories')->where('status','active')->where('is_parent',1)->get();
                            // dd($categories);
                            @endphp
                            @if($categories)
                            <button class="btn is-checked" data-filter="*">
                                All Products
                            </button>
                            @foreach($categories as $key=>$cat)

                            <button class="btn" data-filter=".{{$cat->id}}">
                                {{$cat->title}}
                            </button>
                            @endforeach
                            @endif
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content isotope-grid" id="myTabContent">
                        <!-- Start Single Tab -->
                        @if($product_lists)
                        @foreach($product_lists as $key=>$product)
                        <div class="col-sm-12 col-md-6 col-lg-3 p-b-35 isotope-item {{$product->cat_id}}">
                            <div class="single-product" data-aos="fade-up" data-aos-offset="50">
                                <div class="product-img">
                                    <a href="{{route('product-detail',$product->slug)}}">
                                        @php
                                        $photo=explode(',',$product->photo);
                                        // dd($photo);
                                        @endphp
                                        <img class="default-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        <img class="hover-img" src="{{$photo[0]}}" alt="{{$photo[0]}}">
                                        @if($product->stock<=0)
                                            <span class="out-of-stock">Sale out</span>
                                            @elseif($product->condition=='new')
                                            <span class="new">New</span
                                                @elseif($product->condition=='hot')
                                            <span class="hot">Hot</span>
                                            @else
                                            <span class="price-dec">{{$product->discount}}% Off</span>
                                            @endif


                                    </a>
                                    <div class="button-head">
                                        <div class="product-action d-flex justify-content-center align-items-center w-100">
                                            <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
                                            <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class="ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                    <div class="product-price">
                                        @php
                                        $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <span>Rs:{{number_format($after_discount,2)}}</span>
                                        <del style="padding-left:4%;">Rs:{{number_format($product->price,2)}}</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!--/ End Single Tab -->
                        @endif

                        <!--/ End Single Tab -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->







@include('frontend.layouts.newsletter')

<!-- Modal -->
@if($product_lists)
@foreach($product_lists as $key=>$product)
<div class="modal fade" id="{{$product->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <!-- Product Slider -->
                        <div class="product-gallery">
                            <div class="quickview-slider-active">
                                @php
                                $photo=explode(',',$product->photo);
                                // dd($photo);
                                @endphp
                                @foreach($photo as $data)
                                <div class="single-slider">
                                    <img src="{{$data}}" alt="{{$data}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Product slider -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="quickview-content">
                            <h2>{{$product->title}}</h2>
                            <div class="quickview-ratting-review">
                                <div class="quickview-ratting-wrap">
                                    <div class="quickview-ratting">
                                        {{-- <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="yellow fa fa-star"></i>
                                                    <i class="fa fa-star"></i> --}}
                                        @php
                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                        @endphp
                                        @for($i=1; $i<=5; $i++)
                                            @if($rate>=$i)
                                            <i class="yellow fa fa-star"></i>
                                            @else
                                            <i class="fa fa-star"></i>
                                            @endif
                                            @endfor
                                    </div>
                                    <a href="#"> ({{$rate_count}} customer review)</a>
                                </div>
                                <div class="quickview-stock">
                                    @if($product->stock >0)
                                    <span><i class="fa fa-check-circle-o"></i> {{$product->stock}} in stock</span>
                                    @else
                                    <span><i class="fa fa-times-circle-o text-danger"></i> {{$product->stock}} out stock</span>
                                    @endif
                                </div>
                            </div>
                            @php
                            $after_discount=($product->price-($product->price*$product->discount)/100);
                            @endphp
                            <h3><small><del class="text-muted">Rs:{{number_format($product->price,2)}}</del></small> Rs:{{number_format($after_discount,2)}} </h3>
                            <div class="quickview-peragraph">
                                <p>{!! html_entity_decode($product->summary) !!}</p>
                            </div>
                            @if($product->size)
                            <div class="size">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h5 class="title">Size</h5>
                                        <select>
                                            @php
                                            $sizes=explode(',',$product->size);
                                            // dd($sizes);
                                            @endphp
                                            @foreach($sizes as $size)
                                            <option>{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-lg-6 col-12">
                                                        <h5 class="title">Color</h5>
                                                        <select>
                                                            <option selected="selected">orange</option>
                                                            <option>purple</option>
                                                            <option>black</option>
                                                            <option>pink</option>
                                                        </select>
                                                    </div> --}}
                                </div>
                            </div>
                            @endif
                            <form action="{{route('single-add-to-cart')}}" method="POST" class="mt-4">
                                @csrf
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="slug" value="{{$product->slug}}">
                                        <input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button type="submit" class="btn">Add to cart</button>
                                    <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn min"><i class="ti-heart"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
<!-- Modal end -->









<!-- START CLEAN CARD CSS OVERRIDE -->
<style>
    /* Reset Clean Card */
    .clean-card {
        background: #fff !important;
        border: 1px solid #f0f0f0 !important;
        border-radius: 16px !important;
        margin: 15px !important;
        padding: 15px !important;
        text-align: left !important;
        position: relative !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        transition: box-shadow 0.3s ease, transform 0.3s ease !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .clean-card:hover {
        box-shadow: 0 8px 25px rgba(211,84,0,0.1) !important;
        transform: translateY(-5px) !important;
    }

    /* Product Image Box */
    .clean-card .product-img {
        background: #f4f4f4 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        padding: 0 !important;
        height: 220px !important;
        position: relative !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .clean-card .product-img a:not(.clean-wishlist) {
        width: 100% !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Blend mode to remove white backgrounds */
    .clean-card .product-img img.default-img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.4s ease !important;
    }
    .clean-card:hover .product-img img.default-img {
        transform: scale(1.08) !important;
    }

    /* Wishlist Button */
    a.clean-wishlist {
        position: absolute !important;
        top: 10px !important;
        right: 10px !important;
        width: 35px !important;
        height: 35px !important;
        background: #fff !important;
        color: #888 !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        transition: all 0.2s ease !important;
        z-index: 5 !important;
    }
    a.clean-wishlist:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: scale(1.1) !important;
    }

    /* Product Content Area */
    .clean-card .product-content {
        padding: 20px 50px 10px 10px !important;
        background: transparent !important;
        text-align: left !important;
        position: relative !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    /* Title */
    .clean-card .product-content h3 {
        margin: 0 0 8px 0 !important;
    }
    .clean-card .product-content h3 a {
        font-family: 'Poppins', sans-serif !important;
        font-size: 15px !important;
        font-weight: 800 !important;
        color: #111 !important;
        text-transform: uppercase !important;
        line-height: 1.3 !important;
        display: block !important;
    }

    /* Price Container */
    .clean-card .price-container {
        display: flex !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
        margin-top: auto !important; /* Push to bottom if title is short */
    }
    .clean-card .current-price {
        font-size: 16px !important;
        font-weight: 800 !important;
        color: var(--primary-color) !important;
    }
    .clean-card del {
        font-size: 13px !important;
        color: #999 !important;
        text-decoration: line-through !important;
    }

    /* Add to Cart Button (Bottom Right) */
    a.clean-add-cart {
        position: absolute !important;
        bottom: 10px !important;
        right: 10px !important;
        width: 40px !important;
        height: 40px !important;
        background: var(--primary-color) !important;
        color: #fff !important;
        border-radius: 12px !important; /* Squircle */
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 18px !important;
        box-shadow: 0 4px 10px rgba(211,84,0,0.3) !important;
        transition: all 0.2s ease !important;
        z-index: 5 !important;
        text-decoration: none !important;
    }
    a.clean-add-cart:hover {
        background: var(--hover-color) !important;
        transform: scale(1.1) !important;
        color: #fff !important;
    }

    /* Fix Carousel Arrows overlapping */
    .popular-slider .owl-nav div {
        background: #fff !important;
        color: var(--primary-color) !important;
        border: 1px solid var(--primary-color) !important;
        border-radius: 50% !important;
        width: 35px !important;
        height: 35px !important;
        line-height: 33px !important;
        text-align: center !important;
        font-size: 16px !important;
        position: absolute !important;
        top: 35% !important;
        transform: translateY(-50%) !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .popular-slider .owl-prev { left: -10px !important; }
    .popular-slider .owl-next { right: -10px !important; }

    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<!-- END CLEAN CARD CSS OVERRIDE -->


<!-- GLOBAL FONT OVERRIDE: POPPINS -->
<style>
    /* Force Poppins font globally */
    body, h1, h2, h3, h4, h5, h6, p, a, span, div, li, ul, label, input, button, select, textarea {
        font-family: 'Poppins', sans-serif !important;
    }
    
    /* Make Banner Text Bold as requested */
    #Gslider .carousel-inner .carousel-caption h1 {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 800 !important; /* Extra Bold */
        letter-spacing: 1px !important;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5) !important;
    }
    
    #Gslider .carousel-inner .carousel-caption p {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 600 !important; /* Semi Bold */
        font-size: 18px !important;
        text-shadow: 1px 1px 8px rgba(0,0,0,0.5) !important;
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<!-- END GLOBAL FONT OVERRIDE -->


<style>
    /* -------------------------------------
       PREMIUM HERO BANNER DESIGN (NIMCO)
       ------------------------------------- */
    #Gslider {
        position: relative;
    }
    #Gslider .carousel-inner {
        height: 85vh;
    }
    #Gslider .carousel-item {
        height: 100%;
    }
    #Gslider .carousel-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: right center; /* Focus on the bowls on the right */
    }
    
    /* Overlay to ensure text readability even if the image changes */
    #Gslider .carousel-item::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(90deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
        z-index: 1;
    }

    #Gslider .carousel-caption {
        position: absolute;
        top: 50%;
        left: 8% !important; /* Push slightly from edge */
        transform: translateY(-50%);
        bottom: auto;
        right: auto;
        width: 50%; /* Only take up left half */
        text-align: left !important;
        z-index: 2;
        padding: 0;
    }

    /* Small Premium Badge */
    #Gslider .carousel-caption::before {
        content: '🌟 100% FRESH & CRISPY';
        display: inline-block;
        background: color-mix(in srgb, var(--primary-color) 20%, transparent);
        color: #f39c12;
        border: 1px solid var(--primary-color);
        padding: 6px 15px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 20px;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    #Gslider .carousel-inner .carousel-caption h1 {
        font-family: 'Poppins', sans-serif !important;
        font-size: 55px !important;
        font-weight: 800 !important;
        color: #ffffff !important;
        line-height: 1.1 !important;
        text-shadow: none !important;
        margin-bottom: 25px !important;
        letter-spacing: -1px !important;
    }

    #Gslider .carousel-inner .carousel-caption p {
        font-family: 'Poppins', sans-serif !important;
        font-weight: 400 !important;
        font-size: 18px !important;
        color: #e0e0e0 !important;
        line-height: 1.6 !important;
        text-shadow: none !important;
        margin-bottom: 35px !important;
        max-width: 85%;
    }

    /* Primary Button */
    #Gslider .carousel-caption a.btn {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 15px 35px !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        border-radius: 5px !important;
        letter-spacing: 1px;
        border: none !important;
        box-shadow: 0 8px 20px color-mix(in srgb, var(--primary-color) 40%, transparent) !important;
        transition: all 0.3s ease !important;
        display: inline-flex;
        align-items: center;
    }

    #Gslider .carousel-caption a.btn i {
        margin-left: 10px;
        font-size: 18px;
    }

    #Gslider .carousel-caption a.btn:hover {
        background: var(--hover-color) !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 10px 25px color-mix(in srgb, var(--primary-color) 60%, transparent) !important;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        #Gslider .carousel-inner {
        height: 85vh;
    }
    #Gslider .carousel-item {
        height: 100%;
    }
        #Gslider .carousel-item::before {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 100%);
        }
        #Gslider .carousel-caption {
            width: 90%;
            left: 5% !important;
            top: auto;
            bottom: 10%;
            transform: none;
            text-align: center !important;
        }
        #Gslider .carousel-caption::before {
            margin-bottom: 15px;
        }
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 36px !important;
            text-align: center !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 15px !important;
            max-width: 100%;
            text-align: center !important;
            margin-bottom: 25px !important;
        }
        #Gslider .carousel-caption a.btn {
            width: 100%;
            justify-content: center;
        }
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<style>
    /* FINAL OVERRIDE FOR HERO BANNER HEIGHT */
    section#Gslider .carousel-inner {
        height: 85vh !important;
    }
    section#Gslider .carousel-item {
        height: 100% !important;
    }
    section#Gslider .carousel-inner img.first-slide {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
    }
    @media (max-width: 768px) {
        section#Gslider .carousel-inner {
            height: 70vh !important;
        }
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>

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

@endsection

@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
<style>
    /* Floating Action Buttons */
    .single-product .product-img .button-head {
        background: transparent !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        position: absolute !important;
        bottom: 15px !important;
        left: 0 !important;
        width: 100% !important;
        border: none !important;
        z-index: 9 !important;
    }
    
    .single-product .product-action {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        width: 100% !important;
        float: none !important;
    }

    .single-product .product-action a {
        color: #333 !important;
        font-size: 18px !important;
        margin: 0 5px !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        background: #fff !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
    }
    .single-product .product-action a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
    }
    .single-product .product-action a i {
        margin: 0 !important;
        padding: 0 !important;
    }
    /* Professional Banner Sliding */
    #Gslider .carousel-inner {
        height: 85vh;
    }
    #Gslider .carousel-item {
        height: 100%;
    }

    #Gslider .carousel-inner img {
        width: 100% !important;
        height: auto !important; /* Let image dictate height */
        display: block;
        opacity: 0.85; /* Much brighter image */
        transition: transform 6s ease; /* Subtle zoom effect */
    }
    
    /* Premium Gradient Overlay for the entire slider */
    #Gslider .carousel-item::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.8) 100%);
        pointer-events: none;
        z-index: 1;
    }

    #Gslider .carousel-item.active img {
        transform: scale(1.05); /* Slight zoom on active */
    }

    #Gslider .carousel-caption {
        top: 50%;
        bottom: auto;
        transform: translateY(-50%);
        text-align: center !important;
        left: 5%;
        right: 5%;
        z-index: 2;
    }

    #Gslider .carousel-inner .carousel-caption h1 {
        font-family: 'Orbitron', sans-serif;
        font-size: 48px;
        font-weight: 900;
        line-height: 1.2;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
    }

    #Gslider .carousel-inner .carousel-caption p {
        font-size: 20px;
        color: #f1f1f1;
        margin-bottom: 30px;
        font-weight: 400;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
    }

    #Gslider .btn.ws-btn {
        background-color: var(--primary-color); /* Matches logo green */
        color: #ffffff;
        padding: 14px 40px;
        border-radius: 4px;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 600;
        border: 2px solid var(--primary-color);
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.4);
    }

    #Gslider .btn.ws-btn:hover {
        background-color: transparent;
        color: var(--primary-color);
        border-color: var(--primary-color);
        box-shadow: none;
    }

    #Gslider .carousel-indicators {
        bottom: 30px;
    }
    
    #Gslider .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 6px;
        background-color: rgba(255, 255, 255, 0.5);
    }
    
    #Gslider .carousel-indicators li.active {
        background-color: var(--primary-color);
    }
    
    /* Responsive styling for small screens */
    @media (max-width: 768px) {
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 32px;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 16px;
        }
    }
    /* Midium Banner (Featured Products) Redesign */
    .midium-banner {
        padding: 60px 0 !important;
    }
    .midium-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .midium-banner .single-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05);
    }
    .midium-banner .single-banner::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%);
        z-index: 1;
    }
    .midium-banner .single-banner .content {
        position: absolute;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2;
        text-align: left !important;
        padding: 0 !important;
        width: 80%;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 10px;
        background: var(--primary-color);
        display: inline-block;
        padding: 4px 12px;
        border-radius: 4px;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; text-decoration: underline; /* Make discount pop, or use a distinct green/yellow */
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        text-shadow: none !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px);
    }
    /* Uniform Product Card Heights */
    
        flex-direction: column;
        
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        padding-top: 120%; /* Enforce a fixed aspect ratio for images */
        background: #fff;
        overflow: hidden;
    }
    .single-product .product-img a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-height: 100%;
        width: auto !important;
        max-width: 100%;
        object-fit: contain;
    }
    .single-product .product-content {
        flex-grow: 1;
        display: flex;
        
        justify-content: flex-end;
    }

    /* Fix Card Heights and Image Contain */
    
        flex-direction: column;
        
        justify-content: space-between;
        background: #fff;
    }
    .single-product .product-img {
        position: relative;
        width: 100%;
        height: 300px; /* Fixed height for all images */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .single-product .product-img a {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-product .product-img img {
        max-width: 100%;
        max-height: 100%;
        width: auto !important;
        height: auto !important;
        object-fit: contain;
    }
    .single-product .product-content {
        padding-top: 15px;
    }

    /* Perfect Global Section Padding */
    .section {
        padding: 70px 0 !important;
    }
    .section-title {
        margin-bottom: 50px !important;
    }
    .small-banner.section {
        padding: 40px 0 !important;
    }
    .midium-banner {
        padding: 70px 0 !important;
    }
    /* Add Padding to Product Images inside Cards */
    .single-product .product-img {
        padding: 20px !important;
    }
    
    /* Better Design for Slider Navigation Arrows */
    .owl-carousel .owl-nav {
        margin-top: 30px !important;
        text-align: center;
    }
    .owl-carousel .owl-nav div {
        background: var(--primary-color) !important;
        color: #fff !important;
        width: 45px !important;
        height: 45px !important;
        
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        margin: 0 10px !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .owl-carousel .owl-nav div:hover {
        background: #222 !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
    .owl-carousel .owl-nav div i {
        
    }
    /* Fix Slider Icon Alignment */
    .owl-carousel .owl-nav div {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: normal !important;
        padding: 0 !important;
    }
    .owl-carousel .owl-nav div i {
        line-height: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }
    /* Premium Small Banner Design for White-Background Products */
    .small-banner .single-banner {
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 80%;
        height: 80%;
        object-fit: contain;
        mix-blend-mode: multiply; /* Magically removes the white background */
        transition: transform 0.5s ease;
        opacity: 0.85; /* Blend nicely with the text */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 1;
    }
    
          flex-direction: column !important;
          justify-content: center !important;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        
        align-items: center;
        justify-content: flex-end;
        text-align: center;
        z-index: 2;
        padding-bottom: 30px;
        background: linear-gradient(to top, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0) 50%);
    }
    .small-banner .single-banner .content h3 {
        color: #023a23 !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 22px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px !important;
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 10px 25px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 13px !important;
        letter-spacing: 1px;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 10px rgba(3, 107, 65, 0.3);
    }
    .small-banner .single-banner .content a:hover {
        background: #023a23 !important;
        transform: translateY(-3px);
    }
    /* Fixing the Small Banner Content Alignment */
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: flex-end !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 0 !important;
        padding-bottom: 20px !important;
        background: transparent !important;
    }
    /* We add a separate pseudo element for the gradient so it doesn't mess with flex */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 50% !important;
        background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
    }
    .small-banner .single-banner h3, 
    .small-banner .single-banner a {
        position: relative !important;
        z-index: 3 !important;
    }
    /* Sleek Lifestyle Category Banners */
    .small-banner .single-banner {
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
        opacity: 0.7; /* Darken image slightly so text is readable */
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
        opacity: 0.5;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner::before {
        display: none !important; /* Remove any previously added gradients */
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Orbitron', sans-serif;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    .small-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 14px !important;
        letter-spacing: 1.5px;
        transition: all 0.3s ease !important;
        border: 2px solid transparent !important;
    }
    .small-banner .single-banner .content a:hover {
        background: transparent !important;
        border: 2px solid #fff !important;
        transform: translateY(-3px);
    }
    /* Restore to the Elegant White-on-Green Lifestyle Design */
    .small-banner .single-banner {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 350px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .small-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease;
    }
    .small-banner .single-banner:hover img {
        transform: scale(1.1);
    }
    /* The soft green gradient overlay */
    .small-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(3,107,65,0.7) 100%) !important;
        z-index: 1 !important;
        pointer-events: none !important;
        display: block !important;
    }
    
        flex-direction: column !important; justify-content: center !important;
        justify-content: center !important;
        text-align: center !important;
        z-index: 2 !important;
        padding: 20px !important;
        background: transparent !important;
    }
    .small-banner .single-banner .content h3 {
        color: #fff !important; 
        font-family: 'Poppins', sans-serif !important;
        font-size: 26px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 2px !important;
        margin-bottom: 25px !important;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5) !important;
    }
    .small-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        font-size: 14px !important;
        letter-spacing: 1.5px !important;
        transition: all 0.3s ease !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
    }
    .small-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* Midium Banner (Featured Products) Redesign for White-Background Products */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: linear-gradient(135deg, #f0f7f4 0%, #d1e8de 100%) !important;
        display: flex !important;
        align-items: center !important;
    }
    .midium-banner .single-banner::before {
        display: none !important; /* Remove dark overlay */
    }
    .midium-banner .single-banner img {
        width: 50% !important;
        height: 90% !important;
        object-fit: contain !important;
        mix-blend-mode: multiply !important;
        transition: transform 0.5s ease !important;
        position: absolute !important;
        right: 10px !important;
        bottom: 10px !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.1) !important;
    }
    .midium-banner .single-banner .content {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        transform: none !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 40px !important;
        width: 60% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 15px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 6px 15px !important;
        border-radius: 30px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #023a23 !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 30px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 25px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: var(--primary-color) !important; 
        text-decoration: underline !important; 
    }
    .midium-banner .single-banner .content a {
        background: var(--primary-color) !important;
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(3, 107, 65, 0.3) !important;
        border: 2px solid var(--primary-color) !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: transparent !important;
        color: var(--primary-color) !important;
        transform: translateY(-3px) !important;
    }
    /* Revert Midium Banner to the Original Behtreen Design */
    .midium-banner .single-banner {
        border-radius: 12px !important;
        overflow: hidden !important;
        position: relative !important;
        height: 350px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
        background: transparent !important;
        display: block !important;
    }
    .midium-banner .single-banner img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        mix-blend-mode: normal !important;
        transition: transform 0.5s ease !important;
        position: static !important;
    }
    .midium-banner .single-banner:hover img {
        transform: scale(1.05) !important;
    }
    .midium-banner .single-banner::before {
        content: '' !important;
        position: absolute !important;
        top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important;
        background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(3,107,65,0.4) 100%) !important;
        z-index: 1 !important;
        display: block !important;
    }
    .midium-banner .single-banner .content {
        position: absolute !important;
        top: 50% !important;
        left: 40px !important;
        transform: translateY(-50%) !important;
        z-index: 2 !important;
        text-align: left !important;
        padding: 0 !important;
        width: 80% !important;
        background: transparent !important;
    }
    .midium-banner .single-banner .content p {
        color: #fff !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        letter-spacing: 2px !important;
        text-transform: uppercase !important;
        margin-bottom: 10px !important;
        background: var(--primary-color) !important;
        display: inline-block !important;
        padding: 4px 12px !important;
        border-radius: 4px !important;
    }
    .midium-banner .single-banner .content h3 {
        color: #fff !important;
        font-family: 'Poppins', sans-serif !important;
        font-size: 32px !important;
        font-weight: 800 !important;
        line-height: 1.3 !important;
        margin-bottom: 20px !important;
        text-shadow: none !important;
    }
    .midium-banner .single-banner .content h3 span {
        color: #fff !important; 
        text-decoration: underline !important;
    }
    .midium-banner .single-banner .content a {
        background: #fff !important;
        color: var(--primary-color) !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        transition: all 0.3s ease !important;
        display: flex !important; align-items: center !important; justify-content: center !important; line-height: 1.2 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
        border: none !important;
    }
    .midium-banner .single-banner .content a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        transform: translateY(-3px) !important;
    }
    /* === EMERGENCY FIX FOR LAYOUT === */
    /* 1. Fix Product Cards Layout */
    .single-product {
        display: flex !important;
        flex-direction: column !important;
        background: #fff !important;
    }
    .single-product .product-img {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 300px !important; /* Force image container height */
        padding: 20px !important;
    }
    .single-product .product-img img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
    }

    /* 2. Fix Small Banners Layout (Office Chairs etc) */
    .small-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        width: 100% !important;
        left: 0 !important;
        padding: 20px !important;
    }
    .small-banner .single-banner .content a {
        display: inline-block !important; /* Prevent stretching */
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 4px !important;
    }

    /* 3. Fix Medium Banner Layout (Featured) */
    .midium-banner .single-banner .content {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        justify-content: center !important;
    }
    .midium-banner .single-banner .content a {
        display: inline-block !important;
        width: auto !important;
        text-align: center !important;
        padding: 12px 30px !important;
        border-radius: 30px !important;
    }
    /* === MOBILE RESPONSIVE FIXES FOR SLIDER === */
    @media (max-width: 768px) {
        #Gslider .carousel-inner img {
            min-height: 250px !important;
            object-fit: cover !important; /* Prevents stretching, crops instead to fit the height */
        }
        #Gslider .carousel-inner .carousel-caption {
            padding: 10px !important;
        }
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 20px !important;
            margin-bottom: 10px !important;
            line-height: 1.3 !important;
            letter-spacing: 1px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 12px !important;
            margin-bottom: 15px !important;
            line-height: 1.4 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important; /* Max 2 lines for description */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        #Gslider .btn.ws-btn {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    @media (max-width: 400px) {
        #Gslider .carousel-inner .carousel-caption h1 {
            font-size: 16px !important;
        }
        #Gslider .carousel-inner .carousel-caption p {
            font-size: 11px !important;
        }
    }
    /* === FEATURED ITEMS RESPONSIVE FIX === */
    @media (max-width: 768px) {
        .midium-banner .single-banner {
            height: auto !important; /* Allow it to grow if needed */
            min-height: 250px !important;
            padding-bottom: 20px !important;
        }
        .midium-banner .single-banner .content {
            padding: 20px !important;
            width: 100% !important;
            left: 0 !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
        }
        .midium-banner .single-banner .content p {
            font-size: 11px !important;
            padding: 4px 10px !important;
            margin-bottom: 10px !important;
        }
        .midium-banner .single-banner .content h3 {
            font-size: 20px !important;
            line-height: 1.2 !important;
            margin-bottom: 15px !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 3 !important; /* Limit title to 3 lines */
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
        .midium-banner .single-banner .content a {
            padding: 8px 20px !important;
            font-size: 12px !important;
        }
    }
    /* === FIX FEATURED PRODUCTS CONTENT & BUTTONS === */
    .single-product .product-content {
        display: flex !important;
        flex-direction: column !important; /* Stack Title and Price vertically */
        justify-content: flex-start !important;
        text-align: center !important;
        padding: 15px 10px !important;
    }
    .single-product .product-content h3 {
        margin-bottom: 8px !important;
    }
    .single-product .product-content h3 a {
        display: block !important;
        font-size: 14px !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .single-product .product-content .product-price {
        display: flex !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 6px !important;
    }
    .single-product .product-img .button-head {
        display: flex !important;
        flex-direction: row !important;
        opacity: 1 !important; /* Make buttons visible on mobile */
        visibility: visible !important;
        bottom: 10px !important;
        transform: translateY(0) !important;
    }
    .single-product .product-action {
        flex-direction: row !important;
    }
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 6s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.08); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    /*==================================================================
        [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function() {
        $filter.on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({
                filter: filterValue
            });
        });

    });

    // init Isotope
    $(window).on('load', function() {
        var $grid = $topeContainer.each(function() {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function() {
        $(this).on('click', function() {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });
</script>
<script>
    function cancelFullScreen(el) {
        var requestMethod = el.cancelFullScreen || el.webkitCancelFullScreen || el.mozCancelFullScreen || el.exitFullscreen;
        if (requestMethod) { // cancel full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
    }

    function requestFullScreen(el) {
        // Supports most browsers and their versions.
        var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;

        if (requestMethod) { // Native full screen.
            requestMethod.call(el);
        } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
        return false
    }
</script>

@endpush











