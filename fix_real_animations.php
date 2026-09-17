<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';

// 1. Add Floating WhatsApp icon to master.blade.php with Scroll-to-show logic
$master_path = $base_dir . 'resources/views/frontend/layouts/master.blade.php';
$master = file_get_contents($master_path);

$whatsapp_html = <<<HTML
<style>
    /* Floating WhatsApp Icon */
    .float-wa {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 25px;
        left: 25px;
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
        transition: all 0.3s ease;
        text-decoration: none !important;
        animation: pulseWa 2s infinite;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
    }
    .float-wa.show-wa {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
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
<a href="https://wa.me/{{ \$wa_phone }}" class="float-wa" target="_blank" id="wa-btn">
    <i class="bi bi-whatsapp"></i>
</a>
<script>
    window.addEventListener('scroll', function() {
        var waBtn = document.getElementById('wa-btn');
        if (window.scrollY > 200) {
            waBtn.classList.add('show-wa');
        } else {
            waBtn.classList.remove('show-wa');
        }
    });
</script>
HTML;

if (strpos($master, 'float-wa') === false) {
    $master = str_replace('</body>', $whatsapp_html . "\n</body>", $master);
    file_put_contents($master_path, $master);
}

// 2. Add Animations for Hero Section (#Gslider)
$index_path = $base_dir . 'resources/views/frontend/index.blade.php';
$index = file_get_contents($index_path);

$hero_animation_css = <<<CSS
<style>
    /* Hero Banner Animations (Ken Burns + Text Fade Up) */
    #Gslider .carousel-item img {
        transition: transform 7s ease-in-out;
        transform: scale(1);
    }
    #Gslider .carousel-item.active img {
        transform: scale(1.1); /* Slow zoom in */
    }
    
    #Gslider .carousel-item .carousel-caption h1 {
        opacity: 0;
        transform: translateY(40px);
        transition: all 1s ease 0.3s;
    }
    #Gslider .carousel-item.active .carousel-caption h1 {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption p {
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s ease 0.6s;
    }
    #Gslider .carousel-item.active .carousel-caption p {
        opacity: 1;
        transform: translateY(0);
    }
    
    #Gslider .carousel-item .carousel-caption .ws-btn {
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s ease 0.9s;
    }
    #Gslider .carousel-item.active .carousel-caption .ws-btn {
        opacity: 1;
        transform: translateY(0);
    }
</style>
CSS;

if (strpos($index, 'Ken Burns') === false) {
    // Append to end of file
    $index .= "\n" . $hero_animation_css;
    file_put_contents($index_path, $index);
}

echo "WhatsApp and Hero animations applied correctly.\n";
