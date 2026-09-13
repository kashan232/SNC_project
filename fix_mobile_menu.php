<?php
$base_dir = 'c:/xampp/htdocs/SNC_project/';
$header_path = $base_dir . 'resources/views/frontend/layouts/header.blade.php';
$header = file_get_contents($header_path);

$css_fix = <<<CSS
        /* Mobile Nav (Slicknav) Dropdown Fixes */
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
            background-color: var(--primary-color) !important;
            height: 3px !important;
            margin: 5px 0 !important;
            width: 25px !important;
        }
        /* Break the dropdown out of the flex container */
        .slicknav_nav {
            position: fixed !important;
            top: 80px !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            background: #fff !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
            z-index: 999999 !important;
            border-top: 3px solid var(--primary-color) !important;
            max-height: 80vh;
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
            background: var(--primary-color) !important;
            color: #fff !important;
        }
        
        /* Ensure the Change Location box doesn't break styling when menu opens */
        .top-header-left > .action-box:first-child {
            width: 100%;
            justify-content: center;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            padding: 10px !important;
            margin-top: 5px;
        }
CSS;

$header = str_replace('/* Adjust icon sizes */', $css_fix . "\n\n        /* Adjust icon sizes */", $header);

file_put_contents($header_path, $header);
echo "Menu toggle fixed.\n";
