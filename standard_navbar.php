<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

// Let's replace the whole mobile CSS block
$new_mobile_css = <<<CSS
    @media(max-width: 991px) {
        /* Standard Navbar Layout */
        .custom-top-header {
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            border-radius: 0 !important;
            padding: 10px 15px !important;
            margin: 0 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
            align-items: center !important;
            justify-content: space-between !important;
            background: #fff !important;
            position: relative;
            z-index: 1000;
            height: 70px;
        }

        /* 1. Left: Logo */
        .top-header-center {
            order: 1;
            width: auto !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .top-header-center img {
            width: 45px !important;
            height: 45px !important;
        }

        /* 2. Middle: Change Location */
        .top-header-left {
            order: 2;
            width: auto !important;
            flex: 1;
            justify-content: flex-start !important;
            padding-left: 10px;
        }
        .top-header-left > .action-box:first-child {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .top-header-left > .action-box:first-child .icon-wrap {
            background: transparent !important;
            color: var(--primary-color) !important;
            font-size: 18px !important;
            width: auto !important;
            height: auto !important;
        }
        .top-header-left > .action-box:first-child .title {
            display: none !important; /* Hide "Change Location" title */
        }
        .top-header-left > .action-box:first-child .subtitle {
            font-size: 13px !important;
            color: #333 !important;
            font-weight: 700 !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100px;
        }

        /* Hide Call Us */
        .top-header-left > .action-box:nth-child(2) {
            display: none !important;
        }

        /* 3. Right: Cart & Menu */
        .top-header-right {
            order: 3;
            width: auto !important;
            justify-content: flex-end !important;
            gap: 5px !important;
        }
        .top-header-right > .action-box {
            display: none !important; /* Hide track order, login, etc. from top bar */
        }
        
        /* Adjust Icons */
        .right-bar {
            gap: 10px !important;
            margin: 0 !important;
        }
        .right-bar .single-icon .icon-wrap {
            width: 32px !important;
            height: 32px !important;
            font-size: 18px !important;
        }
        
        /* SlickNav Mobile Menu Fixes */
        .mobile-nav {
            margin-left: 5px;
            display: flex;
            align-items: center;
        }
        .slicknav_menu {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .slicknav_btn {
            background: transparent !important;
            margin: 0 !important;
            padding: 5px !important;
        }
        .slicknav_icon-bar {
            background-color: #333 !important;
        }
        
        /* Full Dropdown styling */
        .slicknav_nav {
            position: absolute !important;
            top: 70px !important; /* Right below the 70px header */
            left: 0 !important;
            right: 0 !important;
            width: 100vw !important;
            background: #fff !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            z-index: 999999 !important;
            border-top: 2px solid var(--primary-color) !important;
            max-height: calc(100vh - 70px);
            overflow-y: auto;
        }
        .slicknav_nav li {
            width: 100%;
            display: block;
        }
        .slicknav_nav a {
            color: #333 !important;
            font-weight: 600 !important;
            padding: 12px 20px !important;
            border-bottom: 1px solid #f5f5f5 !important;
            text-align: left;
            margin: 0 !important;
            border-radius: 0 !important;
        }
        .slicknav_nav a:hover {
            background: #f9f9f9 !important;
            color: var(--primary-color) !important;
        }
    }
CSS;

$header = preg_replace('/@media\(max-width:\s*991px\)\s*\{(?:[^{}]*|\{(?:[^{}]*|\{[^{}]*\})*\})*\}/', $new_mobile_css, $header);

// Remove the previous custom CSS block if it was added separately
$header = preg_replace('/\/\*\s*Mobile Nav \(Slicknav\) Dropdown Fixes\s*\*\/.*?\/\*\s*Adjust icon sizes\s*\*\//s', '/* Adjust icon sizes */', $header);

file_put_contents($header_path, $header);
echo "New proper mobile navbar applied.\n";
