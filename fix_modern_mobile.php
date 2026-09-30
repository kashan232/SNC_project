<?php
$f = 'resources/views/frontend/layouts/header.blade.php';
$c = file_get_contents($f);

// 1. Add CSS rules to make modern-top-header look good on mobile
$new_css = "
    @media(max-width: 991px) {
        .modern-top-header {
            padding: 5px 15px !important;
            min-height: 60px !important;
        }
        .modern-top-header .top-header-left {
            gap: 10px !important;
        }
        .modern-logo-img {
            width: 50px !important;
            height: 50px !important;
            min-width: 50px !important;
            min-height: 50px !important;
        }
        .modern-location-btn {
            padding: 5px 10px !important;
            font-size: 13px !important;
        }
        .modern-location-btn i {
            font-size: 14px !important;
        }
        .modern-nav-actions {
            gap: 10px !important;
            padding: 4px 10px !important;
        }
        /* Hide the call text on mobile to save space */
        .modern-top-header .top-header-right > div:first-child {
            display: none !important;
        }
    }
";

// Insert CSS
$c = str_replace('/* Mobile overrides */', "/* Mobile overrides */\n" . $new_css, $c);

// 2. Add classes to the HTML
$old_img = 'style="width: 75px; height: 75px; min-width: 75px; min-height: 75px; flex-shrink: 0; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"';
$new_img = 'class="modern-logo-img" style="width: 75px; height: 75px; min-width: 75px; min-height: 75px; flex-shrink: 0; object-fit: cover; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"';
$c = str_replace($old_img, $new_img, $c);

$old_loc = 'style="cursor: pointer; display: flex; align-items: center; gap: 8px; color: #444; font-size: 15px; font-weight: 600; background: #f9f9f9; padding: 8px 15px; border-radius: 30px; border: 1px solid #eee; transition: all 0.3s;"';
$new_loc = 'class="modern-location-btn" style="cursor: pointer; display: flex; align-items: center; gap: 8px; color: #444; font-size: 15px; font-weight: 600; background: #f9f9f9; padding: 8px 15px; border-radius: 30px; border: 1px solid #eee; transition: all 0.3s;"';
$c = str_replace($old_loc, $new_loc, $c);

file_put_contents($f, $c);
echo "Added mobile specific classes for modern header.\n";
?>
