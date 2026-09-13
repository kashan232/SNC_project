<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$modal_path = $base_dir . 'resources/views/frontend/layouts/location_modal.blade.php';
$modal = file_get_contents($modal_path);

// Replace Text Logo with Image Logo
$old_logo_html = <<<HTML
                <!-- Placeholder for Logo -->
                <div style="background: white; border-radius: 8px; padding: 10px; width: max-content; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                    <strong style="color: var(--primary-color); font-size: 18px; font-weight: 900; line-height: 1;">Shoukat<br>Nimco</strong>
                </div>
HTML;
$new_logo_html = <<<HTML
                <!-- Modal Logo -->
                <div style="background: white; border-radius: 50%; width: 70px; height: 70px; margin: 0 auto; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <img src="{{asset('images/footer_logo.jpg')}}" alt="Shoukat Nimco Center" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                </div>
HTML;
$modal = str_replace($old_logo_html, $new_logo_html, $modal);


// Add mobile CSS to center modal and fix grid
$mobile_css = <<<CSS
    @media (max-width: 576px) {
        #locationModal .modal-dialog {
            margin: 10px;
            display: flex;
            align-items: center;
            min-height: calc(100% - 20px);
        }
        #locationModal .city-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }
        #locationModal .modal-body {
            padding: 15px 20px !important;
        }
    }
</style>
CSS;
$modal = str_replace('</style>', $mobile_css, $modal);

file_put_contents($modal_path, $modal);
echo "Modal centered and logo added.\n";
