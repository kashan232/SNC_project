<?php
$file = 'resources/views/frontend/layouts/header.blade.php';
$content = file_get_contents($file);

$old_css = <<<CSS
    /* Center Logo */
    .top-header-center {
        background: #fff;
        padding: 8px 25px;
        border-radius: 20px;
        box-shadow: 0 4px 15px color-mix(in srgb, var(--primary-color) 15%, transparent);
        border: 2px solid var(--primary-color);
        text-align: center;
        z-index: 60;
        display: flex;
        align-items: center;
        justify-content: center;
    }
CSS;

$new_css = <<<CSS
    /* Center Logo */
    .top-header-center {
        background: transparent;
        padding: 0;
        border-radius: 0;
        box-shadow: none;
        border: none;
        text-align: center;
        z-index: 60;
        display: flex;
        align-items: center;
        justify-content: center;
    }
CSS;

$content = str_replace($old_css, $new_css, $content);
file_put_contents($file, $content);
echo "Background removed from header logo.\n";
