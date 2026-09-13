<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

// Add animations CSS
$animation_css = <<<CSS
    /* Splash Animations */
    @keyframes bounceInLogo {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.1); opacity: 1; }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
    @keyframes slideUpFade {
        0% { transform: translateY(30px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    #locationModal.show .modal-header-custom .animated-logo {
        animation: bounceInLogo 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
    }
    #locationModal.show .modal-body {
        animation: slideUpFade 0.6s ease-out forwards;
        animation-delay: 0.2s;
        opacity: 0;
    }
    
    #locationModal .modal-header-custom {
        overflow: visible; /* so bouncing logo isn't clipped */
    }
    
    #locationModal .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }
    #locationModal.show .modal-content {
        transform: scale(1);
    }
CSS;

$modal = preg_replace('/<\/style>/', $animation_css . "\n</style>", $modal);

// Update logo HTML to include animated class and dynamic path from settings, falling back to footer_logo.jpg
$old_logo_html = <<<HTML
                <!-- Modal Logo -->
                <div style="background: white; border-radius: 50%; width: 70px; height: 70px; margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
HTML;
$new_logo_html = <<<HTML
                <!-- Modal Logo -->
                @php \$settings = DB::table('settings')->first(); @endphp
                <div class="animated-logo" style="background: white; border-radius: 50%; width: 90px; height: 90px; margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.25); border: 3px solid var(--primary-color); opacity: 0; position: relative; z-index: 10;">
                    <img src="{{asset('images/footer_logo.jpg')}}" onerror="this.src='{{asset(\$settings->logo)}}'" alt="Shoukat Nimco Center" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
HTML;

$modal = str_replace($old_logo_html, $new_logo_html, $modal);

// Since I removed the CSS for .modal-header-custom img, the logo should have the inline style now.

file_put_contents($modal_path, $modal);
echo "Animations and dynamic logo added.\n";
