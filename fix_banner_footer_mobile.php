<?php
$f_index = 'resources/views/frontend/index.blade.php';
$c_index = file_get_contents($f_index);

// 1. Fix the Final Banner on Mobile
$old_banner_css = '<style>';
$new_banner_css = '<style>
    @media(max-width: 768px) {
        .final-banner-section {
            padding: 30px 0 !important;
        }
        .final-banner-img {
            min-height: 120px;
            object-fit: cover;
            object-position: center;
        }
    }
';
$c_index = str_replace($old_banner_css, $new_banner_css, $c_index);

$old_banner_html = '<img src="{{ asset(\'frontend/img/final-banner.jpg?v=2\') }}" alt="Shoukat Nimco Banner" class="img-fluid w-100" style="border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">';
$new_banner_html = '<img src="{{ asset(\'frontend/img/final-banner.jpg?v=2\') }}" alt="Shoukat Nimco Banner" class="img-fluid w-100 final-banner-img" style="border-radius: 15px; box-shadow: 0 15px 40px rgba(0,0,0,0.15);">';
$c_index = str_replace($old_banner_html, $new_banner_html, $c_index);

file_put_contents($f_index, $c_index);

// 2. Fix the Footer Logo on Mobile
$f_footer = 'resources/views/frontend/layouts/footer.blade.php';
$c_footer = file_get_contents($f_footer);

$old_footer_logo = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 4px solid #d4af37;">';
$new_footer_logo = '<img src="{{asset(\'images/footer_logo.jpg\')}}" alt="Shoukat Nimco Center Logo" class="footer-logo-img" style="width: 140px; height: 140px; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 4px solid #d4af37;">';
$c_footer = str_replace($old_footer_logo, $new_footer_logo, $c_footer);

$old_footer_css = '</style>';
$new_footer_css = '
    @media(max-width: 768px) {
        .footer-logo-img {
            width: 90px !important;
            height: 90px !important;
        }
        .est-badge {
            width: 60px !important;
            height: 60px !important;
            font-size: 10px !important;
            right: 0 !important;
        }
        .est-badge span {
            font-size: 14px !important;
        }
    }
</style>';
$c_footer = str_replace($old_footer_css, $new_footer_css, $c_footer);

file_put_contents($f_footer, $c_footer);

echo "Fixed banner and footer logo on mobile.\n";
?>
