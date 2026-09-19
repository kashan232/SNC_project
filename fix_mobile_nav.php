<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php');

$old_css = <<<CSS
        .top-header-right > .action-box {
            display: none !important; /* Hide track order, login, etc. from top bar */
        }
CSS;

$new_css = <<<CSS
        .top-header-right > .action-box,
        .top-header-right > div:first-child,
        .modern-nav-actions .complaint-btn,
        .modern-nav-actions > div:first-of-type {
            display: none !important; /* Hide phone and complaint button on mobile */
        }
        
        .modern-nav-actions {
            padding: 0 !important;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            gap: 5px !important;
        }
CSS;

$c = str_replace($old_css, $new_css, $c);

file_put_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/layouts/header.blade.php', $c);
echo "Mobile nav CSS fixed!";
