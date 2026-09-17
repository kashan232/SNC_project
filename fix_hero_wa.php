<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Add Floating WhatsApp icon to Footer
$footer_path = $base_dir . 'resources/views/frontend/layouts/footer.blade.php';
$footer = file_get_contents($footer_path);

$whatsapp_css_html = <<<HTML
<style>
    /* Floating WhatsApp Icon */
    .float-wa {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        left: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease;
        text-decoration: none !important;
        animation: pulseWa 2s infinite;
    }
    .float-wa:hover {
        transform: scale(1.1);
        color: #fff;
    }
    @keyframes pulseWa {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
        70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }
    @media (max-width: 768px) {
        .float-wa {
            width: 50px;
            height: 50px;
            bottom: 20px;
            left: 20px;
            font-size: 24px;
        }
    }
</style>

<!-- Floating WhatsApp -->
@php
    \$wa_settings = DB::table('settings')->first();
    \$wa_phone = \$wa_settings ? preg_replace('/\D/', '', \$wa_settings->phone) : '923173836223';
@endphp
<a href="https://wa.me/{{ \$wa_phone }}" class="float-wa" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>
HTML;

if (strpos($footer, 'float-wa') === false) {
    $footer = str_replace('</body>', $whatsapp_css_html . "\n</body>", $footer);
    file_put_contents($footer_path, $footer);
}

// 2. Add Animations for Hero Section (#Gslider)
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

$hero_animation_css = <<<CSS
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
CSS;

if (strpos($index, 'Ken Burns') === false) {
    // We add the CSS block to the style block of index.blade.php
    $index = str_replace('</style>', $hero_animation_css . "\n</style>", $index);
    file_put_contents($index_path, $index);
}

echo "WhatsApp floating icon and Hero Banner animations applied.\n";
