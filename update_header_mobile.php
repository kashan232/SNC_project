<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

$mobile_css = <<<CSS
    @media(max-width: 991px) {
        /* Reset pill on mobile to a flat, tight box */
        .custom-top-header {
            flex-direction: row !important;
            flex-wrap: wrap !important;
            border-radius: 0 !important;
            padding: 10px 15px !important;
            gap: 10px !important;
            margin: 0 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
            align-items: center !important;
            justify-content: space-between !important;
        }

        /* Order: Logo Center, Menu Right, Icons Right */
        .top-header-center {
            order: 1;
            width: 50px;
            padding: 0 !important;
            margin-right: auto; /* Push left side to left */
        }
        
        .top-header-center img {
            width: 50px !important;
            height: 50px !important;
        }

        /* Right side containing cart and hamburger */
        .top-header-right {
            order: 2;
            width: auto !important;
            justify-content: flex-end !important;
            gap: 5px !important;
        }

        /* Full width location bar at the bottom of header */
        .top-header-left {
            order: 3;
            width: 100% !important;
            justify-content: center !important;
        }

        /* Hide everything unnecessary to save space */
        .top-header-right > .action-box, 
        .top-header-left > .action-box:nth-child(2) {
            display: none !important; /* Hide track order, login, call us */
        }

        .action-box {
            padding: 5px 10px !important;
        }

        .top-header-left > .action-box:first-child {
            width: 100%;
            justify-content: center;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            padding: 8px !important;
        }

        /* Tweak mobile nav hamburger */
        .mobile-nav {
            margin-left: 10px;
            margin-top: 5px;
        }
        
        /* Adjust icon sizes */
        .right-bar {
            gap: 5px !important;
        }
        .right-bar .single-icon .icon-wrap {
            width: 35px !important;
            height: 35px !important;
            font-size: 18px !important;
        }
        .right-bar .single-icon .total-count {
            width: 16px !important;
            height: 16px !important;
            font-size: 9px !important;
            top: -2px !important;
            right: -2px !important;
        }
    }
CSS;

$header = preg_replace('/@media\(max-width:\s*991px\)\s*\{(?:[^{}]*|\{(?:[^{}]*|\{[^{}]*\})*\})*\}/', $mobile_css, $header);

file_put_contents($header_path, $header);
echo "Header mobile UI updated.\n";
