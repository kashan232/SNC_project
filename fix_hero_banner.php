<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

$hero_css = <<<'CSS'

<style>
    /* -------------------------------------
       PREMIUM HERO BANNER DESIGN (NIMCO)
       ------------------------------------- */
    #Gslider {
        position: relative;
    }
    #Gslider .carousel-inner {
        height: 85vh; /* Very immersive height */
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
        background: rgba(211, 84, 0, 0.2);
        color: #f39c12;
        border: 1px solid #d35400;
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
        background: #d35400 !important;
        color: #fff !important;
        padding: 15px 35px !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        border-radius: 5px !important;
        letter-spacing: 1px;
        border: none !important;
        box-shadow: 0 8px 20px rgba(211, 84, 0, 0.4) !important;
        transition: all 0.3s ease !important;
        display: inline-flex;
        align-items: center;
    }

    #Gslider .carousel-caption a.btn i {
        margin-left: 10px;
        font-size: 18px;
    }

    #Gslider .carousel-caption a.btn:hover {
        background: #a84300 !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 10px 25px rgba(211, 84, 0, 0.6) !important;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        #Gslider .carousel-inner {
            height: 70vh;
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
</style>
CSS;

// Let's insert the CSS just before @endsection
if (strpos($content, 'PREMIUM HERO BANNER DESIGN') === false) {
    $content = str_replace('@endsection', $hero_css . "\n@endsection", $content);
    file_put_contents($file, $content);
    echo "Hero Banner CSS applied!\n";
} else {
    echo "Hero CSS already exists.\n";
}

// Modify the HTML to just have the Shop Now button, removing any weird nested <i> tags which are in the original code
$old_html = '<a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route(\'product-grids\')}}" role="button">Shop Now<i class="far fa-arrow-alt-circle-right"></i></i></a>';
$new_html = '<a class="btn btn-lg ws-btn wow fadeInUpBig" href="{{route(\'product-grids\')}}" role="button">Explore Menu <i class="ti-arrow-right"></i></a>';

$content = str_replace($old_html, $new_html, $content);
file_put_contents($file, $content);

