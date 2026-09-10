<?php
$file = 'resources/views/frontend/index.blade.php';
$content = file_get_contents($file);

// 1. Remove the custom .divider HTML
$content = str_replace('<div class="divider"></div>', '', $content);

// 2. Remove the custom .divider CSS
$content = preg_replace('/#our-outlets \.section-title \.divider \{.*?\}/s', '', $content);

// 3. Fix the .store-box CSS to handle text overflow and stretch heights in grid
$old_store_box = <<<CSS
    .store-box {
        background: #fff;
        border: 1px solid #eaeaea;
        padding: 30px 25px;
        border-radius: 8px;
        text-align: center;
        transition: all 0.3s ease;
    }
CSS;

$new_store_box = <<<CSS
    .store-box {
        background: #fff;
        border: 1px solid #eaeaea;
        padding: 30px 25px;
        border-radius: 8px;
        text-align: center;
        transition: all 0.3s ease;
        height: auto;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
    }
    .store-box p {
        flex-grow: 1; /* Pushes the text nicely and prevents overflow */
        word-break: break-word; /* Ensure long words wrap */
        display: block !important;
    }
CSS;

$content = str_replace($old_store_box, $new_store_box, $content);

file_put_contents($file, $content);
echo "Store box height and divider fixed.\n";
